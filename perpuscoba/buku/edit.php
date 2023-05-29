<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>PAGE EDIT DATA</title>
</head>

<body>
    <div class="container">
        <?php
    //Include file koneksi, untuk koneksikan ke database
    include("../../perpuscoba/koneksi.php");

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan kode_buku
    if (isset($_GET['kode_buku'])) {
        $kode_buku=input($_GET["kode_buku"]);

        $sql="SELECT * from buku where kode_buku=$kode_buku";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $kode_buku=htmlspecialchars($_POST["kode_buku"]);
        $judul=input($_POST["judul"]);
        $pengarang=input($_POST["pengarang"]);
        $tahun=input($_POST["tahun"]);
        $kode_kategori=input($_POST["kode_kategori"]);
        //Query input menginput data kedalam tabel buku

         //Query update data pada tabel anggota
         $sql="update buku set
            kode_buku='$kode_buku',
            judul='$judul',
            pengarang='$pengarang',
            tahun='$tahun',
            kode_kategori='$kode_kategori'
            WHERE kode_buku=$kode_buku";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../buku/index.php?pesan=Data Berhasil Diupdate");
        }
        else{
            header("Location:../buku/index.php?pesan=Data Gagal Diupdate");
        }

    }
    ?>
        <h2>Update Data</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Kode Buku</label>
                <input type="text" disabled name="kode_buku" class="form-control"
                    value="<?php echo $data['kode_buku']; ?>" placeholder="Masukan Kode Buku" required />
            </div>
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?php echo $data['judul']; ?>"
                    placeholder="Masukan Judul Buku" required />
            </div>
            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="<?php echo $data['pengarang']; ?>"
                    placeholder="Masukan Pengarang" required />
            </div>
            <div class="form-group">
                <label>Tahun</label>
                <input type="text" name="tahun" class="form-control" value="<?php echo $data['tahun']; ?>"
                    placeholder="Masukan Tahun" required />
            </div>
            <div class="form-group">
                <label>Kode Kategori</label>
                <select name="kode_kategori" class="form-control" value="<?php echo $data['kode_kategori']; ?>">
                    <option value="01">01</option>
                    <option value="02">02 </option>
                    <option value="03">03 </option>
                </select>

            </div>

            <input type="hidden" name="kode_buku" value="<?php echo $data['kode_buku']; ?>" />
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>