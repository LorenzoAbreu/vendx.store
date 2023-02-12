<?php

  $dbHost = 'bm4egdpnz3mehjydl3bj-mysql.services.clever-cloud.com';
  $dbUsername = 'umhsrvmszweyriyp';
  $dbPassword = 'PCbHYyiNz3iYYgFySJtY';
  $dbName = 'bm4egdpnz3mehjydl3bj';

  $con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>