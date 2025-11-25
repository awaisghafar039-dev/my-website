<?php
include '../includes/db.php'; // DB connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Tour Packages</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 90%;
      margin: 30px auto;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background: #333;
      color: #fff;
    }
    tr:nth-child(even) {
      background: #f2f2f2;
    }
    img {
      width: 100px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
    }
    .actions a {
      padding: 6px 12px;
      margin: 0 3px;
      text-decoration: none;
      border-radius: 4px;
      color: #fff;
      font-size: 14px;
    }
    .edit-btn {
      background: #28a745;
    }
    .delete-btn {
      background: #dc3545;
    }
    .add-btn {
      display: inline-block;
      margin-bottom: 15px;
      padding: 8px 15px;
      background: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Tour Packages</h1>
    <a href="add-tour-package.php" class="add-btn">+ Add New Tour</a>
    <table>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Total Nights</th>
        <th>Hotel Category</th>
        <th>Price</th>
        <th>Country Type</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>

      <?php
      $result = $conn->query("SELECT * FROM tour_packages ORDER BY id DESC");
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['title']}</td>
                  <td>{$row['total_nights']}</td>
                  <td>{$row['hotel_category']}</td>
                  <td>{$row['price']}</td>
                  <td>{$row['country_option']}</td>
                  <td><img src='uploads/{$row['image']}' alt='No Image'></td>
                  <td class='actions'>
                    <a href='edit-tour.php?id={$row['id']}' class='edit-btn'>Edit</a>
                    <a href='delete-tour.php?id={$row['id']}' class='delete-btn' onclick=\"return confirm('Are you sure?');\">Delete</a>
                  </td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='8'>No tours found.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
