<?php
session_start();
include'koneksi.php';
if(!isset($_SESSION["login"])){
  header("Location: logout.php");
  exit;
}
$id=$_COOKIE['id_cookie'];
$result1 = mysqli_query($koneksi, "SELECT * FROM account a INNER JOIN karyawan b on b.id_karyawan=a.id_karyawan WHERE b.id_karyawan = '$id'");
$data1 = mysqli_fetch_array($result1);
$id1 = $data1['id_karyawan'];
$jabatan_valid = $data1['jabatan'];
if ($jabatan_valid == 'Admin') {

}

else{  header("Location: logout.php");
exit;
}
$tanggal_awal = htmlspecialchars($_POST['tanggal1']);
$tanggal_akhir = htmlspecialchars($_POST['tanggal2']);
$no_pengeluaran = htmlspecialchars($_POST['no_pengeluaran']);
$tanggal = htmlspecialchars($_POST['tanggal']);
$akun = $_POST['akun'];
$nama_item = htmlspecialchars($_POST['nama_item']);
$qty = htmlspecialchars($_POST['qty']);
$harga = htmlspecialchars($_POST['harga']);
$jumlah = $qty * $harga;
$keterangan = htmlspecialchars($_POST['keterangan']);
$nama_file = $_FILES['file']['name'];

if ($nama_file == "") {
	$file = "";
}

else if ( $nama_file != "" ) {

	function upload(){
		$nama_file = $_FILES['file']['name'];
		$ukuran_file = $_FILES['file']['size'];
		$error = $_FILES['file']['error'];
		$tmp_name = $_FILES['file']['tmp_name'];

		$ekstensi_valid = ['jpg','jpeg','pdf','doc','docs','xls','xlsx','docx','txt','png'];
		$ekstensi_file = explode(".", $nama_file);
		$ekstensi_file = strtolower(end($ekstensi_file));


		$nama_file_baru = uniqid();
		$nama_file_baru .= ".";
		$nama_file_baru .= $ekstensi_file;

		move_uploaded_file($tmp_name, '../file_admin/' . $nama_file_baru   );

		return $nama_file_baru; 

	}

	$file = upload();
	if (!$file) {
		return false;
	}

}


  if ($file == '') {
    mysqli_query($koneksi,"UPDATE pengeluaran SET tanggal = '$tanggal' , akun = '$akun' , nama_item = '$nama_item' , qty = '$qty' , harga = '$harga' , jumlah = '$jumlah' , keterangan = '$keterangan' WHERE no_pengeluaran =  '$no_pengeluaran'");
  }
  else{
    mysqli_query($koneksi,"UPDATE pengeluaran SET tanggal = '$tanggal' , akun = '$akun' , nama_item = '$nama_item' , qty = '$qty' , harga = '$harga' , jumlah = '$jumlah' , keterangan = '$keterangan', file_bukti = '$file' WHERE no_pengeluaran =  '$no_pengeluaran'");
                  
  }
               
  echo "<script>alert('Data Pengeluaran Berhasil di Edit'); window.location='../view/VPengeluaran?tanggal1=$tanggal_awal&tanggal2=$tanggal_akhir';</script>";exit;


     
        

       


  ?>