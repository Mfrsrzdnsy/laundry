<?php
session_start();
// Pastikan user sudah login
if (!isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header('Location: login.php');
    exit();
}

include "../include/koneksi.php";

if (isset($_GET['id_booking'])) {
    $id_booking = $_GET['id_booking'];

    // Ambil data booking berdasarkan ID
    $result = $conn->query("SELECT * FROM bookings WHERE id_booking = '$id_booking'");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        // Redirect jika data tidak ditemukan
        header('Location: bookings_list.php');
        exit();
    }
} else {
    // Redirect jika ID booking tidak ada di URL
    header('Location: bookings_list.php');
    exit();
}

$email_user = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amanah Laundry - Edit Booking</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="shortcut icon" href="../asset/img/svg/amanah_logo.svg" type="image/x-icon">
    <link href="../landing-page/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../landing-page/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../landing-page/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../landing-page/assets/css/main.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- =======================================================
    * Template Name: Arsha
    * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
    * Updated: Jun 29 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    <?php include "template/header.php" ?>

    <div class="container" style="margin-top: 150px;">
        <h2 class="text-center mb-3">Edit Booking Layanan Antar Jemput</h2>
        <form action="booking_update.php" method="POST" class="php-email-form">
            <div class="row gy-4">
                <div class="col-md-6">
                    <label for="booking-field" class="pb-2">Nomor Booking</label>
                    <input type="text" class="form-control" name="no_booking" id="booking-field"
                        value="<?php echo $data['no_booking']; ?>" required readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama-field" class="pb-2">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" id="nama-field" class="form-control"
                        value="<?php echo $data['nama_pelanggan']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="email-field" class="pb-2">Email</label>
                    <input type="email" class="form-control" name="email_pelanggan" id="email-field"
                        value="<?php echo htmlspecialchars($data['email_pelanggan']); ?>" required readonly>
                </div>
                <div class="col-md-6">
                    <label for="telepon-field" class="pb-2">Nomor Telepon</label>
                    <input type="text" class="form-control" name="nomor_telepon" id="telepon-field"
                        value="<?php echo $data['nomor_telepon']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat-field" class="pb-2">Alamat Penjemputan</label>
                    <input type="text" class="form-control" name="alamat_penjemputan" id="alamat-field"
                        value="<?php echo $data['alamat_penjemputan']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="layanan-field" class="pb-2">Layanan</label>
                    <select class="form-control" name="jenis_layanan" id="layanan-field" required>
                        <option value="Cuci Kering"
                            <?php echo $data['jenis_layanan'] == 'Cuci Kering' ? 'selected' : ''; ?>>Cuci Kering
                        </option>
                        <option value="Cuci Setrika"
                            <?php echo $data['jenis_layanan'] == 'Cuci Setrika' ? 'selected' : ''; ?>>Cuci Setrika
                        </option>
                        <option value="Cuci Satuan"
                            <?php echo $data['jenis_layanan'] == 'Cuci Satuan' ? 'selected' : ''; ?>>Cuci Satuan
                        </option>
                        <option value="Antar Jemput"
                            <?php echo $data['jenis_layanan'] == 'Antar Jemput' ? 'selected' : ''; ?>>Antar Jemput
                        </option>
                    </select>
                </div>

                <div class="col-md-12 text-center">
                    <input type="hidden" name="id_booking" value="<?php echo $data['id_booking']; ?>">
                    <button type="submit" class="btn btn-primary mb-5">Update Booking</button>
                </div>
            </div>
        </form>
    </div>

    <?php include "template/footer.php" ?>

    <!-- Vendor JS Files -->
    <script src="../landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./landing-page/assets/vendor/php-email-form/validate.js"></script> -->
    <script src="../landing-page/assets/vendor/aos/aos.js"></script>
    <script src="../landing-page/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../landing-page/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../landing-page/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../landing-page/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main JS File -->
    <script src="../landing-page/assets/js/main.js"></script>
    <script>
    <?php if (isset($_SESSION['message'])): ?>
    Swal.fire({
        icon: '<?php echo $_SESSION['message_type']; ?>',
        title: '<?php echo $_SESSION['message']; ?>',
        showConfirmButton: false,
        timer: 3000
    });
    <?php 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            ?>
    <?php endif; ?>
    </script>

</body>

</html>