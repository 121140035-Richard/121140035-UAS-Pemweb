<?php 
session_start();
require 'functions.php';

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

if(!isset($_SESSION["admin"])){
    header("Location: dashboard.php");
    exit;
}

$id_mahasiswa = $_GET["id"];

$hapus = query_hapus($id_mahasiswa);

if( $hapus > 0 ){
    echo "
    <script>
        alert('Data berhasil dihapus!');
    </script>
    ";
} else{
    echo "
    <script>
        alert('Data gagal dihapus!');
    </script>
    ";
}

$page = 'index.php';
header('Location: '.$page);

?>