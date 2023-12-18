<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

if(!isset($_SESSION["admin"])){
    header("Location: dashboard.php");
    exit;
}

//memanggil fungsi query
require 'functions.php';
require 'class.php';

$mahasiswa = query_output("SELECT * FROM data_mahasiswa");

//pencarian menggunakan query NIM
if (isset($_POST["cari"])) {
    $nim = $_POST["query"];
    $mahasiswa = query_output("SELECT * FROM data_mahasiswa WHERE nim LIKE '$nim'");
}

if (isset($_POST["filter"])){
    $fakultas = $_POST["fakultas"];
    $mahasiswa = query_output("SELECT * FROM data_mahasiswa WHERE fakultas='$fakultas'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header>
        <div class="header-detail">
            <img src="image/logo.png" alt="...">
            <h1>Sistem Informasi Akademik Institut Teknologi Sumatera</h1>
        </div>

        <div class="navigation">
            <a href="index.php">Daftar Mahasiswa</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <h1 id="title">Daftar Mahasiswa</h1>

    <div class="controller">
        <a href="input.php">Tambah Data Mahasiswa</a>

        <form action="" method="post" id="search">
            <label> Pencarian : </label>
            <input type="text" name="query" autofocus placeholder="Masukkan NIM" autocomplete="off">
            <button type="submit" name="cari">Cari!</button>
        </form>

        <form action="" method="post" id="filter">
            <label> Filter : </label>
            <select name="fakultas">
                <option selected value=""></option>
                <option value="Sains">Sains</option>
                <option value="Teknologi Infrastruktur dan Kewilayahan">Teknologi Infrastruktur dan Kewilayahan</option>
                <option value="Teknologi Industri">Teknologi Industri</option>
            </select>
            <button type="submit" name="filter">Go!</button>
            <button type="submit">Reload</button>
        </form>
    </div>

    <table cellspacing="0">
        <tr>
            <th>No</th>
            <th>Edit</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Fakultas</th>
            <th>NIK</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
        </tr>
        <?php $count = 1; ?>
        <!-- Loop data table -->
        <?php foreach ($mahasiswa as $row) : ?>
            <?php $data = new DataMahasiswa($row); ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td>
                    <a href="input.php<?= $data->getQuery() ?>">Ubah</a> |
                    <a href="hapus.php<?= $data->getQuery() ?><?= $data->getQueryEmail() ?>" onclick="return confirm('Apakah anda yakin?');">Hapus</a>
                </td>
                <td><?php echo $data->getData("nama") ?></td>
                <td><?php echo $data->getData("nim") ?></td>
                <td><?php echo $data->getData("prodi") ?></td>
                <td><?php echo $data->getData("fakultas") ?></td>
                <td><?php echo $data->getData("nik") ?></td>
                <td><?php echo $data->getData("tanggal_lahir") ?></td>
                <td><?php echo $data->getData("jenis_kelamin") ?></td>
                <td><?php echo $data->getData("email") ?></td>
            </tr>
            <?php $count++; ?>
        <?php endforeach ?>
        <!-- ---------------- -->
    </table>

    <footer>
        Copyright : Richard Arya Winarta - 121140035
    </footer>
</body>

</html>