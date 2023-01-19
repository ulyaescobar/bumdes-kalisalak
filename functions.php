<?php

//connect ke database
$conn = mysqli_connect("localhost", "root", "", "bumdes");

//show(data) table database
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//tambah molen
function tambahmolen($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $bulan = $data["bulan"];
    $keterangan = $data["keterangan"];
    $jumlah = $data["jumlah"];

    //query insert data
    $query = "INSERT INTO molen VALUES ('', '$bulan', '$jumlah', '$keterangan' )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//sewamolen
function sewamolen($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $nama = $data["nama"];
    $hari = $data["hari"];
    $jumlah = $data["jumlah"];

    //upload bukti
    $bukti = upload();
    if (!$bukti) {
        return false;
    }

    //query insert data
    $query = "INSERT INTO transaksi VALUES ('', '$nama', '$hari', '$jumlah', '$bukti')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//func upload
function upload()
{

    $namaFile = $_FILES['bukti']['name'];
    $ukuranFile = $_FILES['bukti']['size'];
    $error = $_FILES['bukti']['error'];
    $tmp_name = $_FILES['bukti']['tmp_name'];

    //cek apakah tidak ada gambar yg diupload
    if ($error === 4) {
        echo "
            <script>
                alert('Pilih file terlebih dahulu');
            </script>
        ";
        return false;
    }

    //cek ekstensi
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'pdf'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
            <script>
                alert('File yang diupload tidak valid');
            </script>
        ";
        return false;
    }

    //gambar siap upload
    //generate nama baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmp_name, '../buktiTransaksi/' . $namaFileBaru);

    return $namaFileBaru;
}

//tambah lpg
function tambahlpg($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $bulan = $data["bulan"];
    $jumlah = $data["jumlah"];
    $keterangan = $data["keterangan"];

    $check = "SELECT SUM(jumlah) FROM lpg";
    $result = mysqli_query($conn, $check);
    $cast = (int)mysqli_fetch_row($result)[0];
    var_dump($cast);
    if ($cast >= 20) {
        echo "
            <script>
            alert('lpg habis!');
            </script>
        ";
        return false;
    }

    //query insert data
    $query = "INSERT INTO lpg VALUES ('', '$bulan', '$jumlah', '$keterangan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//tambah twifi
function tambahtwifi($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $bulan = $data["bulan"];
    $jumlah = $data["jumlah"];
    $keterangan = $data["keterangan"];

    //query insert data
    $query = "INSERT INTO twifi VALUES ('', '$bulan', '$jumlah', '$keterangan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//hapus molen
function hapusbantuan($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM bantuan WHERE id = $id");
    return mysqli_affected_rows($conn);
}
//hapus bukti sewa
function hapusbuktisewa($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//hapus molen
function hapusmolen($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM molen WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//hapus lpg
function hapuslpg($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM lpg WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//hapus twifi
function hapustwifi($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM twifi WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//hapus user
function hapususer($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//ubah user
function ubahuser($id)
{
    global $conn;

    //cek username udah ada atau belum
    $result = mysqli_query($conn, "SELECT role FROM user WHERE id = '$id'");
    $status = mysqli_fetch_assoc($result)['role'];
    if ($status == "admin") {
        # code...
        $query = "UPDATE user SET role = 'user' WHERE id = '$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    } else {
        # code...
        $query = "UPDATE user SET role = 'admin' WHERE id = '$id'";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}




//ubah molen
function ubahmolen($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $id = $data['id'];
    $bulan = $data["bulan"];
    $keterangan = $data["keterangan"];
    $jumlah = $data["jumlah"];

    //query insert data
    $query = "UPDATE molen SET bulan = '$bulan', jumlah= $jumlah, keterangan = '$keterangan' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//ubah lpg
function ubahlpg($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $id = $data['id'];
    $bulan = $data["bulan"];
    $jumlah = $data["jumlah"];
    $keterangan = $data["keterangan"];

    //query insert data
    $query = "UPDATE lpg SET bulan = '$bulan', jumlah= $jumlah, keterangan = '$keterangan' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//ubah twifi
function ubahtwifi($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $id = $data['id'];
    $bulan = $data["bulan"];
    $jumlah = $data["jumlah"];
    $keterangan = $data["keterangan"];

    //query insert data
    $query = "UPDATE twifi SET bulan = '$bulan', jumlah = $jumlah, keterangan = '$keterangan' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


//cek status user
function cek_status($nama)
{
    global $conn;

    $query = "SELECT role FROM user where email = '$nama'";
    $result = mysqli_query($conn, $query);
    $status = mysqli_fetch_assoc($result)['role'];

    return $status;
}






//form regist
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    //cek username udah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if ($username == "" or $password == "" or $password2 == "") {
        echo "<script>
            alert('lengkapi datanya')
        </script>";
        return false;
    }

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah terdaftar!')
        </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai!')
        </script>";
        return false;
    }


    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', 'user')");

    return mysqli_affected_rows($conn);
}
