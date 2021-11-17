<?php
    $conn = mysqli_connect("localhost", "root", "", "starbook");

    $kodeBuku = "";
    $namaBuku = "";
    $penerbitBuku = "";
    $hargaBuku = "";
    $kategoriBuku = "";
    $sukses = "";
    $gagal = "";

    if(isset($_POST['tambah'])) {
        $kodeBuku = htmlspecialchars($_POST['kodeb']);
        $namaBuku = htmlspecialchars($_POST['nama']);
        $penerbitBuku = htmlspecialchars($_POST['penerbit']);
        $hargaBuku = htmlspecialchars($_POST['harga']);
        $kategoriBuku = htmlspecialchars($_POST['kategori']);

        $gambar = upload();
        if ( !$gambar) {
            return false;
        }

        $sql1 = "INSERT INTO tambahbuku(kodeBuku, namaBuku, gambarBuku, penerbit, harga, kategori) values ('$kodeBuku', '$namaBuku', '$gambar', '$penerbitBuku', '$hargaBuku', '$kategoriBuku')";
        $q1 = mysqli_query($conn, $sql1);
        
        if (mysqli_affected_rows($conn) > 0) {
            $sukses = "Berhasil input Data";
        } else {
            $gagal = "Gagal input data";
        }
    }

    function upload() {
        $namaFile = $_FILES['input_img']['name'];
        $ukuranFile = $_FILES['input_img']['size'];
        $error = $_FILES['input_img']['error'];
        $tmpName = $_FILES['input_img']['tmp_name'];

        if ($error === 4){
            echo "<script>alert('pilih gambar terlebih dahulu')</script>";
            return false;
        }

        $ektensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ektensiGambar = explode('.', $namaFile);
        $ektensiGambar = strtolower(end($ektensiGambar));

        if(!in_array($ektensiGambar, $ektensiGambarValid)) {
            echo "<script>alert('Yang anda upload bukan gambar!')</script>";
            return false;
        }

        if ( $ukuranFile > 1048576) {
            echo "<script>alert('Ukuran gambar terlalu besar!')</script>";
            return false;
        }

        //Buat nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ektensiGambar;

        move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru);
        return $namaFileBaru;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>

    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/forms.css">

    <!-- Font Awehsome -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container ps-5 pe-5">
            <a class="navbar-brand" href="#">
                <img src="img/icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top"> Star Book
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                <a class="nav-link" href="dataBook.php"><i class="fas fa-cog"></i></a>
                <a class="nav-link active" href="addBook.php"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center">
        <form class="pt-5 mt-5" action="" method="POST" enctype="multipart/form-data">
            <h2>Tambah Buku</h2>
            <?php if ($gagal) { ?>
                <div class="alert alert-danger" role="alert">
                <?php echo $gagal ?>
                </div>
            <?php } ?>

            <?php if ($sukses) { ?>
                <div class="alert alert-info" role="alert">
                <?php echo $sukses ?>
                </div>
            <?php } ?>
            <div class="row pb-4">
                <div class="col">
                    <div id="display_images">
                    </div>
                </div>
                <div class="col d-flex align-items-center">
                    <input type="file" id="image_input" name="input_img" accept="image/png, image/jpg"">
                </div>
            </div>
            <div class="mb-3">
                <label for="kodeBuku" class="form-label">Kode Buku</label>
                <input type="text" class="form-control" id="kodeBuku" name="kodeb" value="<?php echo $kodeBuku ?>">
            </div>
            <div class="mb-3">
                <label for="namaBuku" class="form-label">Nama Buku</label>
                <input type="text" class="form-control" id="namaBuku" name="nama" value="<?php echo $namaBuku ?>">
            </div>
            <div class="mb-3">
                <label for="penerbitBuku" class="form-label">Penerbit Buku</label>
                <input type="text" class="form-control" id="penerbitBuku" name="penerbit" value="<?php echo $penerbitBuku ?>">
            </div>
            <label for="hargaBuku" class="form-label">Harga Buku</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rp</span>
                <input type="text" class="form-control" id="hargaBuku" name="harga" value="<?php echo $hargaBuku ?>">
            </div>
            <div class="mb-3">
                <label for="kategoriBuku" class="form-label">Kategori Buku</label>
                <select class="form-select" name="kategori" id="kategoriBuku" idaria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="novel" <?php if($kategoriBuku == "novel")?>>Novel</option>
                    <option value="komik" <?php if($kategoriBuku == "komik")?>>komik</option>
                    <option value="dongeng" <?php if($kategoriBuku == "dongeng")?>>dongeng</option>
                </select>
            </div>
            <button type="submit" name="tambah" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>

    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/uploadImage.js"></script>
</body>
</html>