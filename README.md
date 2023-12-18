# 121140035-UAS-Pemweb

Nama : Richard Arya Winarta

NIM : 121140035

Kelas : RB

##Bagian 1

1.1 <br>
- Halaman web untuk menampung input dibuat dalam login.php dan input.php yang terdiri dari elemen input teks, checkbox, select, email, dsb. <br>
- Menampilkan data dari server dan database ke halaman index.php yang dapat diakses melalui akun admin. (email admin : admin@itera.id, password admin : 123)

1.2 <br>
- Event untuk menghandle form melalui dan validasi menggunakan javascript berada pada halaman input.html dan script.js. Pada kedua file php tersebut DOM pada kartu dimanipulasi sesuai dengan inputan pengguna.<br>

##Bagian 2

2.1 <br>
- Implementasi script PHP berada pada halaman login.php dan input.php. Keduanya menggunakan method post untuk menyimpan data dari form. <br>
- Pengaksesan dilakukan melalui variabel super global $_POST yang berfungsi untuk validasi login di sisi server.<br>
- Koneksi ke database berada dalam file functions.php. Pembuatan fungsi ini memungkinkan pengaksesan database dilakukan berulang-ulang. database dengan nama "id21685619_uas" memiliki 2 table yaitu "data_mahasiswa" dan "akun". Table "akun" menampung atribut jenis browser dan alamat IP pengguna.

2.2 <br>
- Objek PHP dibuat dalam file class.php. Nama class yang dibuat adalah DataMahasiswa dengan constructor dan 3 fungsi tambahan. Class ini berfungsi untuk mengakses data dari variable superglobal $_POST[];

##Bagian 3

3.1 <br>
- Tabel dibuat dengan menggunakan syntax "CREATE TABLE data_mahasiswa (id int auto_increment primary key, nama varchar(200), nim varchar(10), prodi varchar(200), fakultas varchar(200), nik varchar(20), tanggal_lahir date, jenis_kelamin varchar(200), email varchar(200);.

3.2 <br>
- Konfigurasi koneksi ke database mysql dilakukan pada fungsi di file functions.php. Koneksi dibuat dengan menggunakan konstanta : <br>
$server = "localhost";
$user = "id21685619_root";
$password = "Itera123#";
$database = "id21685619_uas";
$connection = mysqli_connect($server, $user, $password, $database);<br>
Query-query yang digunakan antara lain:<br>
SELECT EXISTS(SELECT * FROM data_mahasiswa WHERE id=$id) as existance")
INSERT INTO data_mahasiswa VALUES
                ('',
                '$nama', '$nim', '$prodi', '$fakultas',
                '$nik', '$tanggal_lahir', '$jenis_kelamin', '$email')
  UPDATE akun SET
                email='$email', password='$password', ip='$ip', 
                browser='$browser_name'
                WHERE email='$email'
  DELETE FROM data_mahasiswa WHERE id=$id

 ##Bagian 4

 4.1 <br>
- Session digunakan di setiap file untuk menjamin akses pengguna terhadap halaman html. Session dimulai dengan menuliskan session_start(); di awal php. Contoh penggunaan session dapat dilihat pada file login.php yaitu <br>
$_SESSION["login"] = true;
$_SESSION["admin"] = true;
$_SESSION["user"] = $dataAkun["email"];

4.2 <br>
- Penggunaan cookie digunakan untuk menyimpan identitas pengguna pada storage local browser. Contoh penggunaan cookie "remember me" dapat dilihat pada file login.php yaitu <br>
if (isset($_POST["remember"]))
    setcookie('email', $email, time() + 600);
    setcookie('key', hash('sha256', $password), time() + 600);<br>
Penghapusan cookie dilakukan dengan <br>
setcookie('email', '', time()-3600);
setcookie('key', '', time()-3600);

##Bagian Bonus

Link website : https://121140035.000webhostapp.com <br>

1. Cara menghosting web dimulai dengan membuat database terlebih dahulu pada server hosting yang kemudian mengupload file php yang ingin ditampilkan ke layar pengguna melalui file manager dari server hosting. <br>
2. Penyedia web hosting yang cocok untuk saya gunakan pada tugas besar ini adalah 000webhostapp karena web hosting ini gratis. <br>
3. Untuk memastikan keamanan website, email dan password saya dibuat dengan keunikan yang tinggi sehingga dapat mencegah orang yang tidak diinginkan untuk mengakses database manager dan file manager website saya. <br>
4. Konfigurasi server yang saya gunakan adalah file manager untuk menampung file-file php, css, dan script. Yang kedua adalah database manager untuk menampung database sql yang sudah saya buat.
