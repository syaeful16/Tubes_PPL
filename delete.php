<?php
    $conn = mysqli_connect("localhost", "root", "", "starbook");

    $kodeBuku = $_GET["kodeBuku"];
    if (hapus($kodeBuku) > 0) {
        echo 
            "<script>
                alert('Data berhasil dihapus');
                document.location.href = 'dataBook.php';
            </script>";
    } else {
        echo 
            "<script>
                alert('Data gagal dihapus');
                document.location.href = 'dataBook.php';
            </script>";
    }

    function hapus($kodeBuku) {
        global $conn;
        mysqli_query($conn, "DELETE FROM tambahbuku WHERE kodeBuku = $kodeBuku");

        return mysqli_affected_rows($conn);
    }
?>