<?php
require '../database/koneksi.php';

$_SESSION['page'] = "jobdesk";
require 'header/header.php';
require 'navbar/navbar_menu.php';

if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>

<li class="breadcrumb-item active">Data Jobdesk</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <!-- Button to Open the Modal -->
        <?php
        if ($_SESSION['admin'] == True) {
            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Jobdesk</button>';
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
                        <th>Kategori Job</th>
                        <th>Project Name</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambildatajob = mysqli_query($koneksi, "SELECT id_jobdesk, karyawan.Nama_lengkap, kategori_job, project_name, deadline, status FROM jobdesk INNER JOIN karyawan ON jobdesk.id_karyawan=karyawan.id_karyawan");
                    $i = 1;
                    while ($data = mysqli_fetch_array($ambildatajob)) {
                        $idj = $data['id_jobdesk'];
                        $kategori_job = $data['kategori_job'];
                        $nama_karyawan = $data['Nama_lengkap'];
                        $project_name = $data['project_name'];
                        $deadline = $data['deadline'];
                        $status = $data['status'];
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $nama_karyawan; ?></td>
                            <td><?= $kategori_job; ?></td>
                            <td><?= $project_name; ?></td>
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
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idj; ?>">Edit</button>

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
                                            <label>Kategori job</label>
                                            <input type="text" name="kategori_job" value="<?= $kategori_job; ?>" class="form-control" autocomplete="off" required>
                                            <br>

                                            <label>Project Name</label>
                                            <input type="text" name="project_name" value="<?= $project_name; ?>" class="form-control" autocomplete="off" required>
                                            <br>
                                            <label>deadline</label>
                                            <input type="text" name="deadline" value="<?= $deadline; ?>" class="form-control" required>
                                            <br>
                                            <label>status</label>
                                            <select name="status" class="form-control" style="color: black; border-radius: 50px;" required>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Belum Selesai">Belum Selesai</option>
                                            </select>
                                            <br>
                                            <br>
                                            <input type="hidden" name="idj" value="<?= $idj; ?>">
                                            <button type="submit" class="btn btn-primary" name="update_jobdesk">Simpan</button>
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
                                            Apakah Yakin Hapus Jobdesk <?= $project_name; ?> ?
                                            <br>
                                            <input type="hidden" name="idj" value="<?= $idj; ?>">
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapus_jobdesk">Ya, Hapus</button>
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
                    <label>Nama Karyawan</label>
                    <select name="id_karyawan" class="form-control">
                        <?php
                        $data_karyawan = mysqli_query($koneksi, "SELECT id_karyawan,Nama_lengkap FROM karyawan");
                        if (mysqli_num_rows($data_karyawan) > 0) {
                            foreach ($data_karyawan as $data) {
                        ?>
                                <option value="<?= $data['id_karyawan']; ?>"><?= $data['Nama_lengkap']; ?></option>
                            <?php
                            }

                            ?>
                    </select>
                <?php } ?>
                <br>
                <input type="text" name="kategori_job" placeholder="Kategori Job" class="form-control" required>
                <br>
                <input type="text" name="project_name" placeholder="Nama Project" class="form-control" required>
                <br>
                <label>Deadline</label>
                <input type="date" name="deadline" placeholder="Deadline" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="tambah_jobdesk">Tambah</button>
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