<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $makkah_hotel = $_POST['makkah_hotel'];
    $madina_hotel = $_POST['madina_hotel'];
    $flight = $_POST['flight'];
    $transport = $_POST['transport'];
    $visa = $_POST['visa'];
    $guide = $_POST['guide'];
    $description = $_POST['description'];

    // Image upload
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $sql = "INSERT INTO umrah_packages (title, price, duration, makkah_hotel, madina_hotel, flight, transport, visa, guide, description, image)
            VALUES ('$title', '$price', '$duration', '$makkah_hotel', '$madina_hotel', '$flight', '$transport', '$visa', '$guide', '$description', '$image_name')";

    if (mysqli_query($conn, $sql)) {
        $success = "Package added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Umrah Package</title>
  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #eef1f7, #f8f9fc);
    padding: 30px;
    color: #333;
  }

  h2 {
    text-align: center;
    color: #4e54c8;
    margin-bottom: 30px;
    font-size: 28px;
  }

  form {
    background: white;
    padding: 40px 30px;
    border-radius: 15px;
    max-width: 800px;
    margin: auto;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  }

  input, textarea, select {
    width: 100%;
    padding: 12px 15px;
    margin: 12px 0;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    transition: border-color 0.3s;
  }

  input:focus, textarea:focus, select:focus {
    border-color: #4e54c8;
    outline: none;
  }

  button {
    padding: 14px 20px;
    background: #4e54c8;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    margin-top: 20px;
    transition: background 0.3s;
  }

  button:hover {
    background: #343cc0;
  }

  .success, .error {
    text-align: center;
    font-size: 16px;
    margin-bottom: 15px;
  }

  .success {
    color: #2e8b57;
  }

  .error {
    color: #cc0000;
  }
</style>

</head>
<body>
      <a href="dashboard.php" style="
  display: inline-block;
  padding: 10px 20px;
  background-color: #333;;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  margin-bottom: 20px;
">🏠 Dashboard</a>

<h2>Add New Umrah Package</h2>

<?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
<?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

<form method="post" enctype="multipart/form-data">
  <input type="text" name="title" placeholder="Package Title" required>
  <input type="text" name="price" placeholder="Price (e.g. PKR 180,000)" required>
  <input type="text" name="duration" placeholder="Duration (e.g. 15 Days)" required>
  <input type="text" name="makkah_hotel" placeholder="Makkah Hotel Name" required>
  <input type="text" name="madina_hotel" placeholder="Madina Hotel Name" required>
  <input type="text" name="flight" placeholder="Flight Type (e.g. Return)" required>
  <input type="text" name="transport" placeholder="Transport (e.g. Bus/Private)" required>
  <select name="visa" required>
    <option value="">Visa Included?</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
  </select>
  <select name="guide" required>
    <option value="">Guide Service?</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
  </select>
  <textarea name="description" placeholder="Package Description" rows="4" required></textarea>
  <input type="file" name="image" accept="image/*" required>
  <button type="submit">Add Package</button>
</form>

</body>
</html>
