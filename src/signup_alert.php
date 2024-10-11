<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In Alert</title>
</head>

<body>
  <h1>Alert</h1>
  <?php
  if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message after displaying
  }
  ?>
  <p>Please <a href="index.php">sign up</a>
</body>

</html>
