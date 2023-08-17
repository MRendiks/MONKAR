<?php 
require 'connect_db.php';

$id_karyawan = $_GET['id_karyawan'];
$id_karyawan = (int)$id_karyawan;

$query      = "DELETE FROM karyawan WHERE id_karyawan='$id_karyawan'";
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