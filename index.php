<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

//memanggil functions
require 'functions.php';
$bantuan = query("SELECT * FROM bantuan");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style/dashboarduser.css">
    <title></title>
</head>

<body>


    <header>
        <div class="head">
            <p>Alamat: Jl. Raya, Karangsari</p> |
            <p>Telp: +6282121733053</p>
        </div>
        <div class="logout">
            <a href="logout.php">log out</a>
        </div>
    </header>
    <div class="wrapper content">
        <div class="desc">
            <p>Selamat Datang di</p>
            <h2>Badan Usaha Milik Desa <br>Kalisalak BUMDes</h2>
            <p>Desa Kalisalak, Kecamatan Kebasen, Banyumas</p>
        </div>
        <div class="logo">
            <div class="bumdes">
                <div class="bum">BU </div>
                <img src="image/m.png" alt="error image">
                <div class="des">Des</div>
            </div>
        </div>
    </div>
    <div class="hero">
        <div class="left">
            <a href="#content">Explore</a>
        </div>
        <div class="right">
            <div class="card">
                <p style="text-align: center;">
                    BUMDes Kalisalak adalah badan usaha milik desa kalisalak yang dikelola langsung oleh pengurus BUMDes Desa Kalisalak guna memanfaatkan aset dan menyediakan jasa pelayanan demi kesejahteraan masyarakat desa.
                </p>
            </div>
        </div>
    </div>




    <div id="content">
        <h1>Pendapatan Terkait Program BUMDes</h1>
        <p>Data update setiap sebulan</p>
        <div class="wrapper">
            <div class="card">
                <a href="userview/viewmolen.php"><img src="image/molen.jpg" alt="">Sewa Molen</a>
                <p>layanan peminjaman mesin molen yang dikelola sepenuhnya oleh BUMDes desa Kalisalak melalui sistem sewa yang dimana biaya penyewaan dihitung perharinya. </p>
            </div>
            <div class="card">
                <a href="userview/viewlpg.php"><img src="image/gas.jpg" alt="">Gas LPG 3 Kg</a>
                <p>layanan pengadaan gas LPG 3kg bagi masyarakat desa Kalisalak, khususnya untuk masyarakat miskin yang tepat sasaran dengan pasokan gas sebanyak 20 buah. </p>
            </div>
            <div class="card">
                <a href="userview/viewwifi.php"><img src="image/wifi.jpg" alt="">Pembayaran Wifi</a>
                <p>layanan pembayaran dan pemasangan wifi untuk masyarakat desa Kalisalak yang lebih terjangkau, sehingga masyarakat bisa mengakses layanan internet dengan mudah</p>
            </div>
        </div>
    </div>

    <div id="info">
        <h2>informasi terkait desa kalisalak</h2>
        <div class="wrapper">
            <div class="card">
                <div class="row">
                    <i class="material-icons">map</i>
                    <p>Alamat:<br>Jl. Raya Kalisalak, Karangsari, Kalisalak</p>
                </div>
                <div class="row">
                    <i class="material-icons">email</i>
                    <p>Email:<br><a href="mailto:ulyaescobar@gmail.com" target="_blank"> ulyaescobar@gmail.com</a></p>
                </div>
                <div class="row">
                    <i class="material-icons">call</i>
                    <p>Contact:<br> <a href="https://wa.me/+6282121733053" target="_blank"> +6282121733053</a></p>
                </div>
            </div>
            <a href="https://kalisalak.desa.id/desa-kalisalak/" target="_blank" class="website">Website Desa<br>Kalisalak</a>
        </div>
    </div>

    <footer>Dikelola oleh Pengurus BUMDes Kalisalak</footer>




</body>

</html>