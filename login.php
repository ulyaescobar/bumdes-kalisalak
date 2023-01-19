<?php
session_start();
include('functions.php');

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    $sql = mysqli_query($conn, "SELECT * FROM user where email = '$email'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $hashpassword = $fetch["password"];

        if ($fetch["status"] == 0) {
?>
            <script>
                alert("Please verify email account before login.");
            </script>
        <?php
        } else if (password_verify($password, $hashpassword)) {
        ?>
            <?php
            if (cek_status($email) == 'admin') {
                $_SESSION["login"] = true;
            ?>
                <script>
                    alert("login in successfully");
                    window.location.replace('adminview.php');
                </script>

            <?php
            } else {
                $_SESSION["login"] = true;
            ?>
                <script>
                    alert("login in successfully");
                    window.location.replace('index.php');
                </script>
            <?php
            }
            ?>

        <?php
        } else {
        ?>
            <script>
                alert("email or password invalid, please try again.");
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("email or password invalid, please try again.");
        </script>
<?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/loginregist.css">
    <title>Halaman login</title>
</head>

<body>

    <?php if (isset($error)) : ?>
        <script>
            alert('Username/Password salah!');
            document.location.href = 'login.php';
        </script>
    <?php endif; ?>

    <div class="container">
        <div class="left">
            <div class="header">
                <div class="firstname">Kalisalak</div>
                <div class="lastname">BUMDes</div>
            </div>
            <div class="title">Login</div>
            <div class="wrapper">
                <div class="form login">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="email">email: </label>
                                <input type="text" name="email" id="email" autocomplete="off" required>
                            </li>
                            <li>
                                <label for="password">password</label>
                                <input type="password" name="password" id="password" autocomplete="off" required>
                            </li>
                            <div class="go reg">
                                Belum punya akun? <a href="registrasi.php">Register</a>
                            </div>
                            <div class="go reg" style="margin-top: 10px">
                                Lupa Password? <a href="recover_psw.php">Ubah Password</a>
                            </div>
                            <li>
                                <div class="button ">
                                    <button type="submit" name="login">Login</button>
                                </div>
                            </li>
                        </ul>

                    </form>
                </div>


            </div>
        </div>
        <div class="right">
            <div class="bumdes">
                <div class="bum">BU </div>
                <img src="image/m.png" alt="error image">
                <div class="des">Des</div>
            </div>
            <div class="desc">Kalisalak BUMDes</div>
        </div>
    </div>

</body>

</html>