<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['email']) && isset($_COOKIE['key'])) {
    $email = $_COOKIE['email'];
    $password = isset($_COOKIE['key']);

    $result = mysqli_query($connection, "SELECT password FROM akun WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan password
    if ($password == hash('sha256', $row['password'])) {
        $_SESSION["login"] = true;
    }
}

if(isset($_SESSION["login"])){
    if($_COOKIE['email']=="admin@itera.id"){
        header("Location: index.php");
        exit;
    }elseif($_COOKIE['email']!="admin@itera.id"){
        header("Location: dashboard.php");
        exit;
    }
}

$isFalse = false;

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $isExist = checkEmail($email);

    if ($isExist != 0) {
        $akun = query_output("SELECT * FROM akun WHERE email LIKE '$email'");

        foreach ($akun as $dataAkun) {
            if (
                $email == $dataAkun["email"] &&
                password_verify($password, $dataAkun["password"]) &&
                $email == 'admin@itera.id'
            ) {
                //session verification
                $_SESSION["login"] = true;
                $_SESSION["admin"] = true;
                $_SESSION["user"] = $dataAkun["email"];

                //remember me
                if (isset($_POST["remember"])) {
                    setcookie('email', $email, time() + 600);
                    setcookie('key', hash('sha256', $password), time() + 600);
                }

                header("Location: index.php");
            } elseif (
                $email == $dataAkun["email"] &&
                password_verify($password, $dataAkun["password"])
            ) {
                $_SESSION["login"] = true;
                $_SESSION["user"] = $dataAkun["email"];

                //remember me
                if (isset($_POST["remember"])) {
                    setcookie('email', $email, time() + 600);
                    setcookie('key', hash('sha256', $password), time() + 600);
                }
                
                header("Location: dashboard.php?email='$email'");
            } else {
                $isFalse = true;
            }
        }
    } else {
        $isFalse = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php echo "email default admin : admin@itera.id, password admin = 123"; ?>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <?php if ($isFalse == true) : ?>
                <h3 class="notification">Email atau password anda salah</h3>
            <?php endif ?>

            <div class="field">
                <input type="email" name="email" id="email" placeholder="..." required>
                <label for="email">Email</label>
            </div>

            <div class="field">
                <input type="password" name="password" id="password" placeholder="..." required>
                <label for="password">Password</label>
            </div>

            <div class="checkbox">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <div class="button">
                <button type="submit" name="login">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>

</html>