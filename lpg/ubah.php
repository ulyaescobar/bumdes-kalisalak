<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "../functions.php";

//ambil data di url
$id = $_GET['id'];
//query data berdasarkan id
$lpg = query("SELECT * FROM lpg WHERE id = $id")[0];

// var_dump([0], $lpg);


//cek apakah submit sudah ditekan belum
if (isset($_POST['submit'])) {

    //cek data berhasil diubah atau tidak 
    if (ubahlpg($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'dblpg.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'dblpg.php';
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
    <link rel="stylesheet" href="../style/styleupdate.css">
    <title>ubah data barang</title>
</head>

<body>

    <div class="form-style-8">
        <h2>Ubah Data</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $lpg['id'] ?>" />

            <input type="text" name="bulan" placeholder="Bulan" id="bulan" required autocomplete="off" value="<?= $lpg["bulan"] ?>" />

            <input type="text" name="jumlah" placeholder="Jumlah" id="jumlah" required autocomplete="off" value="<?= $lpg["jumlah"] ?>" />

            <input type="text" name="keterangan" placeholder="Keterangan" id="keterangan" required autocomplete="off" value="<?= $lpg["keterangan"] ?>" />

            <input type="submit" name="submit" value="Ubah Data" />
        </form>
    </div>

    <script type="text/javascript">
        //auto expand textarea
        function adjust_textarea(h) {
            h.style.height = "20px";
            h.style.height = (h.scrollHeight) + "px";
        }
    </script>

</body>

</html>