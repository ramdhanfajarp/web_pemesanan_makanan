<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Menu Makanan</title>
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
            color:rgb(4, 12, 4);
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
            color: black;
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
            color:rgb(4, 7, 4);
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

        /* --- [BARU] CSS KHUSUS UNTUK TAMPILAN MOBILE --- */
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

        /* --- [AKHIR] DARI CSS KHUSUS MOBILE --- */

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="../menu/home.php" class="back-button">← Kembali</a>
            <h1 class="page-title"> Menu Makanan</h1>
        </div>

        <div class="filter-section">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari sate, nasi, bakso...">
                <button class="search-btn" onclick="applyFilters()">Cari</button>
            </div>
            <div class="filter-tabs">
                <div class="filter-tab active" data-category="semua">Semua</div>
                <div class="filter-tab" data-category="nasi">Nasi</div>
                <div class="filter-tab" data-category="bakso">Bakso</div>
                <div class="filter-tab" data-category="mie">Mie</div>
                <div class="filter-tab" data-category="sate">Sate</div>
                <div class="filter-tab" data-category="tradisional">Tradisional</div>
            </div>
        </div>

        <div class="menu-grid" id="menuGrid">
            
            <div class="menu-item" data-category="nasi" onclick="goToDetail('Nasi Goreng Spesial')">
                <img class="menu-item-image" src="../gambar/nasi_goreng.jpeg" alt="Nasi Goreng Spesial">
                <div class="menu-details">
                    <div class="food-tag">👍 Rekomendasi</div>
                    <h4>Nasi Goreng Spesial</h4>
                    <p class="description">Nasi goreng dengan telur, ayam, udang, dan sayuran segar.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 15.000</p>
                        <p class="rating">⭐ 4.7 (156 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="nasi" onclick="goToDetail('Nasi Gudeg Yogya')">
                <img class="menu-item-image" src="../gambar/nasi_gudeg.jpeg" alt="Nasi Gudeg">
                <div class="menu-details">
                    <div class="food-tag">Asli Yogya</div>
                    <h4>Nasi Gudeg Yogya</h4>
                    <p class="description">Gudeg khas Yogya dengan ayam, telur, dan krecek yang manis gurih.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 16.000</p>
                        <p class="rating">⭐ 4.6 (134 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="nasi" onclick="goToDetail('Nasi Rendang')">
                <img class="menu-item-image" src="../gambar/rendang.jpeg" alt="Nasi Rendang">
                <div class="menu-details">
                    <div class="food-tag" style="background-color: #ffebee; color: #d32f2f;">🔥 Pedas</div>
                    <h4>Nasi Rendang</h4>
                    <p class="description">Rendang daging sapi dengan bumbu rempah khas Padang yang otentik.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 22.000</p>
                        <p class="rating">⭐ 4.9 (289 review)</p>
                    </div>
                </div>
            </div>
            
            <div class="menu-item" data-category="bakso" onclick="goToDetail('Bakso Aci Kaligondang')">
                <img class="menu-item-image" src="../gambar/bakso_aci.jpeg" alt="Bakso Aci Kaligondang">
                <div class="menu-details">
                    <div class="food-tag">Kenyal Gurih</div>
                    <h4>Bakso Aci Kaligondang</h4>
                    <p class="description">Bakso aci yang kenyal disajikan dengan cuanki dan kuah gurih pedas.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 12.000</p>
                        <p class="rating">⭐ 4.5 (120 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="bakso" onclick="goToDetail('Bakso Lumut')">
                <img class="menu-item-image" src="../gambar/bakso_lumut.jpeg" alt="Bakso Lumut">
                <div class="menu-details">
                    <div class="food-tag">✨ Unik</div>
                    <h4>Bakso Lumut</h4>
                    <p class="description">Bakso dengan lapisan telur hijau seperti lumut yang memberikan rasa unik.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 12.000</p>
                        <p class="rating">⭐ 4.5 (87 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="bakso" onclick="goToDetail('Bakso Jumbo')">
                <img class="menu-item-image" src="../gambar/bakso_jumbo.jpeg" alt="Bakso Jumbo">
                <div class="menu-details">
                    <div class="food-tag">Porsi Besar</div>
                    <h4>Bakso Jumbo</h4>
                    <p class="description">Bakso berukuran super besar dengan isian daging cincang dan telur puyuh.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 18.000</p>
                        <p class="rating">⭐ 4.7 (156 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="mie" onclick="goToDetail('Mie Ayam Bakso')">
                <img class="menu-item-image" src="../gambar/aymbkso.jpeg" alt="Mie Ayam Bakso">
                <div class="menu-details">
                    <div class="food-tag">Komplit</div>
                    <h4>Mie Ayam Bakso</h4>
                    <p class="description">Perpaduan klasik mie ayam dengan topping bakso sapi dan pangsit goreng renyah.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 12.000</p>
                        <p class="rating">⭐ 4.5 (98 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="mie" onclick="goToDetail('Mie Goreng Jawa')">
                <img class="menu-item-image" src="../gambar/mie_goreng.jpeg" alt="Mie Goreng Jawa">
                <div class="menu-details">
                    <div class="food-tag">Manis Gurih</div>
                    <h4>Mie Goreng Jawa</h4>
                    <p class="description">Mie goreng dengan bumbu khas Jawa yang manis dan gurih, dilengkapi sayuran.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 13.000</p>
                        <p class="rating">⭐ 4.4 (112 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="sate" onclick="goToDetail('Sate Ayam Madura')">
                <img class="menu-item-image" src="../gambar/sate_madura.jpeg" alt="Sate Ayam Madura">
                <div class="menu-details">
                    <div class="food-tag">👍 Rekomendasi</div>
                    <h4>Sate Ayam Madura</h4>
                    <p class="description">Sate ayam dengan bumbu kacang khas Madura yang kental dan meresap.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 18.000</p>
                        <p class="rating">⭐ 4.8 (203 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="sate" onclick="goToDetail('Sate Kambing')">
                <img class="menu-item-image" src="../gambar/sate_kambing.jpg" alt="Sate Kambing">
                <div class="menu-details">
                    <div class="food-tag" style="background-color: #ffebee; color: #d32f2f;">🔥 Pedas</div>
                    <h4>Sate Kambing</h4>
                    <p class="description">Sate dari daging kambing muda yang empuk dengan bumbu kecap pedas.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 25.000</p>
                        <p class="rating">⭐ 4.6 (167 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="tradisional" onclick="goToDetail('Gado-Gado Jakarta')">
                <img class="menu-item-image" src="../gambar/gado_gado.jpeg" alt="Gado-Gado Jakarta">
                <div class="menu-details">
                    <div class="food-tag" style="background-color: #e0f2f1; color: #00796b;">💚 Sehat</div>
                    <h4>Gado-Gado Jakarta</h4>
                    <p class="description">Salad sayuran segar khas Indonesia dengan saus kacang, lontong, dan kerupuk.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 13.000</p>
                        <p class="rating">⭐ 4.6 (92 review)</p>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="tradisional" onclick="goToDetail('Soto Betawi')">
                <img class="menu-item-image" src="../gambar/soto_betawi.jpeg" alt="Soto Betawi">
                <div class="menu-details">
                    <div class="food-tag">Khas Jakarta</div>
                    <h4>Soto Betawi</h4>
                    <p class="description">Soto dengan kuah santan gurih, potongan daging sapi, kentang, dan tomat.</p>
                    <div class="stats-row">
                        <p class="price">Rp. 17.000</p>
                        <p class="rating">⭐ 4.7 (145 review)</p>
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
        // --- ALGORITMA JAVASCRIPT ANDA TIDAK SAYA UBAH ---
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

        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                currentCategory = this.dataset.category;
                applyFilters();
            });
        });
        
        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        function goToDetail(menuName) {
            window.location.href = `../detail/detail_menu.php?menu=${encodeURIComponent(menuName)}`;
        }

        function addToCart(nama, harga) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
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
            
            localStorage.setItem('cart', JSON.stringify(cart));
            
            alert(`${nama} berhasil ditambahkan ke keranjang!`);
        }
    </script>
</body>
</html>