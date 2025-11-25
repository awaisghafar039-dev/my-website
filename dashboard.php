<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

// Get real-time data from database
$queries_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM umrah_queries");
$queries = mysqli_fetch_assoc($queries_result)['total'];

$packages_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM umrah_packages");
$packages = mysqli_fetch_assoc($packages_result)['total'];

$tours_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM tour_packages");
$tours = mysqli_fetch_assoc($tours_result)['total'];

$users_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM admin_users");
$users = mysqli_fetch_assoc($users_result)['total'];

$solved_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM umrah_queries WHERE status = 'Solved'");
$solved_queries = mysqli_fetch_assoc($solved_result)['total'];

$pending_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM umrah_queries WHERE status = 'Pending'");
$pending_queries = mysqli_fetch_assoc($pending_result)['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <style>
    * {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      display: flex;
      min-height: 100vh;
      background-color: #f4f6fa;
    }

    .sidebar {
      width: 250px;
      background-color: #323a49;
      color: #fff;
      height: 100vh;
      position: fixed;
    }

    .sidebar h2 {
      text-align: center;
      margin: 30px 0;
      font-size: 22px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 14px 30px;
      color: #fff;
      text-decoration: none;
      font-size: 15px;
      transition: background 0.3s;
    }

    .sidebar a:hover {
      background-color: #4e54c8;
    }

    .main-content {
      margin-left: 250px;
      flex: 1;
      padding: 40px;
    }

    .main-content h1 {
      color: #4e54c8;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .stats {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
    }

    .stat-box {
      flex: 1 1 200px;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
      text-align: center;
      transition: 0.3s ease;
    }

    .stat-box:hover {
      transform: translateY(-5px);
    }

    .stat-box h2 {
      font-size: 22px;
      margin-bottom: 10px;
      color: #333;
    }

    .stat-box p {
      font-size: 14px;
      color: #777;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="view-queries.php">📋 View Umrah Queries</a>
    <a href="add-package.php">➕ Add Umrah Package</a>
    <a href="manage-packages.php">➕ Manage Package</a>
    <a href="add-tour-package.php">🗺️ Add Tour Package</a>
    <li><a href="manage-tours.php">Manage Tour</a></li>
    <a href="add-user.php">👤 Add Admin User</a>
    <a href="logout.php">🚪 Logout</a>
  </div>

  <div class="main-content">
    <h1>Welcome to Admin Dashboard</h1>
    <div class="stats">
      <div class="stat-box">
        <h2><?= $queries ?></h2>
        <p>Umrah Inquiries Received</p>
      </div>

      <div class="stat-box">
  <h2><?= $solved_queries ?></h2>
  <p>Solved Queries</p>
</div>

<div class="stat-box">
  <h2><?= $pending_queries ?></h2>
  <p>Pending Queries</p>
</div>


      <div class="stat-box">
        <h2><?= $packages ?></h2>
        <p>Umrah Packages Active</p>
      </div>
      <div class="stat-box">
        <h2><?= $users ?></h2>
        <p>Admin Users</p>
      </div>
    </div>
  </div>

</body>
</html>
