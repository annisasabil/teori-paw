<?php
    require "session.php";
    require "koneksi.php";

    $id = $_GET['q'];
    $query = mysqli_query($con, "SELECT a. *, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i=0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, $charactersLength -1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-3">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control mt-2" autocomplete="off" value="<?php echo $data['nama'] ?>" required>
                </div>
                <div class="mt-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control mt-2" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                            while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control mt-2" value="<?php echo $data['harga']; ?>" name="harga" required>
                </div>
                <div class="mt-2">
                    <label for="currentFoto">Foto Produk Sekarang </label>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" width="300px">
                </div>
                <div class="mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control mt-2">
                </div>
                <div class="mt-2">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control mt-2">
                        <?php echo $data['detail']; ?>
                    </textarea>
                </div>
                <div class="mt-2">
                    <label for="stock">Stock</label>
                    <select name="stock" id="stock" class="form-control mt-2">
                        <option value="<?php echo $data['stock'] ?>"><?php echo $data['stock'] ?></option>
                        <?php
                            if ($data['stock'] == 'tersedia') {
                        ?>
                            <option value="habis">habis</option>
                        <?php
                            } else {
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>

            <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $stock = htmlspecialchars($_POST['stock']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower (pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Data belum lengkap
                        </div>
            <?php
                    } else {
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', stock='$stock' WHERE id=$id");
                    
                        if ($nama_file != '') {
                            if ($image_size > 500000) {
            ?>                  
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 500 Kb
                                </div>
            <?php
                            } else {
                                if ($imageFileType != 'jpg' && $imageFileType != 'png') {
            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        File harus bertipe jpg atau png
                                    </div>
            <?php

                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name );
                                    
                                    $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                                    if ($queryUpdate) {
            ?>                  
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Data berhasil diupdate
                                        </div>

                                        <meta http-equiv="refresh" content="1; url=produk.php" />
            <?php
                                    } else {
                                        echo mysqli_error($con);
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['hapus'])) {
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

                    if ($queryHapus) {
            ?>      
                        <div class="alert alert-primary mt-3" role="alert">
                            Data berhasil dihapus
                        </div>

                        <meta http-equiv="refresh" content="1; url=produk.php" />
            <?php
                    }
                }
            ?>
        </div>
    </div>
    <script src="../bootstrap/js/bootsrap.bundle.min.js"></script>
</body>
</html>