<?php 
//koneksi ke database
$server = "localhost";
$user = "root";
$password = "";
$database = "uas";
$connection = mysqli_connect($server, $user, $password, $database);

function checkData($id){
    global $connection;
    $checkId = (mysqli_query($connection, "SELECT EXISTS(SELECT * FROM data_mahasiswa WHERE id=$id) as existance"));
    $data = mysqli_fetch_assoc($checkId);
    return $data["existance"];
}

function checkEmail($email){
    global $connection;
    $checkdata = (mysqli_query($connection, "SELECT EXISTS(SELECT * FROM akun WHERE email='$email') as existance"));
    $data = mysqli_fetch_assoc($checkdata);
    return $data["existance"];
}

function query_output($query){
    global $connection;

    //fetching data dari tabel
    $result = mysqli_query($connection, $query);

    $rows = [];

    //fetching data setiap row
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function query_update($data, $id){
    $isExist = checkData($id);

    global $connection;

    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $prodi = htmlspecialchars($data["prodi"]);
    $fakultas = htmlspecialchars($data["fakultas"]);
    $nik = htmlspecialchars($data["nik"]);
    $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $email = htmlspecialchars($data["email"]);

    if($isExist == 0){
        // query insert row ke table
        $query = "INSERT INTO data_mahasiswa VALUES
                ('',
                '$nama', '$nim', '$prodi', '$fakultas',
                '$nik', '$tanggal_lahir', '$jenis_kelamin', '$email')";
    
        mysqli_query($connection, $query);
    }else{
        // query update row table
        $query = "UPDATE data_mahasiswa SET
                nama='$nama', nim='$nim', prodi='$prodi', fakultas='$fakultas',
                nik='$nik', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin',
                email='$email' WHERE id=$id";
    
        mysqli_query($connection, $query);
    }
    
    // informasi penambahan data
    $info = mysqli_affected_rows($connection);

    return $info;
}

function query_hapus($id){
    global $connection;

    // query hapus row di table
    $query = "DELETE FROM data_mahasiswa WHERE id=$id";
    
    mysqli_query($connection, $query);

    // informasi penghapusan data

    $info = mysqli_affected_rows($connection);

    return $info;
}

function getBrowserInfo(){
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';

    // Next get the name of the user agent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'IE'; 

    } else if(preg_match('/Firefox/i',$u_agent))
    { 
        $bname = 'Mozilla Firefox'; 

    } else if(preg_match('/Chrome/i',$u_agent) && (!preg_match('/Opera/i',$u_agent) && !preg_match('/OPR/i',$u_agent))) 
    { 
        $bname = 'Chrome'; 

    } else if(preg_match('/Safari/i',$u_agent) && (!preg_match('/Opera/i',$u_agent) && !preg_match('/OPR/i',$u_agent))) 
    { 
        $bname = 'Safari'; 

    } else if(preg_match('/Opera/i',$u_agent) || preg_match('/OPR/i',$u_agent)) 
    { 
        $bname = 'Opera'; 

    } else if(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 

    } else if((isset($u_agent) && (strpos($u_agent, 'Trident') !== false || strpos($u_agent, 'MSIE') !== false)))
    {
        $bname = 'Internet Explorer'; 
    } 

    return array(
        'user_agent' => $u_agent,
        'browser'    => $bname
    );
}

function register($email, $nim){
    $isExist = checkEmail($email);
    global $connection;

    $password = password_hash($nim, PASSWORD_DEFAULT);
    $ip = $_SERVER['REMOTE_ADDR'];
    $browser = getBrowserInfo();
    $browser_name = $browser['browser'];

    if($isExist == 0){
        // query insert row ke table
        $query = "INSERT INTO akun VALUES
                ('','$email','$password','$ip','$browser_name')";
    
        mysqli_query($connection, $query);
    }else{
        // query update row table
        $query = "UPDATE akun SET
                email='$email', password='$password', ip='$ip', 
                browser='$browser_name'
                WHERE email='$email'";
    
        mysqli_query($connection, $query);
    }

     // informasi penambahan data
     $info = mysqli_affected_rows($connection);

     return $info;
}
?>