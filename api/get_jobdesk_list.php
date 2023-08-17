<?php 
require 'connect_db.php';

$query      = "SELECT jobdesk.id_jobdesk, karyawan.id_karyawan, karyawan.Nama_lengkap, jobdesk.kategori_job, jobdesk.project_name, jobdesk.tgl_upload, jobdesk.deadline, karyawan.jabatan, jobdesk.status FROM jobdesk INNER JOIN  karyawan ON jobdesk.id_karyawan = karyawan.id_karyawan WHERE jabatan='Karyawan'";
$odj_query  = mysqli_query($koneksi, $query) or die("Erro in query $odj_query.".mysqli_error($koneksi));

$result = array();
while ($data  = mysqli_fetch_array($odj_query)) {
    array_push($result, array(
        "id_jobdesk" => $data['id_jobdesk'],
        "id_karyawan" => $data['id_karyawan'],
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