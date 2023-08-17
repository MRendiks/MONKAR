<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'monkar';
$mysqli = new mysqli($host, $user, $pass, $dbname);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} //Mencoba terhubung apabila Host, User, dan Pass Benar. Kalau tidak MySQL memberikan Notif Error
$dbselect = $mysqli->select_db($dbname); //Jika benar maka akan memilih Database sesuai pada variable $dbname
