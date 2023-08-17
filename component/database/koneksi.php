<?php
session_start();

//Membuat Koneksi ke Database
$koneksi = mysqli_connect("localhost", "root", "", "monkar");

//Cek Koneksi Database
if (mysqli_connect_error()) {
	echo "koneksi database gagal :" . mysqli_connect_error();
}


//INSERT
if (isset($_POST['tambah_user'])) {
	$nama_user = $_POST['nama_lengkap'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$NIK = $_POST['NIK'];
	$jabatan = $_POST['jabatan'];
	$jk = $_POST['jk'];
	
	
	$adduser = mysqli_query($koneksi, "INSERT INTO karyawan VALUES('', '$username', '$password', '$nama_user', '$NIK', '$jabatan', '$jk')") or die("Erro in query $adduser.".mysqli_error($koneksi));
	if ($adduser) {
		header("location:data_costumer.php");
	}else{
		header('location:data_costumer.php');
	}
}

if (isset($_POST['tambah_jobdesk_list'])) {
	$id_karyawan = $_POST['id_karyawan'];
	$nama_karyawan = $_POST['nama_karyawan'];
	$id_jobdesk = $_POST['id_jobdesk'];
	$keterangan = $_POST['keterangan'];
	
	$add_jobdesk = mysqli_query($koneksi, "INSERT INTO jobdesk_list VALUES('', '$id_jobdesk', '$keterangan' ,'Belum Selesai')") or die("Erro in query $add_jobdesk.".mysqli_error($koneksi));
	if ($add_jobdesk) {
		header("location:data_jobdesk_karyawan.php?id_karyawan=$id_karyawan&nama_karyawan=$nama_karyawan");
	}else{
		header("location:data_jobdesk_karyawan.php?id_karyawan=$id_karyawan&nama_karyawan=$nama_karyawan");
	}
}


if (isset($_POST['tambah_jobdesk'])) {
	$id_karyawan = $_POST['id_karyawan'];
	$kategori_job = $_POST['kategori_job'];
	$project_name = $_POST['project_name'];
	$deadline = $_POST['deadline'];
	
	$adduser = mysqli_query($koneksi, "INSERT INTO jobdesk VALUES('', '$id_karyawan', '$kategori_job', '$project_name', '','$deadline' ,0)") or die("Erro in query $adduser.".mysqli_error($koneksi));
	if ($adduser) {
		header("location:data_jobdesk.php");
	}else{
		header('location:data_jobdesk.php');
	}
}





#UPDATE

if(isset($_POST['update_user'])) {
	$ids = $_POST['idk'];
	$nama_user = $_POST['nama_lengkap'];
	$username = $_POST['username'];
	$NIK = $_POST['NIK'];
	$jabatan = $_POST['jabatan'];
	
	$password = $_POST['password'];

	$update = mysqli_query($koneksi, "UPDATE karyawan SET Nama_lengkap='$nama_user', username='$username', password='$password', NIK='$NIK', jabatan='$jabatan' WHERE id_karyawan='$ids'") or die("Erro in query $update.".mysqli_error($koneksi));

	if ($update) {
		header("location:data_costumer.php");
	}else{
		header("location:data_costumer.php");
	}
}


if (isset($_POST['updatepassword'])) {
	$id_user = $_POST['id_user'];
	$password = $_POST['password'];

	$update = mysqli_query($koneksi, "UPDATE users SET password='$password' WHERE id_user='$id_admin'")  or die("Erro in query $update.".mysqli_error($koneksi));
	if ($update) {
		header("location:ganti_password.php");
	}else{
		header("location:ganti_password.php");
	}
}

if(isset($_POST['update_jobdesk_list'])) {
	$id_karyawan = $_POST['id_karyawan'];
	$nama_karyawan = $_POST['nama_karyawan'];
	$idj = $_POST['idj'];
	$keterangan = $_POST['keterangan'];
	$status = $_POST['status'];

	$update = mysqli_query($koneksi, "UPDATE jobdesk_list SET keterangan='$keterangan', status='$status' WHERE id_list_jobdesk='$idj'") or die("Erro in query $update.".mysqli_error($koneksi));

	if ($update) {
		header("location:data_jobdesk_karyawan.php?id_karyawan=$id_karyawan&nama_karyawan=$nama_karyawan");
	}else{
		header("location:data_jobdesk_karyawan.php?id_karyawan=$id_karyawan&nama_karyawan=$nama_karyawan");
	}
}

if(isset($_POST['update_jobdesk'])) {
	$idj = $_POST['idj'];
	$kategori_job = $_POST['kategori_job'];
	$project_name = $_POST['project_name'];
	$deadline = $_POST['deadline'];
	$status = $_POST['status'];

	$update = mysqli_query($koneksi, "UPDATE jobdesk SET kategori_job='$kategori_job', project_name='$project_name', status='$status', deadline='$deadline' WHERE id_jobdesk='$idj'") or die("Erro in query $update.".mysqli_error($koneksi));

	if ($update) {
		header("location:data_jobdesk.php");
	}else{
		header("location:data_jobdesk.php");
	}
}




// HAPUS DATA




if (isset($_POST['hapus_user'])) {
	$ids = $_POST['ids'];

	$hapus = mysqli_query($koneksi, "DELETE FROM karyawan where id_karyawan='$ids'") or die("Erro in query $hapus.".mysqli_error($koneksi));

	if ($hapus) {
		header("location:data_costumer.php");
	} else {
		echo ("<script language='javascript'>
			window.alert('Tidak Bisa Menghapus Data.');
			</script>
			");
		header("location:data_costumer.php");
	}
}

if (isset($_POST['hapus_jobdesk_list'])) {
	$idj = $_POST['idj'];

	$hapus = mysqli_query($koneksi, "DELETE FROM jobdesk_list where id_list_jobdesk='$idj'") or die("Erro in query $hapus.".mysqli_error($koneksi));

	if ($hapus) {
		// header("location:data_jobdesk.php");
	} else {
		echo ("<script language='javascript'>
			window.alert('Tidak Bisa Menghapus Data.');
			</script>
			");
		// header("location:data_jobdesk.php");
	}
}

// if (isset($_POST['hapus_jobdesk'])) {
// 	$idj = $_POST['idj'];

// 	$hapus = mysqli_query($koneksi, "DELETE FROM jobdesk where id_jobdesk='$idj'") or die("Erro in query $hapus.".mysqli_error($koneksi));

// 	if ($hapus) {
// 		header("location:data_jobdesk.php");
// 	} else {
// 		echo ("<script language='javascript'>
// 			window.alert('Tidak Bisa Menghapus Data.');
// 			</script>
// 			");
// 		header("location:data_jobdesk.php");
// 	}
// }

if (isset($_POST['hapus_kinerja'])) {
	$idj = $_POST['idj'];

	$hapus = mysqli_query($koneksi, "DELETE FROM kinerja where id_kinerja='$idj'") or die("Erro in query $hapus.".mysqli_error($koneksi));

	if ($hapus) {
		header("location:data_kinerja.php");
	} else {
		header("location:data_kinerja.php");
	}
}

?>