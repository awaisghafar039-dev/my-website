<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name           = mysqli_real_escape_string($conn, $_POST['name']);
  $contact        = mysqli_real_escape_string($conn, $_POST['contact']);
  $persons        = (int) $_POST['persons'];
  $children       = (int) $_POST['children'];
  $infants        = (int) $_POST['infants'];
  $total_days     = (int) $_POST['total_days'];
  $makkah_nights  = (int) $_POST['makkah_nights'];
  $madina_nights  = (int) $_POST['madina_nights'];
  $makkah_hotel   = mysqli_real_escape_string($conn, $_POST['makkah_hotel']);
  $madina_hotel   = mysqli_real_escape_string($conn, $_POST['madina_hotel']);
  $city           = mysqli_real_escape_string($conn, $_POST['city']);
  $address        = mysqli_real_escape_string($conn, $_POST['address']);

  $sql = "INSERT INTO umrah_queries 
    (name, contact, persons, child, infant, days, makkah_nights, madina_nights, makkah_hotel_type, madina_hotel_type, city) 
    VALUES 
    ('$name', '$contact', $persons, $children, $infants, $total_days, $makkah_nights, $madina_nights, '$makkah_hotel', '$madina_hotel', '$city')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Your query has been submitted successfully!'); window.location.href='index.php';</script>";
  } else {
    echo "<script>alert('Error: Unable to submit query.'); window.history.back();</script>";
  }
} else {
  header("Location: index.php");
  exit();
}
?>
