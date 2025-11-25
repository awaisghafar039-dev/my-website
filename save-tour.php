<?php
include '../includes/db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$total_nights = $_POST['total_nights'];
$hotel_category = $_POST['hotel_category'];
$price = $_POST['price'];
$country_option = $_POST['country_option'];
$country1 = $_POST['country1_name'] ?? null;
$nights1 = $_POST['country1_nights'] ?? null;
$country2 = $_POST['country2_name'] ?? null;
$nights2 = $_POST['country2_nights'] ?? null;
$country3 = $_POST['country3_name'] ?? null;
$nights3 = $_POST['country3_nights'] ?? null;

$image = null;
if (!empty($_FILES['image']['name'])) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $image = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);
}

$sql = "INSERT INTO tour_packages 
(title, description, total_nights, hotel_category, price, country_option, country1_name, country1_nights, country2_name, country2_nights, country3_name, country3_nights, image)
VALUES 
('$title','$description','$total_nights','$hotel_category','$price','$country_option',
'$country1','$nights1','$country2','$nights2','$country3','$nights3','$image')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Tour Package Added Successfully'); window.location.href='manage-tours.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>
