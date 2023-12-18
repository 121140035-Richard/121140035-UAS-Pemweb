<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

if(!isset($_GET["email"])){
    header("Location: logout.php");
    exit;
}

if(isset($_SESSION["admin"])){
    header("Location: index.php");
    exit;
}

$email = $_GET["email"];
$result = mysqli_query($connection, "SELECT * FROM data_mahasiswa WHERE email=$email");
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <header>
        <div class="header-detail">
            <img src="image/logo.png" alt="...">
            <h1>Sistem Informasi Akademik Institut Teknologi Sumatera</h1>
        </div>

        <div class="navigation">
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <main>
        <h1>Selamat datang! <?php echo $row["nama"] ?></h1>

        <h2>Data Diri Anda : </h2>
        <h2 class="data">NIM : <?php echo $row["nim"]?></h2>
        <h2 class="data">NIK : <?php echo $row["nik"]?></h2>
        <h2 class="data">Prodi : <?php echo $row["prodi"]?></h2>
        <h2 class="data">Fakultas : <?php echo $row["fakultas"]?></h2>
        <h2 class="data">Tanggal Lahir : <?php echo $row["tanggal_lahir"]?></h2>
        <h2 class="data">Jenis Kelamin : <?php echo $row["jenis_kelamin"]?></h2>
        <h2 class="data">Email : <?php echo $row["email"]?></h2>
    </main>

    <footer>
        Copyright : Richard Arya Winarta - 121140035
    </footer>
</body>

</html>