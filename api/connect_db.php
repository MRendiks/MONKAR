<?php 
$server     = "localhost";
$username   = "root";
$password   = "";
$db         = "monkar";
$koneksi    = mysqli_connect($server, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Gagal Konek dengan database". mysqli_connect_errno();
}

?>