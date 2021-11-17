<?php
    $conn = mysqli_connect("localhost", "root", "", "starbook");

    $result = mysqli_query($conn, "SELECT * FROM tambahbuku");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/list.css">

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
                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                <a class="nav-link active" href="dataBook.php"><i class="fas fa-cog"></i></a>
                <a class="nav-link" href="addBook.php"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </nav>
    <div class="container"  class="d-flex justify-content-center align-items-center">
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Nama Buku</th>
                    <th scope="col">Gambar Buku</th>
                    <th scope="col">Penerbit Buku</th>
                    <th scope="col">Harga Buku</th>
                    <th scope="col">Kategori Buku</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $row["kodeBuku"]?></td>
                    <td><?php echo $row["namaBuku"]?></td>
                    <td><img src="uploads/<?php echo $row["gambarBuku"]?>" alt="" srcset="" height="80px"></td>
                    <td><?php echo $row["penerbit"]?></td>
                    <td>Rp <?php echo $row["harga"]?></td>
                    <td><?php echo $row["kategori"]?></td>
                    <td>
                        <a href="#" class="pe-4"><i class="fas fa-edit size"></i></a>
                        <a href="delete.php?kodeBuku=<?= $row["kodeBuku"];?>"><i class="fas fa-times color-delete size"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <tbody>
        </table>

            


        </table>
    </div>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/uploadImage.js"></script>
</body>
</html>