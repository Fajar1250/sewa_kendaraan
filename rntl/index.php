<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Kendaraan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Reset */
        body, html {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            padding: 1rem 0;
        }
        .nav-link {
            font-size: 1rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #007bff;
        }

        /* Hero Section */
        .hero-section {
            background: url('img/3.jpg') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;
            text-align: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .hero-section .btn {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            background-color: #007bff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .hero-section .btn:hover {
            background-color: #0056b3;
        }

        /* About Section */
        #about {
            padding: 3rem 0;
        }

        #about h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        #about p {
            font-size: 1.25rem;
            color: #555;
        }

        #about img {
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Services Section */
        #services {
            background-color: #f8f9fa;
            padding: 3rem 0;
        }

        #services h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #333;
        }

        #services .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #services .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        #services .card img {
            border-bottom: 3px solid #007bff;
        }

        #services .card-title {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
            color: #333;
        }

        #services .card-text {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: #555;
        }

        #services .btn {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            background-color: #007bff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #services .btn:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            #services h2 {
                font-size: 2rem;
            }

            #services .card-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">SewaKendaraan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

   <!-- Hero Section -->
   <header class="hero-section text-white text-center py-5">
       <div class="container">
           <h1 class="display-4">Sewa Mobil Impian Anda</h1>
           <p class="lead">Jelajahi kenyamanan berkendara dengan mobil terbaik kami</p>
           <a href="#services" class="btn btn-primary btn-lg">Lihat Mobil</a>
       </div>
   </header>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Tentang Kami</h2>
                    <p>Kami menyediakan layanan sewa kendaraan terbaik dengan berbagai pilihan mobil dan motor yang sesuai dengan kebutuhan Anda.</p>
                </div>
                <div class="col-lg-6">
                    <img src="img/4.jpg" class="img-fluid" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Pilihan Mobil Kami</h2>
            <div class="row text-center">
                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Mobil SUV">
                        <div class="card-body">
                            <h5 class="card-title">SUV Nyaman</h5>
                            <p class="card-text">SUV berkapasitas besar, cocok untuk keluarga atau perjalanan jauh.</p>
                            <a href="login.php" class="btn btn-primary">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Mobil Sedan">
                        <div class="card-body">
                            <h5 class="card-title">Sedan Elegan</h5>
                            <p class="card-text">Sedan mewah dengan desain elegan untuk perjalanan bisnis atau pribadi.</p>
                            <a href="login.php" class="btn btn-primary">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Mobil Hatchback">
                        <div class="card-body">
                            <h5 class="card-title">Hatchback Irit</h5>
                            <p class="card-text">Mobil kecil dan irit bahan bakar untuk kebutuhan sehari-hari.</p>
                            <a href="login.php" class="btn btn-primary">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Mobil Sport">
                        <div class="card-body">
                            <h5 class="card-title">Sport Premium</h5>
                            <p class="card-text">Mobil sport dengan performa tinggi untuk pengalaman berkendara terbaik.</p>
                            <a href="login.php" class="btn btn-primary">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Mobil MPV">
                        <div class="card-body">
                            <h5 class="card-title">MPV Keluarga</h5>
                            <p class="card-text">Mobil multi-guna dengan kapasitas luas untuk keluarga besar.</p>
                            <a href="login.php" class="btn btn-primary">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 SewaKendaraan. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
