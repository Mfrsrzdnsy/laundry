<?php
session_start();
if (isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Amanah Laundry</title>

        <?php
        include "include/header.php";
        ?>
    </head>

    <body>
        <script src="assets/static/js/initTheme.js"></script>
        <div id="app">

            <?php
            include "include/list.php";
            ?>
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

                <div class="page-heading">
                    <h3>Form Ubah Data Pelanggan</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    include "./include/koneksi.php";
                                    $No_Identitas = $_GET['edit'];

                                    $sql = mysqli_query($conn, "SELECT * FROM pelanggan WHERE No_Identitas='" . $No_Identitas . "'");
                                    while ($hasil = mysqli_fetch_array($sql)) {
                                    ?>
                                        <form action="proses-edit-pelanggan.php" method="POST">
                                            <div class="form-group">
                                                <label>No. Identitas</label>
                                                <input type="text" class="form-control" name="No_Identitas" placeholder="No. Identitas" readonly="readonly" value="<?php echo $hasil['No_Identitas']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="Nama" placeholder="Nama" value="<?php echo $hasil['Nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" class="form-control" name="Alamat" placeholder="Alamat" value="<?php echo $hasil['Alamat']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>No. Hp</label>
                                                <input type="text" class="form-control" name="No_Hp" placeholder="No. Hp" value="<?php echo $hasil['No_Hp']; ?>">
                                            </div>
                                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                                            <a href="pelanggan.php"><input type="button" class="btn btn-danger" value="Batal"></a>
                                        </form>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Event listener untuk tombol burger
                var burgerBtn = document.querySelector('.burger-btn');
                var sidebar = document.querySelector('#sidebar');
                if (burgerBtn) {
                    burgerBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        sidebar.classList.toggle('active');
                    });
                }

                // Event listener untuk tombol close (sidebar-toggler)
                var sidebarHideBtn = document.querySelector('.sidebar-hide');
                if (sidebarHideBtn) {
                    sidebarHideBtn.addEventListener('click', function(event) {
                        event.preventDefault();
                        sidebar.classList.remove('active');
                    });
                }
            });
        </script>
    </body>
<?php
} else {
    header("location:login/index.php");
}
