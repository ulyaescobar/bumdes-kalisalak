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
$user = query("SELECT * FROM user WHERE id = $id")[0];

// var_dump([0], $molen);


if (ubahuser($id) == true) {
    echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'dbuser.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'dbuser.php';
        </script>
    ";
}
