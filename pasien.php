<?php
// membuat instance
$data_pasien=NEW Pasien;
// aksi tampil data
if($_GET['aksi']=='tampil'){
// aksi untuk tampil data
$html = null;
$html .='<h3>Daftar Pasien</h3>';
$html .='<p>Berikut ini data Pasien</p>';
$html .='<table border="1" width="100%">
<thead>
<th>Id Pasien</th>
<th>Nama Pasien</th>
<th>Kamar Pasien</th>
<th>Check In</th>
<th>Check Out</th>
<th>Umur</th>
<th>L/P</th>
<th>Aksi</th>
</thead>
<tbody>';
// variabel $data menyimpan hasil return
$data = $data_pasien->tampil();
$no=null;
if(isset($data)){
foreach($data as $barisPasien){
$no++;
$html .='<tr>
<td>'.$barisPasien->id_pasien.'</td>
<td>'.$barisPasien->nama_pasien.'</td>
<td>'.$barisPasien->kamar_pasien.'</td>
<td>'.$barisPasien->check_in.'</td>
<td>'.$barisPasien->check_out.'</td>
<td>'.$barisPasien->umur.'</td>
<td>'.$barisPasien->jenis_kelamin.'</td>
<td>
<a href="index.php?file=pasien&aksi=edit&idpasien='.$barisPasien->id_pasien.'">Edit</a>
<a href="index.php?file=pasien&aksi=hapus&idpasien='.$barisPasien->id_pasien.'">Hapus</a>
</td>
</tr>';
}
}
$html .='</tbody>
</table>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='tambah') {
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=pasien&aksi=simpan">';
$html .='<p>Id Pasien<br/>';
$html .='<input type="text" name="txtIdPasien"placeholder="Masukan Id Pasien" autofocus/></p>';
$html .='<p>Nama Pasien<br/>';
$html .='<input type="text" name="txtNamaPasien"placeholder="Masukan Nama Lengkap" size="30" required/></p>';
$html .='<p>Kamar Pasien<br/>';
$html .='<input type="text" name="txtKamarPasien"placeholder="Masukan No Kamar Pasien" size="30" required/></p>';
$html .='<p>Check In<br/>';
$html .='<input type="date" name="txtCheckIn"required/></p>';
$html .='<p>Check Out<br/>';
$html .='<input type="date" name="txtCheckOut"required/></p>';
$html .='<p>Umur<br/>';
$html .='<input type="text" name="txtUmur"placeholder="Masukan Umur Pasien" size="30" required/></p>';
$html .='<p>Jenis_Kelamin<br/>';
$html .='<input type="radio" name="txtJenis_Kelamin"value="L"> Laki-laki';
$html .='<input type="radio" name="txtJenis_Kelamin"value="P"> Perempuan</p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='simpan') {
$data=array(
'id_pasien'=>$_POST['txtIdPasien'],
'nama_pasien'=>$_POST['txtNamaPasien'],
'kamar_pasien'=>$_POST['txtKamarPasien'],
'check_in'=>$_POST['txtCheckIn'],
'check_out'=>$_POST['txtCheckOut'],
'umur'=>$_POST['txtUmur'],
'jenis_kelamin'=>$_POST['txtJenis_Kelamin']
);
// simpan pasien dengan menjalankan method simpan
$data_pasien->simpan($data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=pasien&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='edit') {
// ambil data pasien
$pasien=$data_pasien->detail($_GET['idpasien']);
if($pasien->jenis_kelamin =='L') { $pilihL='checked';
$pilihP =null; }
else {
$pilihL='checked'; $pilihP =null; }
$html =null;
$html .='<h3>Form Tambah</h3>';
$html .='<p>Silahkan masukan form </p>';
$html .='<form method="POST"action="index.php?file=pasien&aksi=update">';
$html .='<p>Id pasien<br/>';
$html .='<input type="text" name="txtIdPasien"value="'.$pasien->id_pasien.'" placeholder="Masukan Id Pasien" readonly/></p>';
$html .='<p>Nama Pasien<br/>';
$html .='<input type="text" name="txtNamaPasien"value="'.$pasien->nama_pasien.'" placeholder="Masukan Nama Lengkap"size="30" required autofocus/></p>';
$html .='<p>Kamar Pasien<br/>';
$html .='<input type="text" name="txtKamarPasien"value="'.$pasien->kamar_pasien.'" placeholder="Masukan No. Kamar" required/></p>';
$html .='<p>Check In<br/>';
$html .='<input type="date" name="txtCheckIn" value="'.$pasien->check_in.'"required/></p>';
$html .='<p>Check Out<br/>';
$html .='<input type="date" name="txtCheckOut" value="'.$pasien->check_out.'"required/></p>';
$html .='<p>Umur<br/>';
$html .='<input type="text" name="txtUmur"value="'.$pasien->umur.'" placeholder="Masukan Umur" required/></p>';
$html .='<p>Jenis Kelamin<br/>';
$html .='<input type="radio" name="txtJenis_Kelamin"value="L" '.$pilihL.'> Laki-laki';
$html .='<input type="radio" name="txtJenis_Kelamin"value="P" '.$pilihP.'> Perempuan</p>';
$html .='<p><input type="submit" name="tombolSimpan"value="Simpan"/></p>';
$html .='</form>';
echo $html;
}
// aksi tambah data
else if ($_GET['aksi']=='update') {
$data=array(
'id_pasien'=>$_POST['txtIdPasien'],
'nama_pasien'=>$_POST['txtNamaPasien'],
'kamar_pasien'=>$_POST['txtKamarPasien'],
'check_in'=>$_POST['txtCheckIn'],
'check_out'=>$_POST['txtCheckOut'],
'umur'=>$_POST['txtUmur'],
'jenis_kelamin'=>$_POST['txtJenis_Kelamin']
);
$data_pasien->update($_POST['txtIdPasien'],$data);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=pasien&aksi=tampil">';
}
// aksi tambah data
else if ($_GET['aksi']=='hapus') {
$data_pasien->hapus($_GET['idpasien']);
echo '<meta http-equiv="refresh" content="0;
url=index.php?file=pasien&aksi=tampil">';
}
// aksi tidak terdaftar
else {
echo '<p>Error 404 : Halaman tidak ditemukan !</p>';
}
?>
