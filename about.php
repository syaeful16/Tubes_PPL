<?php
    $conn = mysqli_connect("localhost", "root", "", "starbook");

    $result = mysqli_query($conn, "SELECT * FROM tambahbuku");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <!-- My CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awehsome -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">

    <title>Bookstore</title>
    <link rel="shortcut icon" href="img/icon.png">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container ps-5 pe-5">
            <a class="navbar-brand" href="index.php">
                <img src="img/icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top"> Star Book
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="penjualan.php"><i class="fas fa-shopping-cart"></i></a>
                <a class="nav-link" href="dataBook.php"><i class="fas fa-cog"></i></a>
                <a class="nav-link" href="addBook.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"><i class="fas fa-plus"></i></a>
                <a class="nav-link" href="about.php">About</a>
            </div>
        </div>
    </nav>
  </head>
  <body>
  <h1 class="team-caption" style="text-align: center; padding-top: 50px; color: #FF5500; font-family: 'Roboto'; font-weight: bold;">
    This Web
    <p class="team-caption" style="text-align: center; padding-top: 50px; color: #000000; font-family: 'Roboto'; font-weight: bold;">
    Star Book Berbasis Web Site ini adalah suatu sistem manajemen data
    bagi suatu toko untuk dapat memudahkannya dalam melakukkan transaksi
    maupun dalam menemukan informasi terkait buku yang dicari serta dapat
    menyimpan data base yang ada.
      <h1 class="team-caption" style="text-align: center; padding-top: 50px; color: #FF5500; font-family: 'Roboto'; font-weight: bold;">
        Team Project
      <div class="row" style="padding-top: 50px;">
        <div class="col ms-auto" style="padding-left: 20px;">
        <img src="img/gambar5.png" alt="" width="200" height="194">
        <h3 style="text-align: center;">Eka</h3>
    </div>
    <div class="col">
        <img src="img/gambar4.jpg" alt="" width="200" height="194">
        <h3 style="text-align: center;">Arnas</h3>
    </div>
    <div class="col">
        <img src="img/gambar4.jpg" alt="" width="200" height="194">
        <h3 style="text-align: center;">Ricky</h3>
    </div>
    <div class="col">
        <img src="img/gambar5.png" alt="" width="200" height="194">
        <h3 style="text-align: center;">Azizah</h3>
    </div>
    <div class="col">
        <img src="img/gambar1.jpg" alt="" width="200" height="194">
        <h3 style="text-align: center;">Mufid</h3>
    </div>
    <div class="col">
        <img src="img/gambar1.jpg" alt="" width="200" height="194">
        <h3 style="text-align: center;">Fadlan</h3>
    </div>
</body>
</html>