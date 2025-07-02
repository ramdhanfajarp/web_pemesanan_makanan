<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda</title>
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
      background: linear-gradient(135deg, #2e7d32 0%, #4caf50 50%, #81c784 100%);
      min-height: 100vh;
      line-height: 1.6;
      padding-bottom: 80px;
    }
   .container {
      max-width: none;
      margin: 0 auto;
      background: linear-gradient(to bottom right,rgb(42, 168, 49),rgb(1, 63, 6)); /* warna gradasi hijau-putih */
      min-height: 100vh;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }

    .search-bar {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 30px;
      gap: 16px;
      background: white;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #f0f0f0;
      max-width: 800px; /* Limit search bar width */
      margin-left: auto;
      margin-right: auto;
    }
    .search-bar input {
      flex: 1;
      padding: 14px 24px;
      border-radius: 25px;
      border: 2px solid #e0e0e0;
      font-size: 16px;
      min-width: 300px;
      font-weight: 500;
      outline: none;
      transition: all 0.3s ease;
    }
    .search-bar input:focus {
      border-color: #2e7d32;
      box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }
    .search-bar button {
      padding: 14px 20px;
      border-radius: 12px;
      background: linear-gradient(135deg, #4caf50, #2e7d32);
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
      flex-shrink: 0;
      transition: all 0.3s ease;
    }
    .search-bar button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
    }
    .search-bar button img {
      width: 20px;
      height: 20px;
    }
    .pesanan-button {
      position: relative; /* Diperlukan untuk penempatan badge */
      padding: 14px 20px;
      border-radius: 12px;
      background: linear-gradient(135deg, #81c784, #388e3c);
      color: white;
      font-weight: bold;
      text-decoration: none;
      font-size: 14px;
      box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
      transition: all 0.3s ease;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .pesanan-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
    }
    .pesanan-button img {
        width: 24px;
        height: 24px;
    }
    .keranjang-badge {
      position: absolute;
      top: -6px;
      right: -6px;
      background-color: #ff5722;
      color: white;
      border-radius: 50%;
      padding: 2px 7px;
      font-size: 11px;
      font-weight: bold;
      border: 2px solid white;
      line-height: 1;
    }
    .banner {
      width: 100%;
      height: 450px; /* Increased height for desktop */
      max-height: 450px;
      overflow: hidden;
      position: relative;
      border-radius: 16px;
      margin: 30px 0;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    }
    .banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      transition: opacity 1.5s ease-in-out;
      border-radius: 16px;
    }
    .banner img.active {
      opacity: 1;
      z-index: 1;
    }
    .categories {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
      gap: 12px;
      margin-bottom: 30px;
      padding: 0 10px;
    }
    .category {
      background-color: white;
      border-radius: 16px;
      padding: 20px 16px;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      cursor: pointer;
      transition: all 0.3s ease;
      min-height: 120px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border: 1px solid #f0f0f0;
      position: relative;
      overflow: hidden;
    }
    .category::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #4caf50, #2e7d32);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }
    .category:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 30px rgba(46, 125, 50, 0.15);
    }
    .category:hover::before {
      transform: scaleX(1);
    }
    .category img {
      width: 48px;
      height: 48px;
      object-fit: contain;
    }
    .category-label {
      font-size: 14px;
      margin-top: 10px;
      word-break: break-word;
      font-weight: 600;
      color: #2e7d32;
    }
    
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }
    
    .menu-item {
      background-color: #ffffff;
      padding: 24px;
      border-radius: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 1px solid #f0f0f0;
      position: relative;
      overflow: hidden;
      min-height: 320px;
    }
    
    .menu-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #4caf50, #2e7d32);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }
    
    .menu-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 45px rgba(46, 125, 50, 0.2);
    }
    
    .menu-item:hover::before {
      transform: scaleX(1);
    }
    
    .menu-item img {
      width: 100%;
      height: 180px;
      border-radius: 16px;
      object-fit: cover;
      object-position: center;
      border: 3px solid #f0f0f0;
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }
    
    .menu-item:hover img {
      border-color: #4caf50;
      transform: scale(1.03);
    }
    
    .menu-details {
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: 100%;
      flex-grow: 1;
      justify-content: space-between;
    }
    
    .menu-details h4 {
      margin: 0;
      font-size: 20px;
      font-weight: 600;
      color: #2e7d32;
      line-height: 1.3;
    }
    
    /* GAYA BARU: Ditambahkan untuk konsistensi */
    .menu-item .description {
        font-size: 14px;
        color: #666;
        line-height: 1.4;
        margin: 0 0 10px 0;
    }
    
    .menu-details .price {
      margin: 0;
      font-size: 18px;
      color: #ff5722;
      font-weight: 700;
    }
    
    .menu-details .rating {
      margin: 0;
      font-size: 14px;
      color: #ff9800;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 4px;
    }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 70px;
      background: white;
      border-top: 1px solid #ccc;
      display: flex;
      justify-content: space-around;
      align-items: center;
      z-index: 100;
      box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.08);
    }

    .bottom-link {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #4caf50;
      text-decoration: none;
      font-size: 12px;
      transition: color 0.3s;
      padding: 8px;
    }

    .bottom-link img {
      width: 28px;
      height: 28px;
      margin-bottom: 4px;
    }

    .bottom-link.active,
    .bottom-link:hover {
      color: #2e7d32;
    }

    @media (min-width: 1200px) {
      .container { padding: 40px; }
      .banner { height: 500px; border-radius: 20px; }
      .menu-grid { grid-template-columns: repeat(3, 1fr); gap: 35px; }
      .menu-item { min-height: 350px; padding: 28px; }
      .menu-item img { height: 200px; }
      .menu-details h4 { font-size: 22px; color: black; }
      .menu-details .price { font-size: 19px; color: black; }
      .categories { gap: 24px; }
      .category { padding: 24px 20px; min-height: 140px; }
      .category img { width: 52px; height: 52px; }
      .category-label { font-size: 16px; margin-top: 12px; color: black; }
    }

    @media (min-width: 1600px) {
      .container { max-width: 1600px; padding: 50px; }
      .menu-grid { grid-template-columns: repeat(4, 1fr); gap: 40px; }
      .banner { height: 550px; }
    }

    @media (max-width: 1199px) and (min-width: 769px) {
      .container { padding: 25px; max-width: 1200px; }
      .categories { grid-template-columns: repeat(6, 1fr); gap: 18px; max-width: 900px; }
      .menu-grid { grid-template-columns: repeat(2, 1fr); gap: 25px; }
      .banner { height: 400px; }
      .menu-item { min-height: 300px; }
      .menu-item img { height: 160px; }
    }

    @media (max-width: 768px) {
      .container { padding: 15px; margin: 0; }
      .search-bar { width: 100%; }
      .search-bar input { min-width: unset; font-size: 15px; padding: 12px 18px; }
      .categories { grid-template-columns: repeat(3, 1fr); gap: 15px; max-width: 100%; margin-bottom: 25px; }
      .category { padding: 15px 12px; min-height: 100px; }
      .category img { width: 40px; height: 40px; }
      .category-label { font-size: 13px; margin-top: 8px; color: black; }
      .banner { height: 300px; margin: 20px 0; border-radius: 12px; }
      .menu-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px; }
      .menu-item { padding: 18px; min-height: 260px; }
      .menu-item img { height: 130px; }
      .menu-details h4 { font-size: 16px; color: black; }
      .menu-details .price { font-size: 15px; color: black; }
      .menu-details .rating { font-size: 13px; }
    }

    @media (max-width: 480px) {
      .container { padding: 12px; margin: 0; }
      .search-bar { margin-bottom: 15px; padding: 12px; gap: 10px; }
      .search-bar input { padding: 10px 16px; font-size: 14px; min-width: 150px; }
      .search-bar button { padding: 10px 14px; border-radius: 8px; }
      .search-bar button img { width: 18px; height: 18px; }
      .pesanan-button { padding: 10px 14px; font-size: 13px; }
      .pesanan-button img { width: 22px; height: 22px; }
      .categories { grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 20px; }
      .category { padding: 12px 10px; min-height: 85px; }      
      .category img { width: 32px; height: 32px; }
      .category-label { font-size: 12px; margin-top: 6px; }
      .banner { height: 250px; margin: 15px 0; }
      .menu-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 25px; }
      .menu-item { padding: 16px; min-height: 230px; }
      .menu-item img { height: 120px; }
      .menu-details h4 { font-size: 15px; color: black; }
      .menu-details .price { font-size: 14px; color: black; }
      .menu-details .rating { font-size: 12px; }
      .bottom-nav { height: 60px; }
      .bottom-link img { width: 24px; height: 24px; }
    }
    
    @media (max-width: 320px) {
      .container { padding: 10px; }
      .search-bar { padding: 10px; gap: 8px; }
      .search-bar input { padding: 8px 12px; font-size: 13px; min-width: 120px; }
      .search-bar button { padding: 8px 12px; }
      .search-bar button img { width: 16px; height: 16px; }
      /* CSS yang duplikat dan membingungkan telah dihapus dan disederhanakan di bawah */
      .pesanan-button {
        padding: 8px 12px;
        font-size: 12px;
      }
       .pesanan-button img {
        width: 20px;
        height: 20px;
      }
      .categories { gap: 10px; }
      .category { padding: 10px 8px; min-height: 75px; }
      .category img { width: 28px; height: 28px; }
      .category-label { font-size: 11px; }
      .banner { height: 200px; }
      .menu-item { padding: 14px; min-height: 210px; }
      .menu-item img { height: 110px; }
    }
  </style>
</head>
<body>
  
  <div class="container">
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Mau makan apa hari ini?" />
      <button><img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='21 21l-4.35-4.35'/%3E%3C/svg%3E" alt="Cari" /></button>
      <a href="pesanan.php" class="pesanan-button">
          <img src="../icon/keranjang.png" alt="Keranjang"/>
          <span class="keranjang-badge" id="keranjangBadge">0</span>
      </a>
    </div>

    <div class="banner">
      <img src="../img/food.jpeg" class="active" alt="Delicious Food Banner 1">
      <img src="../img/bener3.jpeg" alt="Restaurant Food Banner 2">
      <img src="../img/bener2.jpeg" alt="Fresh Food Banner 3">
    </div>

    <div class="categories">
      <div class="category" onclick="window.location.href='makanan.php'">
        <img src="../icon/makanan.JPG" alt="Makanan" />
        <div class="category-label">Makanan</div>
      </div>
      <div class="category" onclick="window.location.href='minuman.php'">
        <img src="../icon/drink.png" alt="Minuman" />
        <div class="category-label">Minuman</div>
      </div>
      <div class="category" onclick="window.location.href='snack.php'">
        <img src="../icon/snack.png" alt="Snack" />
        <div class="category-label">Snack</div>
      </div>
      <div class="category" onclick="window.location.href='terdekat.php'">
        <img src="../icon/map.png" alt="Terdekat" />
        <div class="category-label">Terdekat</div>
      </div>
      <div class="category" onclick="window.location.href='terlaris.php'">
        <img src="../icon/danger.png" alt="Terlaris" />
        <div class="category-label">Terlaris</div>
      </div>
      <div class="category" onclick="window.location.href='promo.php'">
        <img src="../icon/promo.JPG" alt="Promo" />
        <div class="category-label">Promo</div>
      </div>
    </div>

    <div class="menu-grid">
     <div class="menu-item" onclick="location.href='../detail/detail_menu.php?menu=Bakso Aci Kaligondang'">
        <img src="../gambar/bakso_aci.jpeg" alt="Bakso Aci Kaligondang" />
        <div class="menu-details">
          <h4>Bakso Aci Kaligondang</h4>
          <p class="description">Bakso dengan aci kenyal dan kuah gurih</p>
          <p class="price">Rp. 12.000</p>
          <p class="rating">⭐ 4.5 (120 review)</p>
        </div>
      </div>
      
      <div class="menu-item" onclick="location.href='../detail/detail_menu.php?menu=Mie Ayam Bakso'">
        <img src="../gambar/aymbkso.jpeg" alt="Mie Ayam Bakso" />
        <div class="menu-details">
          <h4>Mie Ayam Bakso</h4>
          <p class="description">Mie ayam dengan bakso dan pangsit goreng</p>
          <p class="price">Rp. 12.000</p>
          <p class="rating">⭐ 4.5 (98 review)</p>
        </div>
      </div>
      
      <div class="menu-item" onclick="location.href='../detail/detail_menu.php?menu=Bakso Lumut'">
        <img src="../gambar/bakso_lumut.jpeg" alt="Bakso Lumut" />
        <div class="menu-details">
          <h4>Bakso Lumut</h4>
          <p class="description">Bakso lumut dengan kuah segar dan kenyal</p>
          <p class="price">Rp. 12.000</p>
          <p class="rating">⭐ 4.5 (87 review)</p>
        </div>
      </div>

      <div class="menu-item" onclick="location.href='../detail/detail_menu.php?menu=Nasi Goreng Spesial'">
        <img src="../gambar/nasi_goreng.jpeg" alt="Nasi Goreng Spesial" />
        <div class="menu-details">
          <h4>Nasi Goreng Spesial</h4>
          <p class="description">Nasi goreng dengan telur, ayam, udang, dan sayuran segar.</p>
          <p class="price">Rp. 15.000</p>
          <p class="rating">⭐ 4.7 (156 review)</p>
        </div>
      </div>
      
      <div class="menu-item" onclick="location.href='../detail/detail_menu.php?menu=Sate Ayam Madura'">
        <img src="../gambar/sate_madura.jpeg" alt="Sate Madura" />
        <div class="menu-details">
          <h4>Sate Ayam Madura</h4>
          <p class="description">Sate ayam dengan bumbu kacang khas madura</p>
          <p class="price">Rp. 18.000</p>
          <p class="rating">⭐ 4.8 (203 review)</p>
        </div>
      </div>
      
       <div class="menu-item" onclick="location.href='../detail/detail_menu.php?menu=Gado-Gado Jakarta'">
        <img src="../gambar/gado_gado.jpg" alt="Gado-Gado" />
        <div class="menu-details">
          <h4>Gado-Gado Jakarta</h4>
          <p class="description">Sayuran segar dengan bumbu kacang dan kupuk</p>
          <p class="price">Rp. 13.000</p>
          <p class="rating">⭐ 4.6 (92 review)</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="bottom-nav">
    <a href="../menu/home.php" class="bottom-link active">
      <img src="../icon/home.png" alt="Home" />
      <span>Home</span>
    </a>
    <a href="../menu/profil.php" class="bottom-link">
      <img src="../icon/user.png" alt="Profil" />
      <span>Profil</span>
    </a>
  </div>

  <script>
    // Slideshow banner otomatis
    const banners = document.querySelectorAll(".banner img");
    let current = 0;
    setInterval(() => {
      banners.forEach(img => img.classList.remove("active"));
      current = (current + 1) % banners.length;
      banners[current].classList.add("active");
    }, 4000);

    // Pencarian dan redirect halaman
    document.querySelector('.search-bar button').addEventListener('click', () => {
      const query = document.getElementById('searchInput').value.trim().toLowerCase();

      if (!query) {
        alert("Masukkan kata kunci pencarian.");
        return;
      }

      const keywordPages = {
        "mie ayam": "../pencarian/mieayam.php",
        "mie ayam bakso": "../pencarian/mieayam.php",
        "bakso": "../pencarian/bakso.php",
        "bakso aci": "../pencarian/bakso.php",
        "seblak": "../pencarian/seblak.php",
        "nasi goreng": "nasigoreng.php",
        "sate": "sate.php",
        "gado-gado": "gadogado.php",
        "es teh": "minuman.php",
        "minuman": "minuman.php"
      };

      const page = keywordPages[query];
      if (page) {
        window.location.href = page;
      } else {
        alert("Menu tidak ditemukan: " + query);
      }
    });

    // Add Enter key support for search
    document.getElementById('searchInput').addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        document.querySelector('.search-bar button').click();
      }
    });
 
    // FUNGSI BARU: Untuk memperbarui badge keranjang saat halaman dimuat
    document.addEventListener("DOMContentLoaded", () => {
        const keranjangBadge = document.getElementById("keranjangBadge");
        if (keranjangBadge) {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            let totalItems = 0;
            // Menghitung total jumlah item, bukan hanya jumlah jenis item
            cart.forEach(item => {
                totalItems += item.jumlah;
            });
            keranjangBadge.textContent = totalItems;
        }
    });
  </script>
</body>
</html>
