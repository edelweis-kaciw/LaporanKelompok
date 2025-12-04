<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Kelompok</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            padding: 30px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            margin-bottom: 20px;
            animation: bounceIn 1s;
        }
        .bio-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            animation: fadeInDown 1s;
        }
        .bio-info {
            font-size: 1.2rem;
            margin-bottom: 10px;
            animation: fadeInUp 1s;
            animation-delay: 0.5s;
        }
        .social-links a {
            color: #fff;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .social-links a:hover {
            color: #ffeb3b;
        }
        /* Custom Animations */
        @keyframes bounceIn {
            0% { transform: scale(0); }
            60% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <?php
    // Data biodata dalam array PHP
    $biodata = [
        'nama' => 'S.Zahroo',
        'umur' => 17,
        'hobi' => 'Jajan Seblak',
        'alamat' => 'Kp Legog heas',
        'email' => 'zhratstaa@Gmail.com',
        'sosmed' => [
            'instagram' => 'https://www.instagram.com/zhrtusta_?igsh=bmN2MHp3NXJ3Z3Bx',
            'github' => 'gapunya'
        ],
        'foto' => '../gambar/zhra.jpeg' // Ganti dengan path foto asli
    ];
    ?>

    <div class="card animate__animated animate__fadeIn">
        <img src="<?php echo $biodata['foto']; ?>" alt="Profile Picture" class="profile-img">
        <h1 class="bio-title">Yo, Saya <?php echo $biodata['nama']; ?>!</h1>
        <p class="bio-info"><strong>Umur:</strong> <?php echo $biodata['umur']; ?> tahun, masih fresh!</p>
        <p class="bio-info"><strong>Hobi:</strong> <?php echo $biodata['hobi']; ?></p>
        <p class="bio-info"><strong>Alamat:</strong> <?php echo $biodata['alamat']; ?></p>
        <p class="bio-info"><strong>Email:</strong> <a href="mailto:<?php echo $biodata['email']; ?>" style="color: #ffeb3b;"><?php echo $biodata['email']; ?></a></p>
        <div class="social-links">
            <strong>Stalk saya di:</strong><br>
            <a href="<?php echo $biodata['sosmed']['instagram']; ?>" target="_blank"><i class="bi bi-instagram"></i> Instagram</a>
            <a href="<?php echo $biodata['sosmed']['github']; ?>" target="_blank"><i class="bi bi-github"></i> GitHub</a>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>