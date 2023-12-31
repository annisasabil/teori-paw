<?php
    require "../adminpanel/koneksi.php";
    $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Home Kit | Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Daily Home Kit</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-8 offset-md-2">
                <form action="produk.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword"> 
                        <button type="submit" class="btn search">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- highlighted kategori -->

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-4">
                <div class="col-md-3 mb-3">
                    <div class="highlighted-kategori kategori-peralatan-dapur d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Peralatan Dapur">Peralatan Dapur</a></h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="highlighted-kategori kategori-peralatan-kamar-mandi d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Peralatan Kamar Mandi">Peralatan Kamar Mandi</a></h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="highlighted-kategori kategori-peralatan-elektronik d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Peralatan Elektronik">Peralatan Elektronik</a></h4>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="highlighted-kategori kategori-peralatan-perawatan d-flex justify-content-center align-items-center">
                    <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Perawatan">Perawatan</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->

    <div class="container-fluid navbar-custom py-5">
        <div class="container text-center text-white">
            <h3>Tentang Kami</h3>
            <p class="fs-6">
            Daily Home Kit sebuah tempat di mana kehangatan rumah Anda dimulai. Kami berkomitmen untuk memberikan pengalaman belanja memuaskan. Menyajikan rangkaian lengkap perabotan rumah tangga berkualitas tinggi untuk setiap sudut ruangan Anda. 
            Dari peralatan dapur yang inovatif, perlengkapan kamar mandi yang elegan, hingga peralatan elektronik yang canggih. Kami juga hadir untuk menghadirkan kenyamanan, kebersihan, dan keindahan dalam setiap momen di rumah Anda. Dengan fokus pada kualitas yang terjamin, 
            pilihan terlengkap, dan pelayanan pelanggan yang ramah, Daily Home Kit siap menjadi mitra terpercaya dalam memenuhi kebutuhan harian Anda. Mari bersama-sama menciptakan ruang yang 
            nyaman dan indah. 
            </p>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="../image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-title"><?php echo $data['nama'] ?></h5>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text text-harga"><?php echo $data['harga']; ?></p>
                            <a href="produk-detail.php?q=<?php echo $data['nama']; ?>" class="btn search">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-primary mt-3" href="produk.php">See More</a>
        </div>
    </div>

    <!-- Footer -->
    <?php require "footer.php"; ?>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>