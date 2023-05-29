<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css"
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>PAGE ANGGOTA</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="perpuscoba/anggota/index.php">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../buku/index.php">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../kategori/index.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../peminjaman/index.php">Peminjaman</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->
    <div class="card">
        <div class="card-header" style="background-color: #48D1CC;">
            CRUD - Anggota
        </div>
        <div class="card-body">
            <p class="card-text">IBNU HASAN || 200511148 || R4</p>
            <h5 class="card-title">PemWeb. CRUD PHP & MYSQL</h5>
        </div>
        <?php
            if(isset($_GET['pesan'])) {
                $asan = $_GET['pesan'];
                echo "<div class='alert alert-success'> $asan </div>";
            }else{

            }
            ?>
        <?php

            include("../../perpuscoba/koneksi.php");

                //Cek apakah ada kiriman form dari method post
                if (isset($_GET['kode_anggota'])) {
                    $kode_anggota=($_GET["kode_anggota"]);

                    $sql="DELETE FROM anggota where kode_anggota='$kode_anggota' ";
                    $hasil=mysqli_query($kon,$sql);

                    //Kondisi apakah berhasil atau tidak
                        if ($hasil) {
                            echo "<div class='alert alert-danger'> Data Berhasil Dihapus.</div>";
                        }
                        else {
                            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

                        }
                    }
            ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kode Anggota</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php
                            $no = 1;
                            $ih = mysqli_query($kon, "SELECT * FROM anggota INNER JOIN buku ON buku.kode_buku=anggota.kode_buku");
                            while ($data = mysqli_fetch_array($ih)) :

                    ?>

                <tbody>
                    <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $data["kode_anggota"]; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["jk"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td><?php echo $data["kode_buku"]; ?></td>
                        <td>
                            <a href="edit.php?kode_anggota=<?php echo($data['kode_anggota']); ?>"
                                class="btn btn-warning" role="button">Edit</a>
                            <a href="<?php echo ($_SERVER["PHP_SELF"]);?>?kode_anggota=<?php echo $data['kode_anggota']; ?>"
                                class="btn btn-danger" role="button">Hapus</a>
                        </td>
                    </tr>
                </tbody>
                <?php
                            endwhile;
                        ?>
                </thead>
            </table>
            <div class="d-grid gap-3 d-md-flex justify-content-md-center p-3">
                <a href="tambah.php" class="btn btn-primary" role="button">Tambah</a>
            </div>
        </div>
    </div>
    </div>

    <!-- FOOTER START -->
    <footer class="text-center text-white" style="background-color: #f1f1f1;">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">

                <!-- Whatsapp -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://wa.me/+6283824887783"
                    role="button" data-mdb-ripple-color="dark"><i class="fab fa-whatsapp"></i></a>

                <!-- Google -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="mailto:ibnuibnu239@gmail.com"
                    role="button" data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://instagram.com/ibnuhasan029"
                    role="button" data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1"
                    href="https://www.linkedin.com/in/ibnu-hasan-0123721b4/" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-linkedin"></i></a>
                <!-- Github -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="https://github.com/Ibnu-bot"
                    role="button" data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center text-dark p-3" style="margin-top:50px; background-color:
            #48D1CC;">
            © 2023 Copyright
            <a class="text-dark text-decoration-none" href="https://mdbootstrap.com/">Ibnu Hasan</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
</body>

</html>