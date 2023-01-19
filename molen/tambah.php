<?php
session_start();

if (!isset ($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "../functions.php";

//cek apakah submit sudah ditekan belum
if(isset($_POST['submit'])){

    //cek data berhasil ditambahkan atau tidak 
    if (tambahmolen($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'dbmolen.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'tambah.php';
            </script>
        ";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data barang</title>
</head>
<body>
    <h1>Tambah data barang</h1>
    <a href="dbmolen.php">kembali</a>


    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">Nama Penyewa</label>
                <input type="text" name="nama" id="nama" required autocomplete="off">
            </li>
            <li>
                <label for="hari">Hari</label>
                <input type="text" name="hari" id="hari" required autocomplete="off">
            </li>
            <li>
                <label for="jumlah">jumlah</label>
                <input type="text" name="jumlah" id="jumlah" required autocomplete="off">
            </li>
            <li><button type="submit" name="submit">Tambah data</button></li>
        </ul>

    </form>

</body>
</html>