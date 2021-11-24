<?php
    $conn = mysqli_connect("localhost", "root", "", "starbook");

    $result = mysqli_query($conn, "SELECT * FROM pesanan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Buku</title>

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
            <a class="navbar-brand" href="index.php">
                <img src="img/icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top"> Star Book
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="#"><i class="fas fa-shopping-cart"></i></a>
                <a class="nav-link" href="dataBook.php"><i class="fas fa-cog"></i></a>
                <a class="nav-link" href="addBook.php"><i class="fas fa-plus"></i></a>
                <a class="nav-link" href="about.php">About</a>
            </div>
        </div>
    </nav>
    <div class="container"  class="d-flex justify-content-center align-items-center">
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Waktu Transaksi</th>
                    <th scope="col">Nama Buku</th>
                    <th scope="col">Harga Buku</th>
                    <th scope="col">Total Harga</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $row['tanggalTransaksi'];?></td>
                    <th><?php echo $row['JamTransaksi'];?></th>
                    <td><?php echo $row['namaBuku'];?></td>
                    <td><?php echo $row['hargaBuku'];?></td>
                    <td><?php echo $row['totalHarga']?></td>
                </tr>
            <?php endwhile; ?>
            <tbody>
        </table>
    </div>
</body>
</html>