<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete query
    $sql = "DELETE FROM tours WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage-tours.php?msg=Tour deleted successfully");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
