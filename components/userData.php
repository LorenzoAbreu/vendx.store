<?php
include('../config.php');

  if ($_SESSION['username']) {
    $userDataQuery = "SELECT * FROM `users` WHERE id='" . $_SESSION['id'] . "';";

    $userDataResult = mysqli_query($con, $userDataQuery);
    if (!$userDataResult) {
        die("Error in query: " . mysqli_error($con));
    }

    if (mysqli_num_rows($userDataResult) > 0) {
        while ($row = mysqli_fetch_assoc($userDataResult)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['permissions'] = $row['permissions'];
            $_SESSION['password'] = md5($row['password']);
        }
    } else {
      header('Location: logout.php');
      exit();
    }
  }
?>