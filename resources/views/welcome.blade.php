<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Janji Temu Poliklinik" />
    <meta name="author" content="" />
    <title>Sistem Janji Temu Poliklinik</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand {
            color: #ecf0f1;
        }

        .navbar-nav .nav-link {
            color: #ecf0f1;
        }

        .navbar-nav .nav-link:hover {
            color: #3498db;
        }

        /* Hero Section */
        .hero {
            background-image: url('/pict/poli.jpg');
            background-size: cover;
            color: white;
            padding: 120px 0;
            text-align: center;
            min-height: 400px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
            color: white; 
            text-shadow: 2px 2px 4px black;
            text-align: center;
        }

        .hero p {
            font-size: 18px;
            color: white; 
            text-shadow: 2px 2px 4px black;
            text-align: center;
        }

        /* Call to Action button */
        .cta-button {
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #2980b9;
        }

        /* Features Section */
        .feature-card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .feature-card i {
            font-size: 50px;
            color: #3498db;
            margin-bottom: 20px;
        }

        /* Testimonials Section */
        .testimonials {
            background-color: #fff;
            padding: 40px 0;
        }

        .testimonial-item {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            background-color: #fafafa;
        }

        .testimonial-item .quote-icon {
            font-size: 30px;
            color: #3498db;
            margin-bottom: 20px;
        }

        .testimonial-item .testimonial-content {
            font-size: 16px;
        }

        .testimonial-item .testimonial-author {
            font-weight: bold;
            margin-top: 10px;
        }

        /* Footer Section */
        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            text-align: center;
        }

        .footer .social-icons i {
            font-size: 24px;
            margin: 0 10px;
            color: #ecf0f1;
            transition: color 0.3s ease;
        }

        .footer .social-icons i:hover {
            color: #3498db;
        }

    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Poliklinik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container" style="">
            <h1>Selamat datang di Sistem Janji Temu Poliklinik</h1>
            <p>Memudahkan Pasien dan Dokter dalam membuat janji temu. Akses login untuk Admin, Dokter, dan Pasien.</p>
            <a href="#features" class="cta-button">Lihat Fitur</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="container py-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-person"></i>
                    <h4>Registrasi Pasien</h4>
                    <p>Daftar sebagai pasien untuk membuat janji temu dengan dokter kami secara online.</p>
                    <a href="{{route('register.pasien')}}" class="cta-button">Daftar Sekarang</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-person-check"></i>
                    <h4>Login Dokter</h4>
                    <p>Dokter dapat login untuk melihat jadwal pasien dan melayani konsultasi.</p>
                    <a href="{{route('login.dokter')}}" class="cta-button">Login Sebagai Dokter</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <i class="bi bi-shield-lock"></i>
                    <h4>Login Admin</h4>
                    <p>Admin dapat mengelola data pasien, dokter, dan jadwal temu.</p>
                    <a href="{{route('login.admin')}}" class="cta-button">Login Sebagai Admin</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Testimoni Pasien</h2>
                <p class="lead mb-0">Apa kata para pasien tentang kami?</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="testimonial-item">
                        <div class="quote-icon">“</div>
                        <p class="testimonial-content">Mudah dalam membuat janji temu dan dokter sangat ramah. Serta Pelayanan yang sangat baik dan cepat. </p>
                        <p class="testimonial-author">-Tira, Semarang</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item">
                        <div class="quote-icon">“</div>
                        <p class="testimonial-content">Saya merasa sangat puas dengan layanan yang diberikan.</p>
                        <p class="testimonial-author">-Ardita, Semarang</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section id = "contact" footer class="footer">
        <div class="container">
            <p>&copy; <script>document.write(new Date().getFullYear())</script> Poliklinik. All Rights Reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </sectionfooter>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
