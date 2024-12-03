<?php
session_start();
require './fungsi/db.php';

// Periksa apakah pengguna sudah login dan memiliki role 'user'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php"); // Redirect ke halaman login jika bukan user
    exit();
}

// Ambil data kendaraan milik pengguna
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM kendaraan WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$kendaraanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil nama lengkap pengguna
$query = "SELECT nama_lengkap FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$nama_lengkap = $result['nama_lengkap'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-links {
            list-style-type: none;
            padding: 0;
        }

        .nav-links li {
            margin: 15px 0;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #495057;
        }

        .logout {
            color: #dc3545 !important;
        }

        .main-header {
            margin-bottom: 20px;
        }

        .table-section {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 sidebar">
                <h2>User Dashboard</h2>
                <ul class="nav-links">
                    <li><a href="#dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="#mobil"><i class="fas fa-car"></i> Kendaraan Saya</a></li>
                    <li><a href="#transactions"><i class="fas fa-wallet"></i> Transaksi</a></li>
                    <li><a href="#profile"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a href="#settings"><i class="fas fa-cogs"></i> Pengaturan</a></li>
                    <li><a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9">
                <!-- Header -->
                <header class="main-header">
                    <h1>Selamat Datang, <?= htmlspecialchars($nama_lengkap); ?></h1>
                </header>

                <!-- Kendaraan Saya -->
                <section id="mobil" class="content-section">
                    <h2>Kendaraan Saya</h2>
                    <?php if (count($kendaraanList) > 0): ?>
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Kendaraan</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Plat Nomor</th>
                                    <th>Tanggal Registrasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kendaraanList as $kendaraan): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($kendaraan['id_kendaraan']); ?></td>
                                        <td><?= htmlspecialchars($kendaraan['nama_kendaraan']); ?></td>
                                        <td><?= htmlspecialchars($kendaraan['plat_nomor']); ?></td>
                                        <td><?= htmlspecialchars($kendaraan['tanggal_registrasi']); ?></td>
                                        <td>
                                            <span class="badge bg-success">
                                                <?= htmlspecialchars($kendaraan['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Anda belum memiliki kendaraan yang terdaftar.</p>
                    <?php endif; ?>
                </section>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
