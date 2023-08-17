<?php
require '../database/koneksi.php';

$_SESSION['page'] = "costumer";
require 'header/header.php';
require 'navbar/navbar_menu.php';

if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>

<li class="breadcrumb-item active">Data user</li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <!-- Button to Open the Modal -->
        <?php
        if ($_SESSION['admin'] == True) {
            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah user</button>';
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
                        <th>username</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>NIK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambildatauser = mysqli_query($koneksi, "SELECT * FROM karyawan");
                    $i = 1;
                    while ($data = mysqli_fetch_array($ambildatauser)) {
                        $idk = $data['id_karyawan'];
                        $nama_lengkap = $data['Nama_lengkap'];
                        $username = $data['username'];
                        $jabatan = $data['Jabatan'];
                        $NIK = $data['NIK'];
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><a style="text-decoration: underline; color: black;" href="data_jobdesk_karyawan.php?id_karyawan=<?= $idk ?>&nama_karyawan=<?= $username ?>"><?= $username; ?></a> </td>
                            <td><?= $nama_lengkap; ?></td>
                            <td><?= $jabatan; ?></td>
                            <td><?= $NIK; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idk; ?>">Ubah</button>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal" id="edit<?= $idk; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit User</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form method="post">
                                        <div class="modal-body">
                                            <label>Nama</label>
                                            <input type="text" name="nama_lengkap" value="<?= $nama_lengkap; ?>" class="form-control" autocomplete="off" required>
                                            <br>
                                            <label>Username</label>
                                            <input type="text" name="username" value="<?= $username; ?>" class="form-control" autocomplete="off" required>
                                            <br>
                                            <label>NIK</label>
                                            <input type="text" name="NIK" value="<?= $NIK; ?>" class="form-control" autocomplete="off" required>
                                            <br>
                                            <label>jabatan</label>
                                            <select name="jabatan" class="form-control" style="color: black; border-radius: 50px;" required>
                                                <option value="user">user</option>
                                                <option value="admin">admin</option>
                                            </select>
                                            <br>
                                            <br>
                                            <input type="hidden" name="idk" value="<?= $idk; ?>">
                                            <button type="submit" class="btn btn-primary" name="update_user">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Hapus Modal -->
                        <div class="modal" id="delete<?= $idk; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Data user</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <form method="post">
                                        <div class="modal-body">
                                            Apakah Yakin Hapus user <?= $nama_lengkap; ?> ?
                                            <br>
                                            <input type="hidden" name="idk" value="<?= $idk; ?>">
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapus_user">Ya, Hapus</button>
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
                <h4 class="modal-title">Tambah user Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="nama_lengkap" placeholder="Nama user" class="form-control" autocomplete="off" required>
                    <br>
                    <input type="text" name="username" placeholder="username" class="form-control" autocomplete="off" required>
                    <br>
                    <label>jabatan</label>
                    <select name="jabatan" class="form-control" style="color: black; border-radius: 50px;" required>
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                    <br>
                    <input type="text" name="NIK" placeholder="NIK" class="form-control" autocomplete="off" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="tambah_user">Tambah</button>
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