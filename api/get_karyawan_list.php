<?php 
require 'connect_db.php';

$query      = "SELECT * FROM karyawan WHERE Jabatan='Karyawan'";
$odj_query  = mysqli_query($koneksi, $query);

if($odj_query){
    $result = array();
    while ($data  = mysqli_fetch_array($odj_query)) {
    
        array_push($result, array(
            "id_karyawan" => $data['id_karyawan'],
            "username" => $data['username'],
            "password" => $data['password'],
            "nama_lengkap" => $data["Nama_lengkap"],
            "NIK" => $data['NIK'],
            "jabatan" => $data["Jabatan"],
            "jenis_kelamin" => $data['Jenis_Kelamin']
        ));
    }echo json_encode(
        $result
    );
}



header('Content-Type: application/json');



?>