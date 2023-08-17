<?php 
require 'connect_db.php';

$id_karyawan = $_POST['id_karyawan'];
$id_karyawan = (int)$id_karyawan;

$query      = "SELECT id_jobdesk, Nama_lengkap, kategori_job, project_name, tgl_upload, deadline, status FROM jobdesk INNER JOIN  karyawan ON jobdesk.id_karyawan = karyawan.id_karyawan WHERE jobdesk.id_karyawan='$id_karyawan' AND status<100";
$odj_query  = mysqli_query($koneksi, $query) or die("Erro in query $odj_query.".mysqli_error($koneksi));

$result = array();
while ($data  = mysqli_fetch_array($odj_query)) {
    array_push($result, array(
        "id_jobdesk" => $data['id_jobdesk'],
        "Nama_lengkap" => $data['Nama_lengkap'],
        "kategori_job" => $data['kategori_job'],
        "project_name" => $data['project_name'],
        "tgl_upload" => $data['tgl_upload'],
        "deadline" => $data["deadline"],
        "status" => $data['status']
    ));
}
echo json_encode(
    $result
);

header('Content-Type: application/json');



?>