<?php
// Selalu mulai session di baris paling atas
session_start();

// [DIGABUNGKAN] Logika untuk logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = array();
    session_destroy();
    header("Location: ../login/login.php?status=logout_success");
    exit;
}

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_message'] = "Silakan login untuk mengakses halaman profil.";
    header("Location: ../login.php");
    exit;
}

// Sertakan file koneksi database
require_once '../db.php';

// Ambil ID pengguna dari session
$user_id = $_SESSION['user_id'];
$user_data = null;

// Ambil data pengguna dari database
$stmt = $conn->prepare("SELECT Nama, no_telphone, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user_data = $result->fetch_assoc();
} else {
    // Jika data tidak ditemukan, hancurkan session dan redirect
    session_destroy();
    header("Location: ../login/login.php?error=user_not_found");
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Profil Saya - <?php echo htmlspecialchars($user_data['Nama']); ?></title>
    <link rel="icon" href="favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* === CSS DIROMBAK TOTAL UNTUK TAMPILAN BARU === */
        :root {
            --primary-green: #2d8a5b;
            --secondary-green: #4caf50;
            --bg-gradient-start: #e8f5e9;
            --bg-gradient-end: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #828a93;
            --white: #ffffff;
            --border-color: #eef2f7;
            --danger-color: #e74c3c;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            margin: 0;
            padding: 20px;
            padding-bottom: 100px; /* Ruang untuk bottom nav */
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Kartu Profil Utama */
        .profile-card {
            background: var(--white);
            padding: 25px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.5s ease-out;
        }
        .profile-card .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--secondary-green);
        }
        .profile-card .user-info h2 {
            font-size: 22px;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0 0 5px;
        }
        .profile-card .user-info p {
            font-size: 15px;
            color: var(--text-light);
            margin: 0;
        }

        /* Grup Menu Aksi */
        .profile-options-group {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            animation: fadeIn 0.7s ease-out;
        }
        .profile-option {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 18px 25px;
            text-decoration: none;
            color: var(--text-dark);
            transition: background-color 0.3s ease;
        }
        .profile-option:not(:last-child) {
            border-bottom: 1px solid var(--border-color);
        }
        .profile-option:hover {
            background-color: #f7f9fc;
        }
        .profile-option .icon {
            font-size: 20px;
            color: var(--primary-green);
            width: 25px;
            text-align: center;
        }
        .profile-option .text {
            flex-grow: 1;
        }
        .profile-option .text h3 {
            font-size: 16px;
            font-weight: 500;
            margin: 0;
        }
        .profile-option .text p {
            font-size: 14px;
            color: var(--text-light);
            margin: 0;
        }
        .profile-option .chevron {
            font-size: 16px;
            color: var(--text-light);
        }

        /* Tombol Logout */
        .logout-button {
            display: block;
            width: 100%;
            background: var(--white);
            border: 2px solid #ffe0e0;
            color: var(--danger-color);
            padding: 15px;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 25px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            animation: fadeIn 0.9s ease-out;
        }
        .logout-button:hover {
            background: var(--danger-color);
            color: var(--white);
            border-color: var(--danger-color);
        }

        /* Bottom Nav */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--white);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 70px;
            z-index: 100;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
        }
        .bottom-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
        }
        .bottom-link i {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .bottom-link.active {
            color: var(--primary-green);
        }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

<div class="container">
    <?php if ($user_data): ?>
    
    <div class="profile-card">
        <img src="../icon/user.png" alt="Foto Profil" class="avatar" />
        <div class="user-info">
            <h2><?= htmlspecialchars($user_data['Nama']); ?></h2>
            <p><?= htmlspecialchars($user_data['email']); ?></p>
        </div>
    </div>

    <div class="profile-options-group">
        <a href="#" class="profile-option" onclick="alert('Fitur segera hadir!');">
            <span class="icon"><i class="fas fa-user-edit"></i></span>
            <span class="text"><h3>Edit Profil</h3></span>
            <span class="chevron"><i class="fas fa-chevron-right"></i></span>
        </a>
        <a href="#" class="profile-option">
            <span class="icon"><i class="fas fa-phone-alt"></i></span>
            <span class="text">
                <h3>Nomor Telepon</h3>
                <p><?= htmlspecialchars($user_data['no_telphone']); ?></p>
            </span>
        </a>
        <a href="#" class="profile-option" onclick="alert('Fitur segera hadir!');">
            <span class="icon"><i class="fas fa-receipt"></i></span>
            <span class="text"><h3>Riwayat Pesanan</h3></span>
            <span class="chevron"><i class="fas fa-chevron-right"></i></span>
        </a>
        <a href="#" class="profile-option" onclick="alert('Fitur segera hadir!');">
            <span class="icon"><i class="fas fa-shield-halved"></i></span>
            <span class="text"><h3>Keamanan Akun</h3></span>
            <span class="chevron"><i class="fas fa-chevron-right"></i></span>
        </a>
    </div>

    <a href="profil.php?action=logout" class="logout-button">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>

    <?php else: ?>
        <p>Gagal memuat data profil. Silakan coba login kembali.</p>
    <?php endif; ?>
</div>

<div class="bottom-nav">
    <a href="../menu/home.php" class="bottom-link">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="profil.php" class="bottom-link active">
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</div>

</body>
</html>
