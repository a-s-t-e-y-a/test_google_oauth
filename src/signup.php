<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
include('database.php');
$client = new Google\Client();
$client->setAuthConfig('./config/client_secret.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/signup.php');
$client->addScope('email');
$client->addScope('profile');
$client->addScope('picture');

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

  if (array_key_exists('error', $token)) {
    header('Location: ' . $client->getAuthUrl());
    exit();
  }

  $_SESSION['access_token'] = $token['access_token'];
  $client->setAccessToken($token['access_token']);

  $google_service = new Google\Service\Oauth2($client);
  try {
    $user_info = $google_service->userinfo->get();

    $stmt = $mysqli->prepare("SELECT id FROM users WHERE google_id = ?");
    $stmt->bind_param("s", $user_info->id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $_SESSION['message'] = "You are already signed in, buddy!";
      header('Location: signin_alert.php'); // Redirect to an alert page
      exit();
    } else {
      $stmt = $mysqli->prepare("INSERT INTO users (google_id, email, name, profile_picture) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $user_info->id, $user_info->email, $user_info->name, $user_info->picture);
      $stmt->execute();

      $_SESSION['google_loggedin'] = TRUE;
      $_SESSION['user_email'] = $user_info->email;
      $_SESSION['user_name'] = $user_info->name;
      $_SESSION['profile'] = $user_info->picture;

      header('Location: profile.php');
      exit();
    }
  } catch (Exception $e) {
    echo $e;
    exit();
  }
} else {
  header('Location: ' . $client->getAuthUrl());
  exit();
}
