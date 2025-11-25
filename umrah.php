<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Umrah Packages</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background: #f2f4f8;
      font-family: Arial, sans-serif;
      padding: 30px;
      text-align: center;
    }

    h1 {
      color: #003366;
      margin-bottom: 30px;
    }

    .package-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .card-link {
      text-decoration: none;
      color: inherit;
    }

   .package-card {
  flex: 0 0 30%;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  background: #fff;
  padding: 15px;
  font-family: Arial, sans-serif;
  text-align: left;
  height: auto; /* ✅ changed from max-height and removed overflow */
  transition: transform 0.2s ease;
}


    .package-card:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .package-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    h3 {
      color: #003366;
      margin-bottom: 10px;
      font-size: 20px;
      text-align:center;
    }

    .tag-box {
      margin-bottom: 10px;
    }

    .tag {
      display: inline-block;
      background-color: #e7f0fa;
      color: #003366;
      padding: 6px 10px;
      border-radius: 8px;
      margin: 3px 3px 5px 0;
      font-size: 14px;
    }

    .price-box {
      background-color: #0056b3;
      color: white;
      font-weight: bold;
      text-align: center;
      padding: 10px;
      margin-top: 15px;
      border-radius: 10px;
      font-size: 18px;
    }
        p {
      margin: 5px 0;
      font-size: 14px;
    }

    @media (max-width: 992px) {
      .package-card {
        flex: 0 0 45%;
      }
    }

    @media (max-width: 600px) {
      .package-card {
        flex: 0 0 100%;
      }
    }
  </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

<h1>Umrah Packages</h1>

<div class="package-container">
  <?php
  $sql = "SELECT * FROM umrah_packages ORDER BY id DESC";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $price = floatval(str_replace(',', '', $row['price'])); // ✅ Fix price error
    ?>
    <a href="umrah-detail.php?id=<?php echo $row['id']; ?>" class="card-link">
      <div class="package-card">
        <img src="admin/uploads/<?php echo $row['image']; ?>" class="package-img" alt="Umrah Image">

        <h3><?php echo htmlspecialchars($row['title']); ?></h3>

        <p><strong>🕒 Duration:</strong> <?php echo $row['duration']; ?> Days</p>
        <p><strong>🕌 Makkah Hotel:</strong> <?php echo $row['makkah_hotel']; ?></p>
        <p><strong>🌴 Madina Hotel:</strong> <?php echo $row['madina_hotel']; ?></p>

       <div style="display: flex; justify-content: space-between;">
  <p><strong>✈️ Flight:</strong> <?php echo $row['flight']; ?></p>
  <p><strong>🚐 Transport:</strong> <?php echo $row['transport']; ?></p>
</div>

<div style="display: flex; justify-content: space-between;">
  <p><strong>🛂 Visa:</strong> <?php echo $row['visa']; ?></p>
  <p><strong>🧭 Guide:</strong> <?php echo $row['guide']; ?></p>
</div>

       <p><strong>📄 Description:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>


        <div class="price-box">
          Rs. <?php echo number_format($price); ?>
        </div>
      </div>
    </a>
    <?php
  }
  ?>
</div>



</body>

</html>


