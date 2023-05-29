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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan kode_kategori
    if (isset($_GET['kode_kategori'])) {
        $kode_kategori=input($_GET["kode_kategori"]);

        $sql="SELECT * from kategori where kode_kategori=$kode_kategori";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $kode_kategori=htmlspecialchars($_POST["kode_kategori"]);
        $nama_kategori=input($_POST["nama_kategori"]);
        //Query input menginput data kedalam tabel kategori

         //Query update data pada tabel anggota
         $sql="update kategori set kode_kategori='$kode_kategori', nama_kategori='$nama_kategori' WHERE kode_kategori=$kode_kategori";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../kategori/index.php?pesan=Data Berhasil Diupdate");
        }
        else{
            header("Location:../kategori/index.php?pesan=Data Gagal Diupdate");
        }

    }
    ?>
        <h2>Update Data</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Kode Kategori</label>
                <input type="text" disabled name="kode_kategori" class="form-control"
                    value="<?php echo $data['kode_kategori']; ?>" placeholder="Masukan Kode Kategori" required />
            </div>
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control"
                    value="<?php echo $data['nama_kategori']; ?>" placeholder="Masukan Nama Kategori" required />
            </div>
            <input type="hidden" name="kode_kategori" value="<?php echo $data['kode_kategori']; ?>" />
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>