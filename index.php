<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');

    $conn = mysqli_connect("localhost", "root", "", "starbook");

    $dataBuku = query("SELECT * FROM tambahbuku");

    if (isset($_POST["cari"])) {
        $dataBuku = cari($_POST["keyword"]);
    }

    if (isset($_POST["terapkan"])) {
        $dataBuku = filtering($_POST["kategoriB"]);
    }
    

    if (isset($_POST['add_cart'])){
        if (isset($_SESSION['keranjang'])){

            $item_array_kode = array_column($_SESSION['keranjang'], "kode");
            if (!in_array($_GET['kodeBuku'], $item_array_kode)){
                $count = count($_SESSION['keranjang']);
                $item_array = array (
                    'kode' => $_GET['kodeBuku'],
                    'nama' => $_POST['hidden_nama'],
                    'harga' => $_POST['hidden_harga']
                );
                $_SESSION['keranjang'][$count] = $item_array;
            } else {
                echo '<script>alert("item sudah ditambahkan")</script>';
                echo '<script>window.location="index.php"</script>';
            }

        } else {
            $item_array = array (
                'kode' => $_GET['kodeBuku'],
                'nama' => $_POST['hidden_nama'],
                'harga' => $_POST['hidden_harga']
            );
            $_SESSION['keranjang'][0] = $item_array;
        }
    }

    //delete cart
    if(isset($_GET["action"])) {
        if($_GET["action"] == "delete") {
            foreach($_SESSION["keranjang"] as $keys => $values){
                if($values['kode'] == $_GET['kodeBuku']) {
                    unset($_SESSION['keranjang'][$keys]);
                    echo '<script>alert("Item sudah dihapus")</script>';
                    echo '<script>window.location="index.php"</script>';
                }
            }
        }
    }

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function cari($keyword) {
        $query = "SELECT * FROM tambahbuku WHERE namaBuku LIKE '%$keyword%' OR penerbit LIKE '%$keyword%'";
        return query($query);
    }

    function filtering($keyword) {
        $query = "SELECT * FROM tambahbuku WHERE kategori = '$keyword'";
        return query($query);
    }

    if (isset($_POST['bayar'])) {
        $tanggalTransaksi = $_POST['hidden_tanggal'];
        $waktuTransaksi = $_POST['hidden_waktu'];
        $namaBook = $_POST['hidden_nama'];
        $hargaBook = $_POST['hidden_harga'];
        $totalHarga = $_POST['hidden_total'];
        $query = "INSERT INTO pesanan VALUES ('$tanggalTransaksi','$waktuTransaksi','$namaBook','$hargaBook','$totalHarga')";

        $q1 = mysqli_query($conn, $query);
    }
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
    <link rel="stylesheet" href="css/styles.css">

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
                <a class="nav-link" href="penjualan.php"><i class="fas fa-shopping-cart"></i></a>
                <a class="nav-link" href="dataBook.php"><i class="fas fa-cog"></i></a>
                <a class="nav-link" href="addBook.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"><i class="fas fa-plus"></i></a>
                <a class="nav-link" href="about.php">About</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-2 p-4 border-end">
                <h3 class="mb-5">filter</h3>
                <label for="inputGroupSelect01" class="form-label">Kategori</label>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <select class="form-select" id="inputGroupSelect01" name="kategoriB">
                            <option selected disabled>-- Pilih Kategori</option>
                            <option value="novel">novel</option>
                            <option value="komik">komik</option>
                            <option value="dongeng">dongeng</option>
                        </select>
                    </div>
                    <button name="terapkan" type="submit" class="btn btn-warning btn-filter">Terapkan</button>
                </form>
            </div>
            <div class="col">
                <form method="POST">
                    <input class="style-search p-1" type="text" name="keyword" id="" placeholder="Cari Buku">
                    <button class="btn btn-dark" type="submit" name="cari">Cari</button>
                </form>
                
                <ul class="pt-3">
                <?php foreach($dataBuku as $row) : ?>
                    <form method="post" action="index.php?kodeBuku=<?= $row['kodeBuku'];?>">
                        <li class="shadow-sm rounded-3">
                            <img src="uploads/<?= $row["gambarBuku"]; ?>" class="img-view" alt="">
                            <div class="info-book">
                                <h6 class="pt-2"><?= $row["namaBuku"]; ?></h6>
                                <p style="margin:0; color:midnightblue; font-weight:500;">Rp <?= number_format($row["harga"],0,',','.'); ?></p>
                                <input type="hidden" name="hidden_nama" value="<?php echo $row["namaBuku"]; ?>">
                                <input type="hidden" name="hidden_harga" value="<?php echo $row["harga"]; ?>">
                                <button type="submit" name="add_cart" class="btn btn-info mt-3" style="width: 100%;"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </li>
                    </form>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-4 border-start">
                <h3>Keranjang</h3>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Buku</th>
                            <th scope="col">Harga</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $namaB = array();
                        $hargaB = array();
                        $total = 0;
                        if(!empty($_SESSION["keranjang"])) {
                            foreach($_SESSION["keranjang"] as $keys => $values){
                        ?>
                        <form action="" method="post">
                            <tr class="align-middle">
                                <td><?php echo $values["kode"];?></td>
                                <td><?php echo $values["nama"];?></td>
                                <td>Rp <?php echo number_format($values["harga"],0,' ','.');?></td>
                                <td><a href="index.php?action=delete&kodeBuku=<?php echo $values['kode'];?>"><span class="text-danger">hapus</span></a></td>
                            </tr>
                        <?php
                            array_push($namaB, $values['nama']);
                            array_push($hargaB, $values['harga']);
                            $total = $total + $values["harga"];
                            }
                            $nama_buku = implode(", ", $namaB);
                            $harga_buku = implode(", ", $hargaB);

                            
                        }
                        ?>
                            <tr class="align-middle">
                                <td colspan="2" align="right">Total</td>
                                <td>Rp <?php echo number_format($total,0,' ','.'); ?></td>
                                <input type="hidden" name="hidden_nama" value="<?php echo $nama_buku ?>">
                                <input type="hidden" name="hidden_harga" value="<?php echo $harga_buku ?>">
                                <input type="hidden" name="hidden_tanggal" value="<?php echo date("Y-m-d");?>">
                                <input type="hidden" name="hidden_waktu" value="<?php echo date("h:i:s");?>">
                                <input type="hidden" name="hidden_total" value="<?php echo strval($total)?>">
                                <td><button type="submit" class="btn btn-dark" name="bayar">Bayar</button></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
  </body>
</html>