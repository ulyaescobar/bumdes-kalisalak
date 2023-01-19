<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}


require '../functions.php';
$transaksi = query("SELECT * FROM transaksi");


//cek apakah submit sudah ditekan belum
if (isset($_POST['submit'])) {

    //cek data berhasil ditambahkan atau tidak 
    if (tambahmolen($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'dbmolen.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'dbmolen.php';
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
    <title>molen</title>
</head>

<body>

    <div class="container">
        <div class="nav">
            <ul>
                <li><a href="../adminview.php"><i class="material-icons">undo</i>Kembali</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="title">
                <h1>Bukti Sewa Molen</h1>
            </div>
            <div class="view">

                <table class="demo-table responsive">

                    <thead>
                        <tr>
                            <th scope="col" class="column-primary" data-header="Bulan"><span>No</span></th>
                            <th scope="col">Nama</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col" class="column-primary">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0; ?>
                        <?php foreach ($transaksi as $row) : ?>
                            <?php
                            $total += $row["jumlah"]
                            ?>
                            <tr>
                                <td data-header="No" class="title"><?= $i; ?></td>
                                <td data-header="Nama"><?= $row['nama'] ?></td>
                                <td data-header="Hari"><?= number_format($row['hari'], 0, ',', '.') ?></td>
                                <td data-header="Jumlah"><?= $row['jumlah'] ?></td>
                                <th scope="row">
                                    <div class="toolbox">
                                        <a href="../buktiTransaksi/<?= $row['bukti'] ?>" class="edit"><i class="material-icons">list</i></a>
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
                <p style="visibility: hidden">
                    Total pendapatan Rp. <?= number_format($total, 0, ',', '.')  ?>
                </p>
            </div>

        </div>

    </div>




</body>

</html>