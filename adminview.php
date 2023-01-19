<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

//memanggil functions
require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style/adminhome.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="nav">
            <ul>
                <li><a href="adminview.php" class="active"><i class="material-icons">home</i> Home</a></li>
                <li><a href="dbuser/dbuser.php"><i class="material-icons">list</i> Data User</a></li>
                <!-- <li><a href="bantuan/bantuan.php"><i class="material-icons">money</i> Bantuan</a></li> -->
                <li><a href="transaksi/transaksi.php"><i class="material-icons">done</i> Transaksi</a></li>
                <li><a href="logout.php"><i class="material-icons">logout</i>Log Out</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="wrapper menu">
                <a href="molen/dbmolen.php"><img src="image/molen.jpg" alt="">Sewa Molen</a>
                <a href="lpg/dblpg.php"><img src="image/gas.jpg" alt="">Gas LPG 3 Kg</a>
                <a href="wifi/dbwifi.php"><img src="image/wifi.jpg" alt="">Pembayaran Wifi</a>
            </div>
        </div>
    </div>

</body>

</html>