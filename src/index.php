<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
include('database.php');

$client = new Google\Client();
$client->setAuthConfig('./config/client_secret.json');
$client->addScope('email');
$client->addScope('profile');

$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/signup.php');
$signupUrl = $client->createAuthUrl();

$loginClient = clone $client;
$loginClient->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/signin.php');
$loginUrl = $loginClient->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google Signup and Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <div>
      <h1>Sign up</h1>
      <a href="<?= htmlspecialchars($signupUrl) ?>">Sign up with Google</a>
    </div>
    <div>
      <h1>Sign in</h1>
      <a href="<?= htmlspecialchars($loginUrl) ?>">Sign in with Google</a>
    </div>
  </div>
  <script src="../js/scripts.js"></script>
</body>

</html>
