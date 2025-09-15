<?php
include "scraper.php";


?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>View Kotak Foto dari URL</title>
  <style>
    .container {
      width: 527px;
      height: 480px;
      overflow: hidden;
      position: relative;
      border: 2px solid #007bff;
      border-radius: 6px;
      margin: 10px;
    }
    .container img {
      position: absolute;
      top: -107px;   /* crop Y */
      left: -90px;   /* crop X */
      display: block;
    }
  </style>
</head>
<body>
  <?php if ($linkGambar): ?>
    <div class="container">
      <img src="<?= htmlspecialchars($linkGambar) ?>" alt="Kotak Foto">
    </div>
  <?php else: ?>
    <p>Tidak ada gambar ditemukan.</p>
  <?php endif; ?>
</body>
</html>
