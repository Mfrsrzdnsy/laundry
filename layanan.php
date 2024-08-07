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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
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
                <h3>Layanan</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <div class="tombol mb-3">
                                    <a href="layanan_tambah.php"><button type="button"
                                            class="btn btn-primary btn-md">Tambah +</button></a>
                                </div>
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Layanan</th>
                                                <th>Layanan</th>
                                                <th>Deskripsi</th>
                                                <th>Harga</th>
                                                <th>Estimasi Waktu</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include "./include/koneksi.php";
                                                $i = 1;
                                                $sql = mysqli_query($conn, "SELECT * FROM layanan ORDER BY `id_layanan`");
                                                while ($hasil = mysqli_fetch_array($sql)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $hasil['id_layanan']; ?></td>
                                                <td><?php echo $hasil['nama_layanan']; ?></td>
                                                <td><?php echo $hasil['deskripsi']; ?></td>
                                                <td><?php echo 'Rp ' . number_format($hasil['harga'], 0, ',', '.'); ?>
                                                </td>
                                                <td><?php echo $hasil['estimasi_waktu']; ?></td>
                                                <td>
                                                    <a href="layanan_edit.php?edit=<?php echo $hasil['id_layanan']; ?>"
                                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="#" class="btn btn-danger delete-btn"
                                                        data-id="<?php echo $hasil['id_layanan']; ?>"><i
                                                            class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php
                include "include/footer.php";
            ?>
        </div>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();

        // Bind delete button events
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            console.log('Delete button clicked for ID:', id); // Debugging log
            confirmDelete(id);
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'layanan_hapus.php?hapus=' + id;
            }
        });
    }
    </script>

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

</html>
<?php
} else {
    header("location:login/index.php");
}
?>