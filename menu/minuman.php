<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Menu Minuman</title>
  <link rel="icon" href="favicon.png" />
  <link rel="apple-touch-icon" href="icon192.png" />
  <style>
    /* CSS tidak berubah, tetap menggunakan tema hijau yang sudah ada */
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
      max-width: 1200px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.98);
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
      background: linear-gradient(135deg, #4caf50, #2e7d32);
      color: white;
      border: none;
      padding: 12px 16px;
      border-radius: 12px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
      transition: all 0.3s ease;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .back-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
    }
    .page-title {
      font-size: 28px;
      font-weight: 700;
      color:rgb(3, 22, 4);
      text-align: center;
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    .filter-section {
      background: #e8f5e9;
      border: 1px solid #c8e6c9;
      padding: 20px;
      border-radius: 16px;
      margin-bottom: 30px;
    }
    .search-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    #searchInput {
      flex-grow: 1;
      padding: 12px 16px;
      border-radius: 12px;
      border: 2px solid #a5d6a7;
      font-size: 16px;
      transition: all 0.3s ease;
    }
    #searchInput:focus {
      border-color: #4caf50;
      box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
      outline: none;
    }
    .search-btn {
      padding: 12px 20px;
      background: linear-gradient(135deg, #4caf50, #2e7d32);
      color: white;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .filter-tabs {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      justify-content: center;
    }
    .filter-tab {
      padding: 8px 18px;
      border: 2px solid #a5d6a7;
      border-radius: 25px;
      background: white;
      cursor: pointer;
      font-weight: 600;
      color: #2e7d32;
      transition: all 0.3s ease;
    }
    .filter-tab.active, .filter-tab:hover {
      background: linear-gradient(135deg, #4caf50, #2e7d32);
      color: white;
      border-color: #2e7d32;
      transform: translateY(-2px);
    }
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 24px;
      margin-bottom: 30px;
    }
    .menu-item {
      background-color: #ffffff;
      border-radius: 16px;
      display: flex;
      flex-direction: column;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 1px solid #f0f0f0;
      overflow: hidden;
    }
    .menu-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 40px rgba(76, 175, 80, 0.2);
    }
    .menu-item-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .menu-details {
      padding: 20px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }
    .menu-details h4 {
      font-size: 20px;
      font-weight: 600;
      color:rgb(10, 15, 10);
      margin: 0 0 8px 0;
    }
    .menu-details .description {
      font-size: 14px;
      color: #666;
      line-height: 1.5;
      flex-grow: 1;
      margin-bottom: 12px;
    }
    .food-tag {
      display: inline-block;
      background: #e8f5e9;
      color: #2e7d32;
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 12px;
      align-self: flex-start;
    }
    .stats-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }
    .price {
      font-size: 18px;
      color:rgb(7, 12, 7);
      font-weight: 700;
    }
    .rating {
      font-size: 14px;
      color: #ff9800;
      font-weight: 600;
    }
    .add-to-cart {
      padding: 12px 20px;
      background: linear-gradient(135deg, #4caf50, #2e7d32);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      width: 100%;
      font-size: 16px;
      margin-top: auto;
    }
    #no-results {
        text-align: center;
        padding: 40px;
        background-color: #e8f5e9;
        border-radius: 16px;
        display: none;
    }
    @media (max-width: 768px) {
    .header {
        position: relative;
        padding-top: 60px; /* Tambah ruang supaya tombol tidak tumpang tindih */
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .back-button {
        position: absolute;
        left: 16px;
        top: 12px;
        z-index: 10;
    }

    .page-title {
        width: 100%;
        text-align: center;
        margin-top: 0;
    }
}

  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <a href="../menu/home.php" class="back-button">← Kembali</a>
      <h1 class="page-title"> Menu Minuman</h1>
    </div>

    <div class="filter-section">
  <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Cari Kopi, Jus, Soda...">
      <button class="search-btn" onclick="applyFilters()">Cari</button>
  </div>
  <div class="filter-tabs">
    <div class="filter-tab active" data-category="semua">Semua</div>
    <div class="filter-tab" data-category="Kopi">Kopi</div>
    <div class="filter-tab" data-category="Jus">Jus</div>
    <div class="filter-tab" data-category="Bersoda">Bersoda</div>
  </div>
</div>

<div class="menu-grid" id="menuGrid">
  
  <div class="menu-item" data-category="Kopi" onclick="goToDetail('Kopi Sayang')">
    <img class="menu-item-image" src="../minuman/kopi_sayang.jpeg" alt="Kopi Sayang" />
    <div class="menu-details">
      <div class="food-tag">👍 Favorit</div>
      <h4>Kopi Sayang</h4>
      <p class="description">Kopi manis penuh cinta untuk harimu.</p>
      <div class="stats-row">
        <p class="price">Rp. 12.000</p>
        <p class="rating">⭐ 4.5 (120 review)</p>
      </div>

    </div>
  </div>

  <div class="menu-item" data-category="Kopi" onclick="goToDetail('Dark Kopi')">
    <img class="menu-item-image" src="../minuman/dark_kopi.jpeg" alt="Dark Kopi" />
    <div class="menu-details">
      <div class="food-tag">Tanpa Gula</div>
      <h4>Dark Kopi</h4>
      <p class="description">Kopi hitam pekat dengan rasa bold untuk penikmat kopi sejati.</p>
      <div class="stats-row">
        <p class="price">Rp. 12.000</p>
        <p class="rating">⭐ 4.5 (130 review)</p>
      </div>
     
    </div>
  </div>

  <div class="menu-item" data-category="Kopi" onclick="goToDetail('Kopi Cinta')">
    <img class="menu-item-image" src="../minuman/kopi_cinta.jpeg" alt="Kopi Cinta" />
    <div class="menu-details">
      <div class="food-tag">Manis</div>
      <h4>Kopi Cinta</h4>
      <p class="description">Nikmati rasa kopi dengan sentuhan cinta dan aroma yang memikat.</p>
      <div class="stats-row">
        <p class="price">Rp. 10.000</p>
        <p class="rating">⭐ 4.5 (135 review)</p>
      </div>
      
    </div>
  </div>

  <div class="menu-item" data-category="Jus" onclick="goToDetail('Jus Lidah Buaya')">
    <img class="menu-item-image" src="../minuman/lidah_buaya.jpg" alt="Jus Lidah Buaya" />
    <div class="menu-details">
      <div class="food-tag" style="background-color: #e0f2f1; color: #00796b;">🌿 Herbal</div>
      <h4>Jus Lidah Buaya</h4>
      <p class="description">Segarnya jus lidah buaya yang menyehatkan dan menyegarkan tubuh.</p>
      <div class="stats-row">
        <p class="price">Rp. 8.000</p>
        <p class="rating">⭐ 4.2 (515 review)</p>
      </div>
      
    </div>
  </div>

  <div class="menu-item" data-category="Jus" onclick="goToDetail('Jus Mangga Murni')">
    <img class="menu-item-image" src="../minuman/jus_mangga.jpeg" alt="Jus Mangga Murni" />
    <div class="menu-details">
      <div class="food-tag">👍 Rekomendasi</div>
      <h4>Jus Mangga Murni</h4>
      <p class="description">Manisnya mangga harum manis alami dalam segelas jus segar.</p>
      <div class="stats-row">
        <p class="price">Rp. 13.000</p>
        <p class="rating">⭐ 4.7 (515 review)</p>
      </div>
     
    </div>
  </div>

  <div class="menu-item" data-category="Jus" onclick="goToDetail('Markisa Gembira')">
    <img class="menu-item-image" src="../minuman/markisa_gembira.jpeg" alt="Markisa Gembira" />
    <div class="menu-details">
      <div class="food-tag">Asam Manis</div>
      <h4>Markisa Gembira</h4>
      <p class="description">Markisa segar penuh semangat dengan perpaduan rasa asam dan manis.</p>
      <div class="stats-row">
        <p class="price">Rp. 10.000</p>
        <p class="rating">⭐ 4.3 (515 review)</p>
      </div>

    </div>
  </div>

  <div class="menu-item" data-category="Jus" onclick="goToDetail('Jus Jeruk')">
    <img class="menu-item-image" src="../gambar/jus_jeruk.jpeg" alt="Jus Jeruk" />
    <div class="menu-details">
      <div class="food-tag">Sumber Vitamin C</div>
      <h4>Jus Jeruk</h4>
      <p class="description">Vitamin C segar dari jeruk peras asli yang dipetik dari pohonnya.</p>
      <div class="stats-row">
        <p class="price">Rp. 8.000</p>
        <p class="rating">⭐ 4.2 (515 review)</p>
      </div>
      
    </div>
  </div>

  <div class="menu-item" data-category="Bersoda" onclick="goToDetail('Melo Mojito Sprit')">
    <img class="menu-item-image" src="../minuman/melo_mojito_sprit.jpeg" alt="Melo Mojito Sprit" />
    <div class="menu-details">
      <div class="food-tag" style="background-color: #e3f2fd; color: #1565c0;">❄️ Dingin</div>
      <h4>Melo Mojito Sprit</h4>
      <p class="description">Minuman bersoda dengan rasa melon dan sentuhan mojito yang menyegarkan.</p>
      <div class="stats-row">
        <p class="price">Rp. 10.000</p>
        <p class="rating">⭐ 4.3 (515 review)</p>
      </div>
    
    </div>
  </div>

  <div class="menu-item" data-category="Bersoda" onclick="goToDetail('Soda Gembira')">
    <img class="menu-item-image" src="../minuman/soda_gembira.jpeg" alt="Soda Gembira" />
    <div class="menu-details">
      <div class="food-tag">Klasik</div>
      <h4>Soda Gembira</h4>
      <p class="description">Soda manis legendaris dengan campuran susu kental manis dan sirup merah.</p>
      <div class="stats-row">
        <p class="price">Rp. 12.000</p>
        <p class="rating">⭐ 4.6 (515 review)</p>
      </div>
 
    </div>
  </div>

</div>
    </div>
    
    <div id="no-results">
        <h4>Oops! Menu tidak ditemukan.</h4>
        <p>Coba gunakan kata kunci atau filter yang berbeda.</p>
    </div>

  </div>

  <script>
    let currentCategory = 'semua';

    function applyFilters() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const menuItems = document.querySelectorAll('.menu-item');
      const noResultsDiv = document.getElementById('no-results');
      let foundItems = 0;

      menuItems.forEach(item => {
        const category = item.dataset.category;
        const title = item.querySelector('h4').textContent.toLowerCase();
        const description = item.querySelector('p.description').textContent.toLowerCase();
        
        const matchesCategory = currentCategory === 'semua' || category === currentCategory;
        const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);

        if (matchesCategory && matchesSearch) {
          item.style.display = 'flex';
          foundItems++;
        } else {
          item.style.display = 'none';
        }
      });
      
      noResultsDiv.style.display = foundItems === 0 ? 'block' : 'none';
    }

    // Menambahkan event listener ke semua tab filter
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            applyFilters();
        });
    });
    
    // Menambahkan event listener untuk tombol Enter pada search bar
    document.getElementById('searchInput').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });

   
    function goToDetail(menuName) {
      window.location.href = `../detail/detail_minuman.php?menu=${encodeURIComponent(menuName)}`;
    }

    function addToCart(nama, harga) {
      // Get existing cart from localStorage
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      
      // Check if item already exists in cart
      const existingItem = cart.find(item => item.nama === nama);
      
      if (existingItem) {
        existingItem.jumlah += 1;
        existingItem.total = existingItem.jumlah * harga;
      } else {
        cart.push({
          nama: nama,
          harga: harga,
          jumlah: 1,
          total: harga
        });
      }
      
      // Save updated cart to localStorage
      localStorage.setItem('cart', JSON.stringify(cart));
      
      // Show confirmation
      alert(`${nama} berhasil ditambahkan ke keranjang!`);
    }
  </script>
</body>
</html>