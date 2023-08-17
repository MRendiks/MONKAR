<?php 
require 'connect_db.php';

$nama_lengkap   = $_POST['nama_lengkap'];
$username   = $_POST['username'];
$nik   = $_POST['NIK'];
$jenis_kelamin = $_POST['jenis_kelamin'];

$query      = "INSERT INTO karyawan VALUES('', '$username', '$nik', '$nama_lengkap', '$nik', 'karyawan', '$jenis_kelamin')";
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