<?php 
require 'connect_db.php';

$id_jobdesk = $_GET['id_jobdesk'];
$id_jobdesk = (int)$id_jobdesk;

$query      = "DELETE FROM jobdesk WHERE id_jobdesk='$id_jobdesk'";
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