<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Get the image filename
    $stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $file = "uploads/" . $row['image_path'];
        
        // Delete the file if it exists
        if (file_exists($file)) {
            unlink($file);
        }

        // Delete from database
        $deleteStmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
        $deleteStmt->bind_param("i", $id);
        $deleteStmt->execute();
        $deleteStmt->close();
    }

    $stmt->close();
}

header("Location: dashboard.php");
exit;
?>
