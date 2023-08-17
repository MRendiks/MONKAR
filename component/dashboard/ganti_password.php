<?php
require '../database/koneksi.php';

$_SESSION['page'] = "ganti_password";
require 'header/header.php';
require 'navbar/navbar_menu.php';

if (isset($_SESSION['log'])) {
} else {
    header('location:index.php');
};
?>



                        <li class="breadcrumb-item active">GANTI PASSWORD</li>
                    </ol>
                    <div class="card mb-4">
                        <!-- Modal body -->
                        <form method="post">
                            <div class="modal-body">
                                <input type="password" id="password" name="password" placeholder="Masukan Password Baru" class="form-control" required>
                                <br>
                                <input type="password" id="confirm_password" placeholder="Konfirmasi Password" class="form-control" required>
                                <br>
                                <input type="text" name="id_users" value="<?= $_SESSION['id_user'] ?>" class="form-control" hidden>    
                                <button type="submit" class="btn btn-primary" name="updatepassword">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Monkar</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</body>



</html>