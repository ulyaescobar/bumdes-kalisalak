<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}


require '../functions.php';
$molen = query("SELECT * FROM molen");


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
    <script src="../js/script.js"></script>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <title>molen</title>
</head>

<body>

    <div class="container">
        <div class="nav">
            <ul>
                <li><a class="button" data-modal="modalOne"><i class="material-icons">add</i>Tambah Data</a></li>
                <li>
                    <div class="button"><button onclick="generatePDF()">Print</button></div>
                </li>
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
                            <th scope="col">Bulan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col" class="column-primary">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0; ?>
                        <?php foreach ($molen as $row) : ?>
                            <?php
                            $total += $row["jumlah"]
                            ?>
                            <tr>
                                <td data-header="No" class="title"><?= $i; ?></td>
                                <td data-header="Bulan"><?= $row['bulan'] ?></td>
                                <td data-header="Jumlah"><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                <td data-header="Keterangan"><?= $row['keterangan'] ?></td>
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
                <p>
                    Total pendapatan Rp. <?= number_format($total, 0, ',', '.')  ?>
                </p>

            </div>

        </div>

    </div>


    <!-- 
    Tambah data -->

    <div id="modalOne" class="modal">
        <div class="modal-content">
            <div class="contact-form">
                <a class="close">&times;</a>
                <form action="" method="post">
                    <h2 style="margin-bottom: 30px;">Tambah Data</h2>
                    <div>
                        <input type="text" name="bulan" placeholder="Bulan" autocomplete="off" required />
                        <input type="text" name="jumlah" placeholder="Jumlah" autocomplete="off" required />
                        <input type="text" name="keterangan" placeholder="Keterangan" autocomplete="off" required />
                    </div>
                    <button type="submit" name="submit">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>



    <script>
        let modalBtns = [...document.querySelectorAll(".button")];
        modalBtns.forEach(function(btn) {
            btn.onclick = function() {
                let modal = btn.getAttribute("data-modal");
                document.getElementById(modal).style.display = "block";
            };
        });
        let closeBtns = [...document.querySelectorAll(".close")];
        closeBtns.forEach(function(btn) {
            btn.onclick = function() {
                let modal = btn.closest(".modal");
                modal.style.display = "none";
            };
        });
        window.onclick = function(event) {
            if (event.target.className === "modal") {
                event.target.style.display = "none";
            }
        };
    </script>






</body>

</html>