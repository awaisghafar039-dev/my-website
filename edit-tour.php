<?php
include '../includes/db.php'; // DB connection

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request!");
}

$id = intval($_GET['id']);

// Fetch current data
$query = $conn->prepare("SELECT * FROM tour_packages WHERE id=?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    die("Package not found!");
}

$tour = $result->fetch_assoc();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $total_nights = $_POST['total_nights'];
    $hotel_category = $_POST['hotel_category'];
    $price = $_POST['price'];
    $country_type = $_POST['country_type'];

    $image = $tour['image']; // keep old image by default

    // If new image uploaded
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $fileName;
        }
    }

    $update = $conn->prepare("UPDATE tour_packages 
        SET title=?, total_nights=?, hotel_category=?, price=?, country_type=?, image=? 
        WHERE id=?");
    $update->bind_param("sissssi", $title, $total_nights, $hotel_category, $price, $country_type, $image, $id);

    if ($update->execute()) {
        header("Location: manage-tours.php?success=1");
        exit;
    } else {
        echo "Error updating record!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Tour Package</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 60%;
      margin: 40px auto;
      background: #fff;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      border-radius: 6px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    form label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    form input, form select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    img {
      margin-top: 10px;
      width: 120px;
      height: 80px;
      object-fit: cover;
      border-radius: 6px;
    }
    button {
      margin-top: 15px;
      background: #28a745;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #218838;
    }
    .back-btn {
      display: inline-block;
      margin-top: 10px;
      text-decoration: none;
      padding: 8px 15px;
      background: #007bff;
      color: #fff;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Edit Tour Package</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <label>Title:</label>
      <input type="text" name="title" value="<?php echo htmlspecialchars($tour['title']); ?>" required>

      <label>Total Nights:</label>
      <input type="number" name="total_nights" value="<?php echo $tour['total_nights']; ?>" required>

      <label>Hotel Category:</label>
      <input type="text" name="hotel_category" value="<?php echo htmlspecialchars($tour['hotel_category']); ?>" required>

      <label>Price:</label>
      <input type="number" step="0.01" name="price" value="<?php echo $tour['price']; ?>" required>

      <label>Country Type:</label>
      <select name="country_type" required>
        <option value="Domestic" <?php if($tour['country_type']=="Domestic") echo "selected"; ?>>Domestic</option>
        <option value="International" <?php if($tour['country_type']=="International") echo "selected"; ?>>International</option>
      </select>

      <label>Current Image:</label><br>
      <img src="../uploads/<?php echo $tour['image']; ?>" alt="No image"><br>

      <label>Upload New Image (optional):</label>
      <input type="file" name="image">

      <button type="submit">Update Package</button>
    </form>
    <a href="manage-tours.php" class="back-btn">⬅ Back to Manage</a>
  </div>
</body>
</html>
