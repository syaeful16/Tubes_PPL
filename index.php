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
            <a class="navbar-brand" href="#">
                <img src="img/icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top"> Star Book
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                <a class="nav-link" href="#"><i class="fas fa-cog"></i></a>
                <a class="nav-link" href="addBook.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-2 p-4 border-end">
                <h3 class="mb-5">filter</h3>
                <label for="inputGroupSelect01" class="form-label">Penerbit</label>
                <div class="input-group mb-3">
                    <select class="form-select" id="inputGroupSelect01">
                      <option selected>Choose...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                </div>
                <label for="customRange2" class="form-label">Example range</label>
                <input type="range" class="form-range" min="0" max="5" id="customRange2">
                <button type="button" class="btn btn-warning btn-filter">Terapkan</button>
            </div>
            <div class="col">
                <div>
                    <input class="style-search p-1" type="text" name="pencarian" id="" placeholder="Cari Buku">
                    <button class="btn btn-dark">Cari</button>
                </div>
                
                <ul class="pt-3">
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                    <li class="shadow-sm rounded-3">
                        <img src="uploads/<?php echo $row["gambarBuku"]?>" class="img-view" alt="">
                        <div class="info-book">
                            <p><?php echo $row["namaBuku"]?></p>
                            <p>Rp <?php echo $row["harga"]?></p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="col-3 border-start">
                <h3>Keranjang</h3>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
  </body>
</html>