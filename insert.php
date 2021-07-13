<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$address= $_POST['address'];
$alorol = $_POST['alorol'];
$agree = $_POST['agree'];
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "dbinsieme";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
      $SELECT = "SELECT phone From reg Where phone = ? Limit 1";
      $INSERT = "INSERT INTO reg (name, phone, address, alorol,agree) values (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("i", $phone);
    $stmt->execute();
    $stmt->bind_result($phone);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum==0) {
      $stmt->close();

      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sisss", $name, $phone, $address, $alorol, $agree);
      $stmt->execute();
      header('Location:registered.html');
    }else {
      header('Location:usednum.html');
    }
    $stmt->close();
    $conn->close();
 }


?>
