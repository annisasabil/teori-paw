<?php
    require "../adminpanel/koneksi.php";

    $q = htmlspecialchars($_GET['q']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$q'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND 
    id!='$produk[id]' LIMIT 5");
    $produkTerkait = mysqli_fetch_array($queryProdukTerkait);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Home Kit | Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
    
<body>
    <?php require "navbar.php"; ?> 

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="../image/<?php echo $produk['foto']; ?>" class="w-100"alt="">
                </div>
                <div class="col-md-6 offset-md-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p class="fs-5"><?php echo $produk['detail']; ?></p>
                    <p class="fs-4 text-harga"><?php echo $produk['harga']; ?></p>
                    <p class="fs-5">Status Ketersediaan: <strong><?php echo $produk['stock']; ?></strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="container-fluid py-5 navbar-custom">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
            <div class="row">
                <a href="produk-detail.php?q=<?php echo $data['nama'] ?>">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)){ ?>
                <div class="col-md-6 col-lg-3">
                    <img src="../image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-terkait-image" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <?php require "footer.php"; ?>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>