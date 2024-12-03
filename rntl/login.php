<?php
session_start(); // Jangan lupa untuk memulai session

require './fungsi/db.php';

$error = ""; // Inisialisasi variabel error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Periksa apakah input sudah diisi
  if (!empty($_POST['username_or_email']) && !empty($_POST['password'])) {
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Cek apakah pengguna ada di database berdasarkan username atau email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      // Jika password benar, simpan informasi pengguna dalam sesi
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['role'] = $user['role'];

      // Alihkan pengguna sesuai dengan role mereka
      if ($user['role'] === 'admin') {
        header("Location: admin/admin_dashboard.php");
        exit();
      } elseif ($user['role'] === 'user') {
        header("Location: user/userd_dashboard.php");
        exit();
      }
    } else {
      $error = "Username, email, atau password salah.";
    }
  } else {
    $error = "Harap isi semua kolom.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* CSS untuk layout form login */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 300px;
            text-align: center;
        }

        h1 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        p {
            margin: 0 0 20px;
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .input-group input {
            width: 100%;
            background-color: #cecece;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .input-group input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .btn {
            background: #ffcb47;
            border: none;
            padding: 10px 20px;
            color: #000000;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #2575FC;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 12px;
        }

        .footer-text a {
            color: #000; /* Mengubah warna tulisan menjadi hitam */
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Welcome Back</h1>
        <p>Please login to your account</p>
        
        <!-- Menampilkan pesan error jika ada -->
        <?php if ($error != ""): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form action="user/userd_dashboard.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" >Login</button>
        </form>

        <!-- Tombol Register -->
        <p class="footer-text">Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
</body>
</html>
