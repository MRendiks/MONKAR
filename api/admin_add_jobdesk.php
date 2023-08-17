<?php 
require 'connect_db.php';

$nama_lengkap   = $_POST['nama_lengkap'];
$kategori_job   = $_POST['kategori_job'];
$nama_proyek   = $_POST['nama_proyek'];
$deadline = $_POST['deadline'];

$query = "SELECT id_karyawan FROM karyawan WHERE Nama_lengkap='$nama_lengkap'";
$ekskusi = mysqli_query($koneksi, $query);
while($data = mysqli_fetch_array($ekskusi)){
    $id_karyawan =  $data['id_karyawan'];
};


$query      = "INSERT INTO jobdesk VALUES('', '$id_karyawan', '$kategori_job', '$nama_proyek', '', '', '$deadline', 'Belum Selesai')";
$odj_query  = mysqli_query($koneksi, $query);

if ($odj_query) {
    echo json_encode(
        array(
            'response' => true,
        )
    );
}else {
    echo json_encode(
        array(
            'response' => false,
        )
    );
}

header('Content-Type: application/json');



?>