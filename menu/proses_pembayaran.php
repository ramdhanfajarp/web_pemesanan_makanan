<?php
// Tangkap total dari POST
$total = isset($_POST['total']) ? (int)$_POST['total'] : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran Berhasil</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #2e7d32, #81c784);
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      background: #fff;
      margin: 80px auto;
      border-radius: 16px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #2e7d32;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      margin-bottom: 30px;
      color: #333;
    }
    .total {
      font-size: 24px;
      font-weight: bold;
      color: #ff5722;
      margin-bottom: 30px;
    }
    .back-button {
      display: inline-block;
      padding: 14px 28px;
      background: linear-gradient(135deg, #4caf50, #2e7d32);
      color: white;
      border-radius: 12px;
      text-decoration: none;
      font-size: 16px;
      font-weight: bold;
      transition: 0.3s ease;
    }
    .back-button:hover {
      background: #388e3c;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>✅ Pembayaran Berhasil!</h1>
    <p>Terima kasih atas pesanan Anda.</p>
    <div class="total">Total Dibayar: Rp. <?= number_format($total, 0, ',', '.') ?></div>
    <a href="index.php" class="back-button">Kembali ke Beranda</a>
  </div>
</body>
</html>
