<?php
// Pastikan file koneksi database Anda ada di folder yang benar
// Jika file db.php ada di folder yang sama, gunakan: require_once 'db.php';
require_once '../db.php';

// Query untuk mengambil semua data dari tabel promo_menu
$sql = "SELECT id, nama, deskripsi, harga_awal, harga_promo, gambar, diskon, rating, sisa_waktu FROM promo_menu";
$result = $conn->query($sql);

// Fungsi untuk memformat angka menjadi format Rupiah
function format_rupiah($number) {
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

// Fungsi untuk menghitung penghematan dalam format 'rb' (ribu)
function calculate_savings($original, $promo) {
    $savings = $original - $promo;
    if ($savings >= 1000) {
        return round($savings / 1000) . 'rb';
    }
    return $savings;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Menu Promo</title>
    <link rel="icon" href="favicon.png" />
    <link rel="apple-touch-icon" href="icon192.png" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2e7d32 0%, #4caf50 50%, #66bb6a 100%);
            min-height: 100vh;
            line-height: 1.6;
            padding-bottom: 80px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 16px 0;
            border-bottom: 2px solid #f0f0f0;
        }
        .back-button {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.4);
        }
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color:rgb(2, 7, 2);
            text-align: center;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .promo-icon {
            color: #2e7d32;
            font-size: 32px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        .promo-banner {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            color: white;
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.3);
            position: relative;
            overflow: hidden;
        }
        .promo-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255, 255, 255, 0.1) 10px,
                rgba(255, 255, 255, 0.1) 20px
            );
            animation: slide 20s linear infinite;
        }
        @keyframes slide {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        .promo-banner h2 {
            font-size: 26px;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }
        .promo-banner p {
            font-size: 16px;
            opacity: 0.95;
            position: relative;
            z-index: 2;
        }
        .promo-timer {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            position: relative;
            z-index: 2;
        }
        .timer-text {
            font-size: 14px;
            margin-bottom: 8px;
            opacity: 0.9;
        }
        .countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            font-weight: 700;
        }
        .time-unit {
            text-align: center;
        }
        .time-number {
            font-size: 20px;
            display: block;
        }
        .time-label {
            font-size: 12px;
            opacity: 0.8;
        }
        .sort-filters {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
            padding: 10px 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        .sort-filter {
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-size: 14px;
        }
        .sort-filter.active {
            background: linear-gradient(135deg, #2e7d32, #4caf50);
            color: white;
            border-color: #2e7d32;
        }
        .sort-filter:hover:not(.active) {
            border-color: #2e7d32;
            color: #1b5e20;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }
        .menu-item {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }
        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #e53935, #c62828);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(229, 57, 53, 0.4);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2e7d32, #4caf50);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }
        .menu-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(46, 125, 50, 0.2);
        }
        .menu-item:hover::before {
            transform: scaleX(1);
        }
        .menu-item img {
            width: 100%;
            height: 180px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #f0f0f0;
            transition: all 0.3s ease;
            margin-bottom: 16px;
        }
        .menu-item:hover img {
            border-color: #2e7d32;
            transform: scale(1.05);
        }
        .menu-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            flex-grow: 1;
            justify-content: space-between;
        }
        .menu-details h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #2e2e2e;
            line-height: 1.3;
        }
        .menu-details .description {
            font-size: 14px;
            color: #666;
            margin: 4px 0;
            line-height: 1.4;
            flex-grow: 1;
            /* Membatasi deskripsi menjadi 2 baris */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .price-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 8px 0;
        }
        .original-price {
            font-size: 14px;
            color: #999;
            text-decoration: line-through;
            font-weight: 500;
        }
        .promo-price {
            font-size: 18px;
            color: #e53935;
            font-weight: 700;
        }
        .savings {
            font-size: 12px;
            color: #4caf50;
            font-weight: 600;
            background: rgba(76, 175, 80, 0.1);
            padding: 2px 8px;
            border-radius: 10px;
        }
        .stats-row {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 8px 0;
            gap: 12px;
            flex-wrap: wrap;
        }
        .menu-details .rating {
            font-size: 14px;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .promo-time {
            font-size: 12px;
            color: #e53935;
            font-weight: 600;
            background: rgba(229, 57, 53, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }
        .add-to-cart {
            margin-top: 12px;
            padding: 12px 20px;
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 16px;
        }
        .add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.4);
        }
        .no-promo {
            grid-column: 1 / -1; /* Agar pesan memenuhi lebar grid */
            text-align: center;
            padding: 50px 20px;
            background-color: #fffde7;
            border: 1px solid #fff9c4;
            border-radius: 12px;
        }
        .no-promo h2 {
            color: #f57f17;
        }

        @media (max-width: 768px) {
            .container { padding: 12px; margin: 0; }
            .header { flex-direction: row; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; }
            .page-title { order: 0; width: 100%; text-align: center; font-size: 24px; margin-bottom: 0; }
            .promo-banner h2 { font-size: 22px; }
            .promo-banner p { font-size: 14px; }
            .countdown { gap: 10px; }
            .time-number { font-size: 18px; }
            .sort-filters { gap: 8px; }
            .sort-filter { padding: 8px 16px; font-size: 13px; }
            .menu-grid { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; }
            .menu-item { padding: 16px; }
            .menu-item img { height: 150px; }
        }

        @media (max-width: 480px) {
            .container { padding: 10px; }
            .page-title { font-size: 20px; }
            .menu-grid { grid-template-columns: 1fr; gap: 16px; }
            .menu-item img { height: 160px; }
            .menu-details h4 { font-size: 18px; }
            .price-row { flex-direction: column; gap: 4px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="home.php" class="back-button">
                ← Kembali
            </a>
            <h1 class="page-title">
                <span class="promo-icon">🌿</span>
                Menu Promo
                <span class="promo-icon">🌿</span>
            </h1>
        </div>

        <div class="promo-banner">
            <h2>🎊 MEGA SALE BULAN INI! 🎊</h2>
            <p>Diskon hingga 50% untuk menu pilihan terbaik! Buruan sebelum kehabisan!</p>
            <div class="promo-timer">
            
                <div class="countdown" id="countdown">
                    </div>
            </div>
        </div>

        <div class="sort-filters">
            <div id="sort-diskon" class="sort-filter active" onclick="sortMenu('diskon', this)">Diskon Terbesar</div>
            <div id="sort-rating" class="sort-filter" onclick="sortMenu('rating', this)">Rating Tertinggi</div>
            <div id="sort-harga-rendah" class="sort-filter" onclick="sortMenu('harga-rendah', this)">Harga Terendah</div>
            <div id="sort-waktu" class="sort-filter" onclick="sortMenu('waktu', this)">Berakhir Segera</div>
        </div>

        <div class="menu-grid" id="menuGrid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <?php
                        // Membersihkan path gambar dari './' yang mungkin ada
                        $gambar_bersih = str_replace('./', '', $row['gambar']);
                    ?>
                    <div class="menu-item"
                         data-discount="<?php echo $row['diskon']; ?>" 
                         data-rating="<?php echo $row['rating']; ?>" 
                         data-price="<?php echo $row['harga_promo']; ?>" 
                         data-time="<?php echo $row['sisa_waktu']; ?>" 
                         onclick="goToDetail(<?php echo $row['id']; ?>)">
                        
                        <div class="discount-badge"><?php echo htmlspecialchars($row['diskon']); ?>% OFF</div>
                        
                        <img src="../<?php echo htmlspecialchars($gambar_bersih); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>" />
                        <div class="menu-details">
                            <h4><?php echo htmlspecialchars($row['nama']); ?></h4>
                            <p class="description"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                            <div>
                                <div class="price-row">
                                    <span class="original-price"><?php echo format_rupiah($row['harga_awal']); ?></span>
                                    <span class="promo-price"><?php echo format_rupiah($row['harga_promo']); ?></span>
                                    <span class="savings">Hemat <?php echo calculate_savings($row['harga_awal'], $row['harga_promo']); ?>!</span>
                                </div>
                                <div class="stats-row">
                                    <p class="rating">⭐ <?php echo htmlspecialchars($row['rating']); ?></p>
                                    <p class="promo-time">⏰ <?php echo htmlspecialchars($row['sisa_waktu']); ?> hari lagi</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-promo">
                    <h2>Yah, Belum Ada Promo</h2>
                    <p>Mohon maaf, saat ini belum ada menu promo yang tersedia. Silakan cek kembali nanti!</p>
                </div>
            <?php endif; ?>
            <?php $conn->close(); // Selalu tutup koneksi setelah query selesai ?>
        </div>
    </div>

    <script>
    // --- ALGORITMA JAVASCRIPT TIDAK DIUBAH KECUALI PADA FUNGSI COUNTDOWN ---
    function startCountdown() {
        // [DIUBAH] Secara eksplisit mengatur tanggal akhir promo menjadi 15 hari dari sekarang
        const countDownDate = new Date();
        countDownDate.setDate(countDownDate.getDate() + 15);

        const countdownContainer = document.getElementById("countdown");
        if (!countdownContainer) return;

        countdownContainer.innerHTML = `
            <div class="time-unit"><span class="time-number" id="days">0</span><span class="time-label">Hari</span></div>
            <div class="time-unit"><span class="time-number" id="hours">0</span><span class="time-label">Jam</span></div>
            <div class="time-unit"><span class="time-number" id="minutes">0</span><span class="time-label">Menit</span></div>
            <div class="time-unit"><span class="time-number" id="seconds">0</span><span class="time-label">Detik</span></div>
        `;

        const countdownFunction = setInterval(() => {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            if (distance < 0) {
                clearInterval(countdownFunction);
                countdownContainer.innerHTML = "PROMO TELAH BERAKHIR";
                return;
            }

            document.getElementById("days").innerText = Math.floor(distance / (1000 * 60 * 60 * 24));
            document.getElementById("hours").innerText = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            document.getElementById("minutes").innerText = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById("seconds").innerText = Math.floor((distance % (1000 * 60)) / 1000);
        }, 1000);
    }

    function sortMenu(type, element) {
      const menuGrid = document.getElementById('menuGrid');
      const menuItems = document.querySelectorAll('.menu-item');
      if (menuItems.length === 0) return; // Keluar jika tidak ada item untuk di-sort

      const filterTabs = document.querySelectorAll('.sort-filter');
      
      filterTabs.forEach(tab => tab.classList.remove('active'));
      element.classList.add('active');
      
      const itemsArray = Array.from(menuItems);
      
      itemsArray.sort((a, b) => {
        const aDiscount = parseFloat(a.dataset.discount);
        const bDiscount = parseFloat(b.dataset.discount);
        const aRating = parseFloat(a.dataset.rating);
        const bRating = parseFloat(b.dataset.rating);
        const aPrice = parseFloat(a.dataset.price);
        const bPrice = parseFloat(b.dataset.price);
        const aTime = parseFloat(a.dataset.time);
        const bTime = parseFloat(b.dataset.time);

        switch(type) {
          case 'diskon': return bDiscount - aDiscount;
          case 'rating': return bRating - aRating;
          case 'harga-rendah': return aPrice - bPrice;
          case 'waktu': return aTime - bTime;
          default: return 0;
        }
      });
      
      menuGrid.innerHTML = '';
      itemsArray.forEach(item => menuGrid.appendChild(item));
    }

    function goToDetail(menuId) {
      // Mengarahkan ke detail_promo.php dengan ID, bukan nama
      window.location.href = `../detail/detail_promo.php?id=${menuId}`;
    }

    function addToCart(nama, harga) {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      const existingItem = cart.find(item => item.nama === nama);
      
      if (existingItem) {
        existingItem.jumlah += 1;
        existingItem.total = existingItem.jumlah * harga;
      } else {
        cart.push({ nama: nama, harga: harga, jumlah: 1, total: harga });
      }
      
      localStorage.setItem('cart', JSON.stringify(cart));
      alert(`"${nama}" berhasil ditambahkan ke keranjang!`);
    }

    document.addEventListener('DOMContentLoaded', () => {
      startCountdown();
      // Lakukan sort pertama kali setelah halaman dimuat
      sortMenu('diskon', document.getElementById('sort-diskon'));
    });
    </script>
</body>
</html>