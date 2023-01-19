<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}


require '../functions.php';
$email = query("SELECT * FROM user");


//cek apakah submit sudah ditekan belum
if (isset($_POST['submit'])) {

    //cek data berhasil ditambahkan atau tidak 
    if (tambahwifi($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'dbwifi.php';
            </script>
        ";
    } else {
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../style/submenu.css">
    <script src="../js/script.js"></script>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <title>Wifi</title>
</head>

<body>

    <div class="container">
        <div class="nav">
            <ul>
                <li><a href="../adminview.php"><i class="material-icons">undo</i>Kembali</a></li>
            </ul>
        </div>

        <div class="content" id="content">
            <div class="title">
                <h1>Pendapatan molen</h1>
            </div>
            <div class="view">

                <table class="demo-table responsive" id="tblExample">

                    <thead>
                        <tr>
                            <th scope="col" class="column-primary" data-header="Bulan"><span>No</span></th>
                            <th scope="col">User Name</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="column-primary">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($email as $row) : ?>

                            <tr>
                                <td data-header="No" class="title"><?= $i; ?></td>
                                <td data-header="Email"><?= $row['email'] ?></td>

                                <td data-header="Role"><?= $row['role'] ?></td>
                                <th scope="row">
                                    <div class="toolbox">
                                        <a href="ubah.php?id=<?= $row['id'] ?>" class="edit"><i class="material-icons">edit</i></a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?');" class="remove"><i class="material-icons">cancel</i></a>
                                    </div>
                                </th>
                            </tr>

                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
            <div class="output">


            </div>

        </div>

    </div>


</body>


</html>