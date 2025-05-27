<?php
include 'db.php';

$category = $_GET['category'] ?? '';
$images = [];

if ($category) {
    $stmt = $conn->prepare("SELECT * FROM gallery WHERE category = ? ORDER BY id DESC");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }
        h1 {
            color: #f3961c;
        }
        .filters a {
            margin-right: 10px;
            text-decoration: none;
            color: white;
            background: #d41c41;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .gallery img {
            width: 200px;
            height: auto;
            border-radius: 6px;
            box-shadow: 0 0 6px #ccc;
        }
    </style>
</head>
<body>
    <h1>Gallery <?= $category ? ' - ' . htmlspecialchars($category) : '' ?></h1>

    <div class="filters">
        <a href="gallery.php">All</a>
        <a href="gallery.php?category=graduation">Graduation</a>
        <a href="gallery.php?category=wedding">Wedding</a>
        <a href="gallery.php?category=birthday">Birthday</a>
        <a href="gallery.php?category=other">Other</a>
    </div>

    <div class="gallery">
        <?php if (!empty($images)): ?>
            <?php foreach ($images as $img): ?>
                <img src="uploads/<?= htmlspecialchars($img['image_path']) ?>" alt="">
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images found for this category.</p>
        <?php endif; ?>
    </div>
</body>
</html>
