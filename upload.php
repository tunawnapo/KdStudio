<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';
    $category = preg_replace("/[^a-zA-Z0-9_-]/", "", $category);

    if (!isset($_FILES['image']) || empty($category)) {
        header("Location: dashboard.php?message=Missing+data");
        exit;
    }

    $targetDir = "uploads/" . $category . "/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Save relative path only
            $relativePath = $category . "/" . $fileName;
            $stmt = $conn->prepare("INSERT INTO gallery (image_path, category) VALUES (?, ?)");
            $stmt->bind_param("ss", $relativePath, $category);
            $stmt->execute();
            $stmt->close();

            header("Location: dashboard.php?message=Image+uploaded+successfully");
            exit;
        } else {
            header("Location: dashboard.php?message=Error+uploading+file");
            exit;
        }
    } else {
        header("Location: dashboard.php?message=File+is+not+an+image");
        exit;
    }
}
?>
