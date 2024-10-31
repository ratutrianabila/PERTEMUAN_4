<?php
  try {
     $pdo = new PDO("mysql:host=localhost;dbname=Penjualan", "root", "");
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Koneksi ke database berhasil.";
     } catch (PDOException $e) {
     echo "Koneksi gagal: " . $e->getMessage();
     } 
    
    $mysqli = new mysqli("localhost", "root","","Penjualan");
    if($mysqli->connect_error){
        die("koneksi gagal:".$mysqli->connect_error);
    }else{

        //echo "koneksi ke database berhasil.";
    }
    ?>
    
    