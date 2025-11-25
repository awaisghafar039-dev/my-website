<?php
include '../includes/db.php';

// DELETE logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = "DELETE FROM umrah_packages WHERE id=$id";
    mysqli_query($conn, $del);
    header("Location: manage-packages.php");
    exit;
}

// UPDATE logic
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $makkah = $_POST['makkah_hotel'];
    $madina = $_POST['madina_hotel'];
    $flight = $_POST['flight'];
    $transport = $_POST['transport'];
    $visa = $_POST['visa'];
    $guide = $_POST['guide'];
    $description = $_POST['description'];

    $update = "UPDATE umrah_packages SET 
        title='$title',
        price='$price',
        duration='$duration',
        makkah_hotel='$makkah',
        madina_hotel='$madina',
        flight='$flight',
        transport='$transport',
        visa='$visa',
        guide='$guide',
        description='$description'
        WHERE id=$id";
        
    mysqli_query($conn, $update);
    header("Location: manage-packages.php");
    exit;
}

// Fetch all packages
$packages = mysqli_query($conn, "SELECT * FROM umrah_packages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Packages</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 30px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    th { background-color: #f2f2f2; }
    img { width: 100px; }
    .form-section { background: #f9f9f9; padding: 20px; margin-top: 30px; border-radius: 10px; }
    .form-section input, .form-section textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
    .form-section button { padding: 10px 20px; background: #4CAF50; color: #fff; border: none; }
    .edit-form { margin-top: 40px; }
    h2 { margin-top: 40px; }
    .action-btn a { margin: 0 5px; text-decoration: none; color: white; padding: 5px 10px; border-radius: 5px; }
    .edit-btn { background: #2196F3; }
    .delete-btn { background: #f44336; }
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


  <h1>Manage Umrah Packages</h1>

  <table>
    <tr>
      <th>Image</th>
      <th>Title</th>
      <th>Duration</th>
      <th>Price</th>
      <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($packages)) { ?>
      <tr>
        <td><img src="../uploads/<?php echo $row['image']; ?>" alt=""></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['duration']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td class="action-btn">
          <a href="manage-packages.php?edit=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
          <a href="manage-packages.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this package?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>

  <?php
  // Edit form if edit=ID in URL
  if (isset($_GET['edit'])) {
      $edit_id = $_GET['edit'];
      $get = mysqli_query($conn, "SELECT * FROM umrah_packages WHERE id=$edit_id");
      $data = mysqli_fetch_assoc($get);
  ?>
    <div class="form-section edit-form">
      <h2>Edit Package</h2>
      <form method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <input type="text" name="title" value="<?php echo $data['title']; ?>" required>
        <input type="text" name="price" value="<?php echo $data['price']; ?>" required>
        <input type="text" name="duration" value="<?php echo $data['duration']; ?>" required>
        <input type="text" name="makkah_hotel" value="<?php echo $data['makkah_hotel']; ?>">
        <input type="text" name="madina_hotel" value="<?php echo $data['madina_hotel']; ?>">
        <input type="text" name="flight" value="<?php echo $data['flight']; ?>">
        <input type="text" name="transport" value="<?php echo $data['transport']; ?>">
        <input type="text" name="visa" value="<?php echo $data['visa']; ?>">
        <input type="text" name="guide" value="<?php echo $data['guide']; ?>">
        <textarea name="description"><?php echo $data['description']; ?></textarea>
        <button type="submit" name="update">Update Package</button>
      </form>
    </div>
  <?php } ?>

</body>
</html>
