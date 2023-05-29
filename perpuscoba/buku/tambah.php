<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>PAGE TAMBAH DATA</title>
</head>

<body>
    <div class="container">
        <?php
        //Include file koneksi, untuk koneksikan ke database
        include("../../perpuscoba/koneksi.php");

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $kode_buku = input($_POST["kode_buku"]);
            $judul = input($_POST["judul"]);
            $pengarang = input($_POST["pengarang"]);
            $tahun = input($_POST["tahun"]);
            $kode_kategori = input($_POST["kode_kategori"]);

            //Query input menginput data kedalam tabel kategori
            //Mengeksekusi/menjalankan query diatas
            $koko = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM buku WHERE kode_buku=$kode_buku"));
            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($koko > 0) {
                echo "<div class='alert alert-danger'> Data Sudah Ada </div>";
            } else {
                $sql = "INSERT INTO buku (kode_buku,judul,pengarang,tahun,kode_kategori) values
            ('$kode_buku','$judul','$pengarang','$tahun','$kode_kategori')";
                $hasil = mysqli_query($kon, $sql);
                if ($hasil) {
                    header("Location:../buku/index.php?pesan=Data Berhasil Disimpan");
                } else {
                    header("Location:../buku/index.php?pesan=Data Gagal Disimpan");
                }
            }

        }
        ?>
        <h2>Input Data</h2>


        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Kode Buku</label>
                <input type="text" name="kode_buku" class="form-control" placeholder="Masukan Kode Buku" required />

            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Buku" required />

            </div>
            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" placeholder="Masukan Pengarang" required />

            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="tahun" class="form-control" placeholder="Masukan Tahun" required />
            </div>
            <div class="form-group">
                <label>Kode Kategori</label>
                <select name="kode_kategori" class="form-control">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>