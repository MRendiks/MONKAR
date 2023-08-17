<?php 
require 'connect_db.php';

$id_jobdesk = $_POST['id_jobdesk'];
$id_jobdesk = (int)$id_jobdesk;

$query      = "SELECT keterangan FROM jobdesk_list WHERE id_jobdesk = '$id_jobdesk' AND status='Belum Selesai'";
$odj_query  = mysqli_query($koneksi, $query) or die("Erro in query $odj_query.".mysqli_error($koneksi));

$result = array();
while ($data  = mysqli_fetch_array($odj_query)) {
    array_push($result, array(
        "keterangan" => $data['keterangan']
    ));
}
echo json_encode(
    $result
);

header('Content-Type: application/json');



?>