<?php 
require 'connect_db.php';

$query      = "SELECT Nama_lengkap FROM karyawan WHERE Jabatan='Karyawan'";
$odj_query  = mysqli_query($koneksi, $query);

$result = array();
while ($data  = mysqli_fetch_array($odj_query)) {
    array_push($result, array(
        "nama_lengkap" => $data["Nama_lengkap"]
    ));
}
echo json_encode(
    $result
);

header('Content-Type: application/json');



?>