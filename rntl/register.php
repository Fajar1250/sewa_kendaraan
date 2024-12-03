<?php
require './fungsi/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama_lengkap = $_POST['nama_lengkap'];
  $nomor_hp = $_POST['nomor_hp'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];
  $maxFileSize = 50 * 1024 * 1024; // 50MB in bytes

  // Cek duplikasi username, email, atau nomor_hp
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ? OR nomor_hp = ?");
  $stmt->execute([$username, $email, $nomor_hp]);
  $existing_user = $stmt->fetch();

  if ($existing_user) {
    if ($existing_user['username'] === $username) {
      $error = "Username sudah terdaftar. Silakan gunakan username lain.";
    } elseif ($existing_user['email'] === $email) {
      $error = "Email sudah terdaftar. Silakan gunakan email lain.";
    } elseif ($existing_user['nomor_hp'] === $nomor_hp) {
      $error = "Nomor HP sudah terdaftar. Silakan gunakan nomor HP lain.";
    }
  } else {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
      // Periksa ukuran file
      if ($_FILES['foto']['size'] > $maxFileSize) {
        $error = "Ukuran file terlalu besar. Maksimal ukuran file adalah 50MB.";
      } else {
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_extension = pathinfo($foto_name, PATHINFO_EXTENSION);
        $foto_new_name = uniqid() . '.' . $foto_extension;
        $foto_path = 'uploads/' . $foto_new_name;

        if (move_uploaded_file($foto_tmp, $foto_path)) {
          $foto = $foto_new_name;
        } else {
          $foto = null;
          echo "Gagal mengunggah foto.";
        }
      }
    } else {
      $foto = null;
    }

    if (!isset($error)) {
      $stmt = $pdo->prepare("INSERT INTO users (nama_lengkap, nomor_hp, username, email, password, role, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
      if ($stmt->execute([$nama_lengkap, $nomor_hp, $username, $email, $password, $role, $foto])) {
        $success = "Pendaftaran berhasil! Silakan <a href='login.php' class='btn btn-warning'>LOGIN</a>.";
      } else {
        $error = "Terjadi kesalahan saat mendaftar.";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Styling CSS, sesuaikan dengan yang ada pada login form */
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
            color: #000000;
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
        <h1>Daftar Akun</h1>
        <p>Isi form di bawah ini untuk mendaftar</p>

        <!-- Menampilkan pesan error jika ada -->
       <!-- Alert Scripts -->
  <?php if (isset($success) && $success): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Registrasi Berhasil',
        text: 'Pendaftaran berhasil! Silakan login.',
        confirmButtonText: '<a href="login.php" style="color: white; text-decoration: none;">Login</a>'
      });
    </script>
  <?php elseif (isset($error)): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Registrasi Gagal',
        text: '<?php echo $error; ?>'
      });
    </script>
  <?php endif; ?>

        <form action="register.php" method="POST">
        <div class="input-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="input-group">
                <label for="no_hp">No Hp</label>
                <input type="text" id="nomor_hp" name="nomor_hp" required>
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="role">Role</label>
                <input type="role" id="password" name="role" required>
            </div>

            <button type="submit" class="btn">Daftar</button>
        </form>

        <p class="footer-text">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
