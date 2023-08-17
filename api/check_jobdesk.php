<?php 
require 'connect_db.php';

$id_jobdesk     = $_POST['id_jobdesk'];
$id_jobdesk     = (int)$id_jobdesk;
$keterangan     = $_POST['keterangan'];
$id_karyawan     = $_POST['id_karyawan'];
$id_karyawan     = (int)$id_karyawan;


$query      = "UPDATE jobdesk_list SET status='Selesai' WHERE keterangan='$keterangan' AND id_jobdesk='$id_jobdesk'";
$odj_query  = mysqli_query($koneksi, $query)  or die("Erro in query1 $odj_query.".mysqli_error($koneksi));

$query2      = "SELECT deadline FROM jobdesk WHERE id_karyawan='$id_karyawan' AND id_jobdesk='$id_jobdesk'";
    $odj_query2  = mysqli_query($koneksi, $query2)  or die("Erro in query4 $odj_query2.".mysqli_error($koneksi));
    while($data  = mysqli_fetch_array($odj_query2)){
        $deadline =  $data['deadline'];
    };

$query_if   = "SELECT * FROM kinerja WHERE id_karyawan='$id_karyawan' AND bulan=MONTH('$deadline') AND tahun=YEAR('$deadline')";
$result     = mysqli_query($koneksi, $query_if)  or die("Erro in query2 $result.".mysqli_error($koneksi));


if (mysqli_num_rows($result) == 0 ) {
    $query2      = "SELECT COUNT(jobdesk_list.id_list_jobdesk) as total_selesai FROM jobdesk_list INNER JOIN jobdesk ON jobdesk_list.id_jobdesk = jobdesk.id_jobdesk WHERE jobdesk.id_jobdesk='$id_jobdesk' AND jobdesk_list.status='Selesai'";
    $odj_query2  = mysqli_query($koneksi, $query2)  or die("Erro in query3 $odj_query2.".mysqli_error($koneksi));
    while($data  = mysqli_fetch_array($odj_query2)){
        $total_upload =  $data['total_selesai'];
    };

    $query2      = "SELECT COUNT(jobdesk_list.id_list_jobdesk) as total_job FROM jobdesk_list INNER JOIN jobdesk ON jobdesk_list.id_jobdesk = jobdesk.id_jobdesk WHERE jobdesk.id_jobdesk='$id_jobdesk'";
    $odj_query2  = mysqli_query($koneksi, $query2)  or die("Erro in query4 $odj_query2.".mysqli_error($koneksi));
    while($data  = mysqli_fetch_array($odj_query2)){
        $total_job =  $data['total_job'];
    };

    $nilai = $total_upload / $total_job;
    $nilai = $nilai * 100;

    $query2      = "SELECT deadline FROM jobdesk WHERE id_jobdesk='$id_jobdesk'";
    $odj_query2  = mysqli_query($koneksi, $query2)  or die("Erro in query4 $odj_query2.".mysqli_error($koneksi));
    while($data  = mysqli_fetch_array($odj_query2)){
        $deadline =  $data['deadline'];
    };

    $query      = "UPDATE jobdesk SET status='$nilai' WHERE id_jobdesk='$id_jobdesk'";
    $odj_query  = mysqli_query($koneksi, $query)  or die("Erro in query5,5 $odj_query.".mysqli_error($koneksi));

    $query      = "INSERT INTO kinerja VALUES('','$id_karyawan', MONTH('$deadline'), YEAR('$deadline'), '$nilai')";
    $excute     = mysqli_query($koneksi, $query) or die("Erro in query5 $excute.".mysqli_error($koneksi));
}else {
    while($data  = mysqli_fetch_array($result)){
        $id_kinerja =  $data['id_kinerja'];
    };

    $query2      = "SELECT COUNT(jobdesk_list.id_list_jobdesk) as total_selesai FROM jobdesk_list INNER JOIN jobdesk ON jobdesk_list.id_jobdesk = jobdesk.id_jobdesk WHERE jobdesk.id_jobdesk='$id_jobdesk' AND jobdesk_list.status='Selesai'";
    $odj_query2  = mysqli_query($koneksi, $query2)  or die("Erro in query3 $odj_query2.".mysqli_error($koneksi));
    while($data  = mysqli_fetch_array($odj_query2)){
        $total_upload =  $data['total_selesai'];
    };

    $query2      = "SELECT COUNT(jobdesk_list.id_list_jobdesk) as total_job FROM jobdesk_list INNER JOIN jobdesk ON jobdesk_list.id_jobdesk = jobdesk.id_jobdesk WHERE jobdesk.id_jobdesk='$id_jobdesk'";
    $odj_query2  = mysqli_query($koneksi, $query2)  or die("Erro in query4 $odj_query2.".mysqli_error($koneksi));
    while($data  = mysqli_fetch_array($odj_query2)){
        $total_job =  $data['total_job'];
    };

    $nilai = $total_upload / $total_job;
    $nilai = $nilai * 100;

    $query      = "UPDATE jobdesk SET status='$nilai' WHERE id_jobdesk='$id_jobdesk'";
    $odj_query  = mysqli_query($koneksi, $query)  or die("Erro in query5,5 $odj_query.".mysqli_error($koneksi));

    $query_final = "UPDATE kinerja SET nilai='$nilai' WHERE id_kinerja='$id_kinerja'";
    $excute     = mysqli_query($koneksi, $query_final) or die("Erro in query8 $excute.".mysqli_error($koneksi));
}


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