<?php 
require 'connect_db.php';

$id_jobdesk     = $_GET['id_jobdesk'];
$nama_lengkap   = $_GET['nama_lengkap'];
$kategori_job   = $_GET['kategori_job'];
$nama_proyek   = $_GET['nama_proyek'];
$deadline = $_GET['deadline'];

$query = "SELECT id_karyawan FROM karyawan WHERE Nama_lengkap='$nama_lengkap'";
$ekskusi = mysqli_query($koneksi, $query);
while($data = mysqli_fetch_array($ekskusi)){
    $id_karyawan =  $data['id_karyawan'];
};


$query      = "UPDATE jobdesk SET id_karyawan='$id_karyawan', kategori_job='$kategori_job', project_name='$nama_proyek', deadline='$deadline' WHERE id_jobdesk='$id_jobdesk'";
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