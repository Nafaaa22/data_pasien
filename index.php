<!DOCTYPE html>
<html lang="en">
<head>
<title>Data Pasien</title>
</head>
<body>
<?php
include('class/Database.php');
include('class/Pasien.php');

?>
<h1>Aplikasi Data Pasien</h1>
<hr/>
<p>
<a href="index.php">Home</a>
<a href="index.php?file=pasien&aksi=tampil">Data Pasien</a>
<a href="index.php?file=pasien&aksi=tambah">Tambah Data Pasien</a>
</p>
<hr/>
<?php
if(isset($_GET['file'])){
include($_GET['file'].'.php');
} else {
echo '<h1 align="center">Selamat Datang</h1>';
}
?>
</body>
</html>