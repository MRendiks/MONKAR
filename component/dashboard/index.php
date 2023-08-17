<?php
require '../database/koneksi.php';

$_SESSION['page'] = "home";

require 'header/header.php';
require 'navbar/navbar.php';

if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-5">  
                    <!-- Content Row -->
                    <div class="row">

                        <!-- pemesanan Card -->
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                            Users</div>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) totalusers FROM karyawan");
                                        $datauser = mysqli_fetch_array($query);
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datauser['totalusers'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                            Jobdesk</div>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) totaljob FROM jobdesk");
                                        $datajob = mysqli_fetch_array($query);
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datajob['totaljob'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-setting fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                            Kinerja</div>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) totalkinerja FROM kinerja");
                                        $datakinerja = mysqli_fetch_array($query);
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $datakinerja['totalkinerja'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-setting fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

<?php 
require 'footer/footer.php';
?>