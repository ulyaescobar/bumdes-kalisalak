<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}


require '../functions.php';
$lpg = query("SELECT * FROM lpg");


//cek apakah submit sudah ditekan belum
if (isset($_POST['submit'])) {

    //cek data berhasil ditambahkan atau tidak 
    if (tambahlpg($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'dblpg.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../style/submenu.css">
    <title>lpg</title>
</head>

<body>

    <div class="container">
        <div class="nav">
            <ul>

                <li><a href="../index.php"><i class="material-icons">undo</i>Kembali</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="title">
                <h1>Pendapatan lpg</h1>
            </div>
            <div class="view">

                <table class="demo-table responsive">

                    <thead>
                        <tr>
                            <th scope="col" class="column-primary" data-header="Bulan"><span>No</span></th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0; ?>
                        <?php foreach ($lpg as $row) : ?>
                            <?php
                            $total += $row["jumlah"]
                            ?>
                            <tr>
                                <td data-header="No" class="title"><?= $i; ?></td>
                                <td data-header="Bulan"><?= $row['bulan'] ?></td>
                                <td data-header="Jumlah"><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                <td data-header="Keterangan"><?= $row['keterangan'] ?></td>

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