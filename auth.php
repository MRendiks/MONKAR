<?php
session_start();
include 'config.php';

$error = '';
if (isset($_POST['login'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password Tidak Valid!";
	} else {

		$user = $mysqli->real_escape_string($_POST['username']);
		$pass = $mysqli->real_escape_string($_POST['password']);

		$query = "SELECT *  FROM karyawan WHERE username='$user' AND password='$pass' AND jabatan='Admin'";
		$sql = $mysqli->query($query);
		$rows = mysqli_fetch_array($sql);
		if ($rows) {
			$_SESSION['username'] = $user;
			$_SESSION['admin'] = true;
			$_SESSION['log'] = true;
			$_SESSION['id_user'] = $rows['id_karyawan'];
			header("location: component/dashboard/index.php");
		} else {
			echo "<script language=\"JavaScript\">\n";
			echo "alert('Username atau Password Salah!');\n";
			echo "window.location='index.php'";
			echo "</script>";
		}
	}
}
