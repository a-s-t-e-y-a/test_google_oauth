<?php
session_start();
require_once 'database.php';

if (isset($_GET['logout'])) {
  $_SESSION = [];
  session_destroy();
  header('Location: index.php');
  exit();
}

if (!isset($_SESSION['google_loggedin']) || $_SESSION['google_loggedin'] !== true) {
  header('Location: index.php');
  exit();
}

$user_id = $_SESSION['user_email'];
$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user_data = $result->fetch_assoc();
} else {
  echo "No user data found.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
</head>

<body>
  <h1>User Profile</h1>
  <p><strong>Name:</strong>
    <?php echo htmlspecialchars($user_data['name']); ?>
  </p>
  <p><strong>Email:</strong>
    <?php echo htmlspecialchars($user_data['email']); ?>
  </p>
  <p><strong>Profile Picture:</strong></p>
  <img src="<?php echo htmlspecialchars($user_data['profile_picture']); ?>" alt="Profile Picture">
  <p><a href="?logout=true">Logout</a></p>
</body>

</html>
