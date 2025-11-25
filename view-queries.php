<?php
include '../includes/db.php';

// Export to Excel
if (isset($_GET['export']) && $_GET['export'] === 'excel') {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=umrah_queries.xls");
    echo "Name\tContact\tPersons\tChildren\tInfants\tTotal Days\tMakkah Nights\tMadina Nights\tMakkah Hotel\tMadina Hotel\tCity\tDate\tStatus\n";

    $result = mysqli_query($conn, "SELECT * FROM umrah_queries ORDER BY created_at DESC");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "{$row['name']}\t{$row['contact']}\t{$row['persons']}\t{$row['child']}\t{$row['infant']}\t{$row['days']}\t{$row['makkah_nights']}\t{$row['madina_nights']}\t{$row['makkah_hotel_type']}\t{$row['madina_hotel_type']}\t{$row['city']}\t{$row['created_at']}\t{$row['status']}\n";
    }
    exit;
}

// Update status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $query_id = $_POST['query_id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE umrah_queries SET status='$status' WHERE id=$query_id");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Umrah Queries</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f0f2f5;
      color: #333;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: center;
    }
    th {
      background-color: #333;
      color: white;
    }
    tr:hover {
      background-color: #f9f9f9;
    }
    .home-btn, .export-btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #333;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      margin-right: 10px;
    }
    .status-select {
      padding: 5px;
    }
    .save-btn {
      padding: 5px 10px;
      background: #2196F3;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<a href="dashboard.php" class="home-btn">🏠 Home</a>
<a href="view-queries.php?export=excel" class="export-btn">📁 Export to Excel</a>


<h2>🕋 Umrah Package Queries</h2>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Contact</th>
      <th>Persons</th>
      <th>Children</th>
      <th>Infants</th>
      <th>Total Days</th>
      <th>Makkah Nights</th>
      <th>Madina Nights</th>
      <th>Makkah Hotel</th>
      <th>Madina Hotel</th>
      <th>City</th>
      <th>Date</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM umrah_queries ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $i = 1;

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
        <td>{$i}</td>
        <td>{$row['name']}</td>
        <td>{$row['contact']}</td>
        <td>{$row['persons']}</td>
        <td>{$row['child']}</td>
        <td>{$row['infant']}</td>
        <td>{$row['days']}</td>
        <td>{$row['makkah_nights']}</td>
        <td>{$row['madina_nights']}</td>
        <td>{$row['makkah_hotel_type']}</td>
        <td>{$row['madina_hotel_type']}</td>
        <td>{$row['city']}</td>
        <td>{$row['created_at']}</td>
        <td>
          <form method='POST' style='display: flex; gap: 5px; justify-content: center; align-items: center;'>
            <input type='hidden' name='query_id' value='{$row['id']}'>
            <select name='status' class='status-select'>
              <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
              <option value='Solved' " . ($row['status'] == 'Solved' ? 'selected' : '') . ">Solved</option>
            </select>
            <button type='submit' name='update_status' class='save-btn'>Save</button>
          </form>
        </td>
      </tr>";
      $i++;
    }
    ?>
  </tbody>
</table>

</body>
</html>
