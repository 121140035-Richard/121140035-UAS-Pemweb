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

$dataId = 0;

//jika terdapat query id maka edit data
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $mahasiswa = query_output("SELECT * FROM data_mahasiswa WHERE id=$id");
    $dataId = $_GET["id"];
}

// jika tombol submit ditekan
if(isset($_POST["submit"])){
    //memasukkan data ke table
    $edit = query_update($_POST, $dataId);
    $register = register($_POST["email"], $_POST["nim"]);

    if( $edit > 0 && $register>0){
        if($dataId==0){
            echo "
            <script>
                alert(`Data berhasil ditambahkan!`);
            </script>
            ";
        }else{
            echo "
            <script>
                alert(`Data berhasil diubah!`);
                window.location.href = 'index.php';
            </script>
            ";
        }
    } else{
        if($dataId==0){
            echo "
            <script>
                alert(`Data gagal ditambahkan!`);
            </script>
            ";
        }else{
            echo "
            <script>
                alert(`Data gagal diubah!`);
                window.location.href = 'index.php';
            </script>
            ";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UAS</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/input.css">
    </head>

    <body onload="loadData()">
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

        <main>
            <h1>Input/Edit Data Mahasiswa</h1>

            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <img src="image/logo.png" alt="...">
                        <h3>Institut Teknologi Sumatera</h3>
                    </div>

                    <div class="card-body">
                        <img src="image/img_placeholder.jpg" alt="...">
                        <div class="card-detail">
                            <p>Nama</p>
                            <p>NIM</p>
                            <p>Prodi</p>
                            <p>Gender</p>
                        </div>

                        <div class="card-data">
                            <p>: <span id="nama_card"></span></p>
                            <p>: <span id="nim_card"></span></p>
                            <p>: <span id="prodi_card"></span></p>
                            <p>: <span id="gender_card"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="" method="post">
                <div class="body-input-1">
                    <div class="input-item">
                        <label>Nama</label>
                        <input type="text" required name="nama" onkeyup="changeCardDetail(this,nama_card)" id="nama"
                        <?php if($dataId>0): ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            value='<?php echo $mhs["nama"]; ?>'
                            <?php endforeach ?>
                        <?php endif ?>>
                    </div>
                    
                    <div class="input-item">
                        <label>NIM</label>
                        <input type="number" required name="nim" onkeyup="changeCardDetail(this,nim_card)" id="nim"
                        <?php if($dataId>0): ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            value='<?php echo $mhs["nim"]; ?>'
                            <?php endforeach ?>
                        <?php endif ?>>
                    </div>
                    
                    <div class="input-item">
                        <label>Prodi</label>
                        <input type="text" required name="prodi" onkeyup="changeCardDetail(this,prodi_card)" id="prodi"
                        <?php if($dataId>0): ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            value='<?php echo $mhs["prodi"]; ?>'
                            <?php endforeach ?>
                        <?php endif ?>>
                    </div>
    
                    <div class="input-item">
                        <label>Fakultas</label>
                        <select required name="fakultas">
                            <option
                            <?php if($dataId>0): ?>
                                <?php foreach($mahasiswa as $mhs):?>
                                    <?php $fakultas=$mhs["fakultas"]; ?>
                                    selected value = '<?php echo $fakultas; ?>'
                                    <?php endforeach ?>  
                                <?php else: ?>selected value = ''
                            <?php endif ?>><?php if($dataId>0): ?><?php echo $fakultas?>
                                <?php else: ?>
                                <?php endif ?>
                            </option>
                            <option value="Sains">Sains</option>
                            <option value="Teknologi Infrastruktur dan Kewilayahan">Teknologi Infrastruktur dan Kewilayahan</option>
                            <option value="Teknologi Industri">Teknologi  Industri</option>
                        </select>
                    </div>
                </div>

                <div class="body-input-2">
                    <div class="input-item">
                        <label>NIK</label>
                        <input type="number" required name="nik"
                        <?php if($dataId>0): ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            value='<?php echo $mhs["nik"]; ?>'
                            <?php endforeach ?>
                        <?php endif ?>>
                    </div>

                    <div class="input-item">
                        <label>Tanggal Lahir</label>
                        <input type="date" required name="tanggal_lahir"
                        <?php if($dataId>0): ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            value='<?php echo $mhs["tanggal_lahir"]; ?>'
                            <?php endforeach ?>
                        <?php endif ?>>
                    </div>

                    <div class="input-item">
                        <label>Jenis Kelamin</label>
                        <select required name="jenis_kelamin" onchange="changeCardDetail(this,gender_card)" id="jenis_kelamin">
                            <option
                            <?php if($dataId>0): ?>
                                <?php foreach($mahasiswa as $mhs):?>
                                    <?php $jenis_kelamin=$mhs["jenis_kelamin"]; ?>
                                    selected value = '<?php echo $jenis_kelamin; ?>'
                                    <?php endforeach ?>
                                    <?php else: ?>selected value = ''
                            <?php endif ?>><?php if($dataId>0): ?><?php echo $jenis_kelamin?>
                                <?php else: ?>
                                <?php endif ?>
                            </option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
    
                    <div class="input-item">
                        <label>Email</label>
                        <input type="email" required name="email"
                        <?php if($dataId>0): ?>
                            <?php foreach($mahasiswa as $mhs):?>
                            value='<?php echo $mhs["email"]; ?>'
                            <?php endforeach ?>
                        <?php endif ?>>
                    </div>
                </div>

                <div class="body-input-3">
                    <button class="submit-btn" type="submit" name="submit">Submit</button>
                </div>
            </form>
        </main>

        <footer>
            Copyright : Richard Arya Winarta - 121140035
        </footer>

        <script src="js/script.js"></script>
    </body>
</html>