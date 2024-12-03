<?php
$host = 'localhost'; // Sesuaikan dengan host Anda
$dbname = 'Sewa_Kendaraan'; // Nama database
$username = 'root'; // Username database
$password = ''; // Password database

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Koneksi gagal: " . $e->getMessage());
}