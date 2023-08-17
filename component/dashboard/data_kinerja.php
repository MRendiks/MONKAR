<?php
require '../database/koneksi.php';

$_SESSION['page'] = "kinerja";
require 'header/header.php';
require 'navbar/navbar_menu.php';

if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>

                        <li class="breadcrumb-item active">Data Kinerja</li>
                    </ol>
                    <div class="card mb-4">


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
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambildatajob = mysqli_query($koneksi, "SELECT id_kinerja, karyawan.Nama_lengkap, bulan, tahun, nilai FROM kinerja INNER JOIN karyawan ON kinerja.id_karyawan=karyawan.id_karyawan");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($ambildatajob)) {
                                        $idj = $data['id_kinerja'];
                                        $bulan = $data['bulan'];
                                        $nama_karyawan = $data['Nama_lengkap'];
                                        $tahun = $data['tahun'];
                                        $dateObj   = DateTime::createFromFormat('!m', $bulan);
                                        $monthName = $dateObj->format('F'); 
                                        $nilai = $data['nilai'];
                                        $persen = 100;
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $nama_karyawan; ?></td> 
                                            <td><?= $monthName; ?></td>                                           
                                            <td><?= $tahun; ?></td>
                                            <td><?= $nilai ?> %</td>

                                            
                                            <td>
                                                <!-- <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idj; ?>">Edit</button> -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idj; ?>">Hapus</button>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal" id="edit<?= $idj; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit kinerja</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        <label>Kategori job</label>
                                                        <input type="text" name="bulan" value="<?= $bulan; ?>" class="form-control" required>
                                                        <br>
                                                        
                                                        <label>Project Name</label>
                                                        <input type="text" name="tahun" value="<?= $tahun; ?>" class="form-control" required>
                                                        <br>
                                                        <label>nilai</label>
                                                        <input type="text" name="nilai" value="<?= $nilai; ?>" class="form-control" required>
                                                                                 
                                                        <br>
                                                            <input type="hidden" name="idj" value="<?= $idj; ?>">
                                                            <button type="submit" class="btn btn-primary" name="update_kinerja">Simpan</button>
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
                                                        <h4 class="modal-title">Hapus Data kinerja</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Apakah Yakin Hapus kinerja <?= $tahun; ?> ?
                                                            <br>
                                                            <input type="hidden" name="idj" value="<?= $idj; ?>">
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="hapus_kinerja">Ya, Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }}
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
                <h4 class="modal-title">Tambah kinerja Baru</h4>
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
                                <option value="<?= $data['id_karyawan'];?>"><?= $data['Nama_lengkap']; ?></option>
                            <?php
                        }
                     ?>
                    </select>
                    <?php }?>
                    <br>
                    <input type="text" name="bulan" placeholder="Kategori Job" class="form-control" required>
                    <br>
                    <input type="text" name="tahun" placeholder="Nama Project" class="form-control" required>
                    <br>
                    <label>nilai</label>  
                    <input type="date" name="nilai" placeholder="nilai" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="tambah_kinerja">Tambah</button>
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