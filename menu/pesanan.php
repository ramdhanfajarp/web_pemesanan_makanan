<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang Pesanan</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #2e7d32, #81c784);
      color: #333;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 24px;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #2e7d32;
      margin-bottom: 24px;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      line-height: 1.6;
    }

    .total {
      font-weight: bold;
      margin-top: 20px;
      font-size: 18px;
      text-align: right;
    }

    .btn {
      display: inline-block;
      margin-top: 24px;
      background: #f44336;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn:hover {
      background: #d32f2f;
    }

    .back {
      text-decoration: none;
      display: inline-block;
      margin-bottom: 16px;
      color: #2e7d32;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="../menu/home.php" class="back">← Kembali ke Beranda</a>
    <h1>Keranjang Anda</h1>
    <ul id="keranjangList"></ul>
    <div class="total" id="totalHarga">Total: Rp. 0</div>
    <button class="btn" onclick="hapusKeranjang()">Hapus Semua</button>
    <button class="btn" style="background: #4caf50; margin-left: 12px;" onclick="redirectToCheckout()">Checkout</button>


  </div>

  <script>
   
  function loadKeranjang() {
    const keranjang = JSON.parse(localStorage.getItem("cart")) || [];
    const list = document.getElementById("keranjangList");
    const totalDisplay = document.getElementById("totalHarga");

    list.innerHTML = "";
    let totalHarga = 0;

    if (keranjang.length === 0) {
      list.innerHTML = "<li>Tidak ada item di keranjang.</li>";
      totalDisplay.textContent = "Total: Rp. 0";
      return;
    }

    keranjang.forEach(item => {
      const li = document.createElement("li");
      li.innerHTML = `
        <strong>${item.nama}</strong><br>
        Jumlah: ${item.jumlah}<br>
        Total: Rp. ${item.total.toLocaleString('id-ID')}
      `;
      list.appendChild(li);
      totalHarga += item.total;
    });

    totalDisplay.textContent = "Total: Rp. " + totalHarga.toLocaleString('id-ID');
  }

  function hapusKeranjang() {
    if (confirm("Hapus semua isi keranjang?")) {
      localStorage.removeItem("cart");
      loadKeranjang();
    }
  }

  // ✅ Fungsi redirect ke checkout.php dengan 1 item
  function redirectToCheckout() {
  const keranjang = JSON.parse(localStorage.getItem("cart")) || [];

  if (keranjang.length === 0) {
    alert("Keranjang masih kosong!");
    return;
  }

  // Arahkan ke checkout halaman baru yang akan membaca semua data dari localStorage
  window.location.href = '../checkout/checkout.php';
}


  document.addEventListener("DOMContentLoaded", loadKeranjang);


    function loadKeranjang() {
      const keranjang = JSON.parse(localStorage.getItem("cart")) || [];
      const list = document.getElementById("keranjangList");
      const totalDisplay = document.getElementById("totalHarga");

      list.innerHTML = "";
      let totalHarga = 0;

      if (keranjang.length === 0) {
        list.innerHTML = "<li>Tidak ada item di keranjang.</li>";
        totalDisplay.textContent = "Total: Rp. 0";
        return;
      }

      keranjang.forEach(item => {
        const li = document.createElement("li");
        li.innerHTML = `
          <strong>${item.nama}</strong><br>
          Jumlah: ${item.jumlah}<br>
          Total: Rp. ${item.total.toLocaleString('id-ID')}
        `;
        list.appendChild(li);
        totalHarga += item.total;
      });

      totalDisplay.textContent = "Total: Rp. " + totalHarga.toLocaleString('id-ID');
    }

    function hapusKeranjang() {
      if (confirm("Hapus semua isi keranjang?")) {
        localStorage.removeItem("cart");
        loadKeranjang();
      }
    }

    document.addEventListener("DOMContentLoaded", loadKeranjang);
  </script>
</body>
</html>
