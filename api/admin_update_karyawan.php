<?php 
require 'connect_db.php';

$id_karyawan    = $_GET['id_karyawan'];
$username       = $_GET['username'];
$nama_lengkap   = $_GET['nama_lengkap'];
$password       = $_GET['password'];
$nik            = $_GET['nik'];
$jenis_kelamin  = $_GET['jenis_kelamin'];


$query      = "UPDATE karyawan SET username='$username', password='$password', Nama_Lengkap='$nama_lengkap', NIK='$nik', Jenis_Kelamin='$jenis_kelamin' WHERE id_karyawan='$id_karyawan'";
$odj_query  = mysqli_query($koneksi, $query) or die("Erro in query $query.".mysqli_error($koneksi));

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