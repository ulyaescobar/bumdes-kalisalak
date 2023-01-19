<?php session_start(); ?>
<?php
include('connect/connection.php');

if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $check_query = mysqli_query($connect, "SELECT * FROM user where email ='$email'");
    $rowCount = mysqli_num_rows($check_query);

    if (!empty($email) && !empty($password)) {
        if ($rowCount > 0) {
?>
            <script>
                alert("User with email already exist!");
            </script>
            <?php
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $result = mysqli_query($connect, "INSERT INTO user (id, email, password, status, role) VALUES ('', '$email', '$password_hash', 0, 'user')");

            if ($result) {
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
                require "Mail/phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';

                $mail->Username = 'ferdowsambo@gmail.com';
                $mail->Password = 'bwjzehrqrrjmgrjx';

                $mail->setFrom('ferdowsambo@gmail.com', 'OTP Verification');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject = "Your verify code";
                $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Programming with Lam</b>
                    https://www.youtube.com/channel/UCKRZp3mkvL1CBYKFIlxjDdg";

                if (!$mail->send()) {
            ?>
                    <script>
                        alert("<?php echo "Register Failed, Invalid Email " ?>");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                        window.location.replace('verification.php');
                    </script>
<?php
                }
            }
        }
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
    <title>Document</title>
</head>

<body>

    <div class="container ">
        <div class="left">
            <div class="header">
                <div class="firstname">Kalisalak</div>
                <div class="lastname">BUMDes</div>
            </div>
            <div class="title">Register</div>
            <div class="wrapper">
                <div class="form registrasi">
                    <form action="" method="post">
                        <ul>
                            <li>
                                <label for="email">email: </label>
                                <input type="text" name="email" id="email" autocomplete="off">
                            </li>
                            <li>
                                <label for="password">password: </label>
                                <input type="password" name="password" id="password" autocomplete="off">
                            </li>

                            <div class="go log">
                                Kembali ke <a href="login.php">Login</a>
                            </div>
                            <div class="button">
                                <button type="submit" name="register">Register!</button>
                            </div>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="bumdes">
                <div class="bum">BU</div>
                <img src="image/m.png" alt="error image">
                <div class="des">Des</div>
            </div>
            <div class="desc">Kalisalak BUMDes</div>
        </div>
    </div>

</body>

</html>