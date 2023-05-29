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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan kode_anggota
    if (isset($_GET['kode_anggota'])) {
        $kode_anggota=input($_GET["kode_anggota"]);

        $sql="SELECT * from anggota where kode_anggota=$kode_anggota";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $kode_anggota=htmlspecialchars($_POST["kode_anggota"]);
        $nama=input($_POST["nama"]);
        $jenis_kelamin=input($_POST["jk"]);
        $alamat=input($_POST["alamat"]);
        $kode_buku=input($_POST["kode_buku"]);
        //Query input menginput data kedalam tabel anggota

         //Query update data pada tabel anggota
         $sql="update anggota set
            kode_anggota='$kode_anggota',
            nama='$nama',
            jk='$jenis_kelamin',
            alamat='$alamat',
            kode_buku='$kode_buku'
            WHERE kode_anggota=$kode_anggota";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../anggota/index.php?pesan=Data Berhasil Diupdate");
        }
        else{
            header("Location:../anggota/index.php?pesan=Data Gagal Diupdate");
        }

    }
    ?>
        <h2>Update Data</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Kode Anggota</label>
                <input type="text" disabled name="kode_anggota" class="form-control"
                    value="<?php echo $data['kode_anggota']; ?>" placeholder="Masukan Kode Anggota" required />

            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>"
                    placeholder="Masukan Nama" required />

            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control" value="<?php echo $data['jk']; ?>">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>"
                    placeholder="Masukan Alamat" required />
            </div>
            <div class="form-group">
                <label>Kode Buku</label>
                <select name="kode_buku" class="form-control" value="<?php echo $data['kode_buku']; ?>">
                    <option value="101">101</option>
                    <option value="102">102</option>
                    <option value="103">103</option>
                </select>

            </div>

            <input type="hidden" name="kode_anggota" value="<?php echo $data['kode_anggota']; ?>" />
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>