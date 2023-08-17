<?php 
require 'connect_db.php';


$username       = $_POST['username'];
$password       = $_POST['password'];
$nama_lengkap   = $_POST['nama_lengkap'];
$NIK            = $_POST['NIK'];
$jenis_kelamin  = $_POST['jenis_kelamin'];

$query      = "INSERT INTO karyawan VALUES('', '$username', '$password', '$nama_lengkap', '$NIK', 'Karyawan', '$jenis_kelamin')";
$odj_query  = mysqli_query($koneksi, $query);


if ($odj_query) {
    echo json_encode(
        array(
            'response' => true,
            'payload' => null
        )
    );
}else {
    echo json_encode(
        array(
            'response' => false,
            'payload' => null
        )
    );
}

header('Content-Type: application/json');



?>