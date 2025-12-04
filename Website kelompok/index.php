<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            margin: 0;
            color: white;
        }
        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .hero {
            text-align: center;
            padding: 90px 20px 60px;
        }
        .hero h1 {
            font-size: 4.8rem;
            font-weight: 900;
            animation: bounceInDown 1.5s;
            text-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }
        .hero p {
            font-size: 1.6rem;
            animation: fadeInUp 1.5s 0.6s both;
        }

        /* CARD DENGAN FOTO BULAT */
        .member-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.5s ease;
            border: 1px solid rgba(255,255,255,0.2);
            height: 100%;
        }
        .member-card:hover {
            transform: translateY(-25px) scale(1.07);
            box-shadow: 0 40px 80px rgba(0,0,0,0.5);
        }

        .foto-bulat {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid white;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            transition: all 0.5s ease;
            margin-bottom: 20px;
        }
        .member-card:hover .foto-bulat {
            transform: scale(1.15);
            border-color: #ffeb3b;
        }

        .nama {
            font-size: 2rem;
            font-weight: 700;
            margin: 15px 0 8px;
        }
        .jabatan {
            background: #ffeb3b;
            color: #333;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1rem;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="hero">
        <h1 class="animate__animated animate__bounceInDown">EDELWEIS</h1>
        <p class="animate__animated animate__fadeInUp">We don't do average. We do legendary</p>
    </div>

    <div class="container pb-5">
        <div class="row g-5 justify-content-center">

            <!-- Marcelino -->
            <div class="col-md-6 col-lg-3">
                <a href="/assets/Profile/marcel2.php" class="text-decoration-none text-white">
                    <div class="member-card animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
                        <img src="/assets/gambar/icel.jpg" alt="Marcelino" class="foto-bulat">
                        <div class="nama">Marcelino</div>
                        <div class="jabatan">Anggota 1</div>
                    </div>
                </a>
            </div>

            <!-- Anggota 2 -->
            <div class="col-md-6 col-lg-3">
                <a href="/assets/Profile/zahra.php" class="text-decoration-none text-white">
                    <div class="member-card animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
                        <img src="/assets/gambar/zhra.jpeg" alt="Zahra" class="foto-bulat">
                        <div class="nama">Zahraa</div>
                        <div class="jabatan">Anggota 2</div>
                    </div>
                </a>
            </div>

            <!-- Anggota 3 -->
            <div class="col-md-6 col-lg-3">
                <a href="/assets/Profile/aldi.php" class="text-decoration-none text-white">
                    <div class="member-card animate__animated animate__zoomIn" style="animation-delay: 0.6s;">
                        <img src="/assets/gambar/aldi.jpg" alt="Aldi" class="foto-bulat">
                        <div class="nama">Aldi</div>
                        <div class="jabatan">Anggota 3</div>
                    </div>
                </a>
            </div>

            <!-- Anggota 4 -->
            <div class="col-md-6 col-lg-3">
                <a href="/assets/Profile/karina.php" class="text-decoration-none text-white">
                    <div class="member-card animate__animated animate__zoomIn" style="animation-delay: 0.8s;">
                        <img src="/assets/gambar/karin1.jpg" alt="Karina" class="foto-bulat">
                        <div class="nama">Karina</div>
                        <div class="jabatan">Anggota 4</div>
                    </div>
                </a>
            </div>

        </div>
    </div>

</body>
</html>