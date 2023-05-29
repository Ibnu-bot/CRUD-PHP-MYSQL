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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan id peminjaman
    if (isset($_GET['idpeminjaman'])) {
        $idpeminjaman=input($_GET["idpeminjaman"]);

        $sql="SELECT * from peminjaman where idpeminjaman=$idpeminjaman";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $idpeminjaman=htmlspecialchars($_POST["idpeminjaman"]);
        $nomor_bukti=input($_POST["nomor_bukti"]);
        $kode_buku=input($_POST["kode_buku"]);
        $kode_anggota=input($_POST["kode_anggota"]);
        $tgl_pinjam=input($_POST["tgl_pinjam"]);
        $tgl_dikembalikan=input($_POST["tgl_dikembalikan"]);
        //Query input menginput data kedalam tabel peminjaman

         //Query update data pada tabel peminjaman
         $sql="update peminjaman set
            idpeminjaman='$idpeminjaman',
            nomor_bukti='$nomor_bukti',
            kode_buku='$kode_buku',
            kode_anggota='$kode_anggota',
            tgl_pinjam='$tgl_pinjam',
            tgl_dikembalikan='$tgl_dikembalikan'
            WHERE idpeminjaman=$idpeminjaman";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../peminjaman/index.php?pesan=Data Berhasil Diupdate");
        }
        else{
            header("Location:../peminjaman/index.php?pesan=Data Gagal Diupdate");
        }

    }
    ?>
        <h2>Update Data</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label>Kode peminjaman</label>
                <input type="text" disabled name="idpeminjaman" class="form-control"
                    value="<?php echo $data['idpeminjaman']; ?>" placeholder="Masukan Kode peminjaman" required />

            </div>
            <div class="form-group">
                <label>nomor_bukti</label>
                <input type="text" name="nomor_bukti" class="form-control" value="<?php echo $data['nomor_bukti']; ?>"
                    placeholder="Masukan nomor_bukti" required />

            </div>
    </div>
    <div class="form-group">
        <label>Kode Buku</label>
        <select name="kode_buku" class="form-control" value="<?php echo $data['kode_buku']; ?>">
            <option value="101">101</option>
            <option value="102">102</option>
            <option value="103">103</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kode Anggota</label>
        <select name="kode_anggota" class="form-control" value="<?php echo $data['kode_anggota']; ?>">
            <option value="111">111</option>
            <option value="112">112</option>
            <option value="113">113</option>
        </select>
    </div>
    <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control" value="<?php echo $data['tgl_pinjam']; ?>"
            placeholder="Masukan Tanggal Pinjam" required />
    </div>
    <div class="form-group">
        <label>Tanggal Dikembalikan</label>
        <input type="date" name="tgl_dikembalikan" class="form-control" value="<?php echo $data['tgl_dikembalikan']; ?>"
            placeholder="Masukan Tanggal Dikembalikan" required />
    </div>

    <input type="hidden" name="idpeminjaman" value="<?php echo $data['idpeminjaman']; ?>" />
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
</body>

</html>