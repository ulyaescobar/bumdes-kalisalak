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
    $nama = $data["nama"];
    $hari = $data["hari"];
    $jumlah = $data["jumlah"];

    //query insert data
    $query = "INSERT INTO molen VALUES ('', '$nama', '$hari', '$jumlah')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//tambah wifi
function tambahwifi($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $nama = $data["nama"];
    $jumlah = $data["jumlah"];
    $keterangan = $data["keterangan"];

    //query insert data
    $query = "INSERT INTO wifi VALUES ('', '$nama', '$jumlah', '$keterangan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//hapus molen
function hapusmolen($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM molen WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//hapus wifi
function hapuswifi($id)
{

    global $conn;
    mysqli_query($conn, "DELETE FROM wifi WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//ubah molen
function ubahmolen($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $id = $data['id'];
    $nama = $data["nama"];
    $hari = $data["hari"];
    $jumlah = $data["jumlah"];

    //query insert data
    $query = "UPDATE molen SET nama = '$nama', hari = $hari, jumlah= $jumlah WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//ubah wifi
function ubahwifi($data)
{
    global $conn;
    //ambil data dari tiap form dibawah tadi
    $id = $data['id'];
    $nama = $data["nama"];
    $jumlah = $data["jumlah"];
    $keterangan = $data["keterangan"];

    //query insert data
    $query = "UPDATE wifi SET nama = '$nama', jumlah = $jumlah, keterangan = '$keterangan' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


//cek status user
function cek_status($nama)
{
    global $conn;

    $query = "SELECT role FROM user where username = '$nama'";
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
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', 0)");

    return mysqli_affected_rows($conn);
}
