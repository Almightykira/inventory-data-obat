<?php
session_start();
//Koneksi DB 
$conn = mysqli_connect("localhost","root","","data_obat");

//tambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST["stok"];

    $addtotable = mysqli_query($conn,"insert into stok (namabarang, deskripsi, stok) values('$namabarang', '$deskripsi', '$stok')");
    if($addtotable){
        header('location:index.php');
    }else {
        echo 'gagal';
        header('location:index.php');
    }
}

//tambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barang = $_POST['barang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoknow = mysqli_query($conn,"select * from stok where idbarang='$barang'");
    $ambildata = mysqli_fetch_array($cekstoknow);

    $stoknow = $ambildata['stok'];
    $tambahstoknowdenganqty = $stoknow+$qty;

    $addtomasuk = mysqli_query($conn,"insert into barang_masuk (idbarang, keterangan, qty) values('$barang', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahstoknowdenganqty' where idbarang='$barang'");
    if($addtomasuk&&$updatestokmasuk){
        header('location:index.php');
    }else {
        echo 'gagal';
        header('location:index.php');
    }
}

//tambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barang = $_POST['barang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoknow = mysqli_query($conn,"select * from stok where idbarang='$barang'");
    $ambildata = mysqli_fetch_array($cekstoknow);

    $stoknow = $ambildata['stok'];
    $tambahstoknowdenganqty = $stoknow-$qty;

    $addtokeluar = mysqli_query($conn,"insert into barang_keluar (idbarang, penerima, qty) values('$barang', '$penerima', '$qty')");
    $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahstoknowdenganqty' where idbarang='$barang'");
    if($addtokeluar&&$updatestokmasuk){
        header('location:barangkeluar.php');
    }else {
        echo 'gagal';
        header('location:barangkeluar.php');
    }
}

?>