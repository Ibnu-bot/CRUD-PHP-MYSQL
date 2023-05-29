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

            $idpeminjaman = input($_POST["idpeminjaman"]);
            $nomor_bukti = input($_POST["nomor_bukti"]);
            $kode_buku = input($_POST["kode_buku"]);
            $kode_anggota = input($_POST["kode_anggota"]);
            $tgl_pinjam = input($_POST["tgl_pinjam"]);
            $tgl_dikembalikan = input($_POST["tgl_dikembalikan"]);

            //Query input menginput data kedalam tabel anggota
            //Mengeksekusi/menjalankan query diatas
            $koko = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM peminjaman WHERE idpeminjaman=$idpeminjaman"));
            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($koko > 0) {
                echo "<div class='alert alert-danger'> Data Sudah Ada </div>";
            } else {
                $sql = "INSERT INTO peminjaman (idpeminjaman,nomor_bukti,kode_buku,kode_anggota,tgl_pinjam,tgl_dikembalikan) values
            ('$idpeminjaman','$nomor_bukti','$kode_buku','$kode_anggota','$tgl_pinjam','$tgl_dikembalikan')";
                $hasil = mysqli_query($kon, $sql);
                if ($hasil) {
                    header("Location:../peminjaman/index.php?pesan=Data Berhasil Disimpan");
                } else {
                    header("Location:../peminjaman/index.php?pesan=Data Gagal Disimpan");
                }
            }

        }
        ?>
        <h2>Input Data</h2>


        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>ID Peminjaman</label>
                <input type="text" name="idpeminjaman" class="form-control" placeholder="Masukan ID Peminjaman"
                    required />

            </div>
            <div class="form-group">
                <label>Nomor Bukti</label>
                <input type="text" name="nomor_bukti" class="form-control" placeholder="Masukan Nomor Bukti" required />

            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <select class="form-control" name="kode_buku">
                    <?php
                    $tbh = mysqli_query($kon, "SELECT * FROM buku");
                    foreach ($tbh as $op) {
                        ?>

                    <option value="<?= $op['kode_buku'] ?>"><?php echo $op['judul']; ?></option>
                    <?php  } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Anggota</label>
                <select class="form-control" name="kode_anggota">
                    <?php
                    $tbh = mysqli_query($kon, "SELECT * FROM anggota");
                    foreach ($tbh as $op) {
                        ?>

                    <option value="<?= $op['kode_anggota'] ?>"><?php echo $op['nama']; ?></option>
                    <?php  } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" class="form-control" placeholder="Masukan Tanggal Pinjam"
                    required />
            </div>
            <div class="form-group">
                <label>Tanggal Dikembalikan</label>
                <input type="date" name="tgl_dikembalikan" class="form-control"
                    placeholder="Masukan Tanggal Dikembalikan" required />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>