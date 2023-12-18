<?php 
class DataMahasiswa{

    public $id;
    public $nama;
    public $nim;
    public $prodi;
    public $fakultas;
    public $nik;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $email;

    function __construct($data) {
        $this->id = $data["id"];
        $this->nama = $data["nama"];
        $this->nim = $data["nim"];
        $this->prodi = $data["prodi"];
        $this->fakultas = $data["fakultas"];
        $this->nik = $data["nik"];
        $this->tanggal_lahir = $data["tanggal_lahir"];
        $this->jenis_kelamin = $data["jenis_kelamin"];
        $this->email = $data["email"];
    }

    function getData($jenis){
        if($jenis==="nama"){
            return $this->nama;
        }elseif($jenis==="nim"){
            return $this->nim;
        }elseif($jenis==="prodi"){
            return $this->prodi;
        }elseif($jenis==="fakultas"){
            return $this->fakultas;
        }elseif($jenis==="nik"){
            return $this->nik;
        }elseif($jenis==="tanggal_lahir"){
            return $this->tanggal_lahir;
        }elseif($jenis==="jenis_kelamin"){
            return $this->jenis_kelamin;
        }elseif($jenis==="email"){
            return $this->email;
        }
    }

    function getQuery(){
        return "?id=$this->id";
    }

    function getQueryEmail(){
        return "&email=$this->email";
    }
}
?>