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

$nama_ruangan = htmlspecialchars($_POST['nama_ruangan']);


    $no_kode = 1;
    

        $kode = 'RUA';

        $sql_data = mysqli_query($koneksi, "SELECT * FROM ruangan  ");
        
        if(mysqli_num_rows($sql_data) == 0 ){
            $kode_new = $kode.$no_kode;
            $query = mysqli_query($koneksi,"INSERT INTO ruangan VALUES('$kode_new','$nama_ruangan')");
               
                       echo "<script>alert('Data Ruangan Berhasil di input'); window.location='../view/VRuangan';</script>";exit;
        }

        while(mysqli_fetch_array($sql_data)){
            $no_kode = $no_kode + 1;
            $kode_new = $kode.$no_kode;

            $sql_cek = mysqli_query($koneksi, "SELECT * FROM ruangan WHERE kode_ruangan = '$kode_new' ");
            if(mysqli_num_rows($sql_cek) === 0 ){

                $query = mysqli_query($koneksi,"INSERT INTO ruangan VALUES('$kode_new','$nama_ruangan')");
               
                        echo "<script>alert('Data Ruangan Berhasil di input'); window.location='../view/VRuangan';</script>";exit;
        
            }
            

        }


     
        

       


  ?>