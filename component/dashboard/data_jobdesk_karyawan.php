<?php
require '../database/koneksi.php';

$_SESSION['page'] = "costumer";
require 'header/header.php';
require 'navbar/navbar_menu.php';

$id_karyawan = $_GET['id_karyawan'];
$nama_karyawan = $_GET['nama_karyawan'];
$ambildatajob = mysqli_query($koneksi, "SELECT jobdesk_list.id_list_jobdesk, karyawan.Nama_lengkap, jobdesk.project_name, jobdesk_list.keterangan, jobdesk.deadline, jobdesk_list.status FROM jobdesk_list INNER JOIN jobdesk ON jobdesk_list.id_jobdesk = jobdesk.id_jobdesk INNER JOIN karyawan ON jobdesk.id_karyawan=karyawan.id_karyawan WHERE karyawan.id_karyawan = '$id_karyawan';");

if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>

<li class="breadcrumb-item active">Data Check List Jobdesk <?= $nama_karyawan ?></li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <!-- Button to Open the Modal -->
        <?php
        if ($_SESSION['admin'] == True) {
            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Check List Jobdesk</button>';
        } else {
        }
        ?>

    </div>

    <!-- TABEL GURU -->
    <div class="card-body">
        <?php
        if ($_SESSION['admin'] == True) {
        ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Nama Projek</th>
                        <th>List Job</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $i = 1;
                    while ($data = mysqli_fetch_array($ambildatajob)) {
                        $idj = $data['id_list_jobdesk'];
                        $nama_karyawan = $data['Nama_lengkap'];
                        $project_name = $data['project_name'];
                        $deadline = $data['deadline'];
                        $job = $data['keterangan'];
                        $status = $data['status'];

                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $nama_karyawan; ?></td>
                            <td><?= $project_name; ?></td>
                            <td><?= $job; ?></td>
                            <td><?= $deadline; ?></td>
                            <?php if ($status == "Selesai") {
                            ?>
                                <td><span class="badge badge-success"><?= $status; ?></span></td>
                            <?php
                            } else {
                            ?>
                                <td><span class="badge badge-danger"><?= $status; ?></span></td>
                            <?php
                            } ?>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idj; ?>">Ubah</button>

                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal" id="edit<?= $idj; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Jobdesk</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form method="post">
                                        <div class="modal-body">
                                            <input type="text" name="id_karyawan" value="<?= $id_karyawan ?>" class="form-control" hidden>
                                            <input type="text" name="nama_karyawan" value="<?= $nama_karyawan ?>" class="form-control" hidden>
                                            <label>Nama Karyawan</label>
                                            <input type="text" name="nama_karyawan" value="<?= $nama_karyawan ?>" class="form-control" disabled>
                                            <br>
                                            <label>Nama Projek</label>
                                            <select name="id_jobdesk" class="form-control">
                                                <?php
                                                $data_jobdesk = mysqli_query($koneksi, "SELECT id_jobdesk,project_name FROM jobdesk");
                                                if (mysqli_num_rows($data_jobdesk) > 0) {
                                                    foreach ($data_jobdesk as $data) {
                                                ?>
                                                        <option value="<?= $data['id_jobdesk']; ?>"><?= $data['project_name']; ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                            </select>
                                        <?php } ?>
                                        <br>
                                        <label>Keterangan</label>
                                        <input type="text" name="keterangan" value="<?= $job ?>" class="form-control" required>
                                        <label>status</label>
                                        <select name="status" class="form-control" style="color: black; border-radius: 50px;" required>
                                            <option value="Belum Selesai">Belum Selesai</option>
                                            <option value="Selesai">Selesai</option>

                                        </select>
                                        <br>
                                        <br>
                                        <input type="hidden" name="idj" value="<?= $idj; ?>">
                                        <button type="submit" class="btn btn-primary" name="update_jobdesk_list">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Hapus Modal -->
                        <div class="modal" id="delete<?= $idj; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data Jobdesk</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form method="post">
                                        <div class="modal-body">
                                            Apakah Yakin Hapus Jobdesk <?= $job; ?> ?
                                            <br>
                                            <input type="hidden" name="idj" value="<?= $idj; ?>">
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapus_jobdesk_list">Ya, Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>

    </div>
</div>
</div>
</main>
<?php
require 'footer/footer.php';
?>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jobdesk Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="id_karyawan" value="<?= $id_karyawan ?>" class="form-control" hidden>
                    <input type="text" name="nama_karyawan" value="<?= $nama_karyawan ?>" class="form-control" hidden>
                    <label>Nama Karyawan</label>
                    <input type="text" name="nama_karyawan" value="<?= $nama_karyawan ?>" class="form-control" disabled>
                    <br>
                    <label>Nama Projek</label>
                    <select name="id_jobdesk" class="form-control">
                        <?php
                        $data_jobdesk = mysqli_query($koneksi, "SELECT id_jobdesk,project_name FROM jobdesk");
                        if (mysqli_num_rows($data_jobdesk) > 0) {
                            foreach ($data_jobdesk as $data) {
                        ?>
                                <option value="<?= $data['id_jobdesk']; ?>"><?= $data['project_name']; ?></option>
                            <?php
                            }

                            ?>
                    </select>
                <?php } ?>
                <br>
                <label>Keterangan</label>
                <input type="text" name="keterangan" placeholder="keterangan" class="form-control" autocomplete="off" required>
                <br>
                <button type="submit" class="btn btn-primary" name="tambah_jobdesk_list">Tambah</button>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>