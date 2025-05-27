<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit;
}

include 'db.php';

$message = $_GET['message'] ?? '';
$images = [];

$result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}

// Get the correct base path if running in a subfolder
$basePath = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fffaf0;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #d35400;
        }

        a {
            color: #fff;
            background: #d41c41;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="file"],
        select,
        button {
            margin-top: 10px;
            padding: 8px;
            font-size: 1rem;
        }

        select {
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #f3961c;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #d35400;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .gallery-image {
            width: 200px;
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .gallery-image img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }

        .delete-button {
            margin-top: 10px;
            background: #d41c41;
            color: white;
            border: none;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .delete-button:hover {
            background: #a9132e;
        }

        p {
            margin: 5px 0 0;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="logout.php">Logout</a>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <h2>Upload New Image</h2>
    <form method="POST" enctype="multipart/form-data" action="upload.php">
        <input type="file" name="image" required />
        <br>
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="graduation">Graduation</option>
            <option value="wedding">Wedding</option>
            <option value="birthday">Birthday</option>
            <option value="other">Other Events</option>
        </select>
        <br>
        <button type="submit">Upload</button>
    </form>

    <h2>Existing Gallery Images</h2>
    <div class="gallery-container">
        <?php if (!empty($images)): ?>
            <?php foreach ($images as $img): 
                $imagePath = $basePath . "/uploads/" . htmlspecialchars($img['image_path']);
            ?>
                <div class="gallery-image">
                    <img src="<?php echo $imagePath; ?>" alt="Image" />
                    <p><small><?php echo $imagePath; ?></small></p>
                    <form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this image?');">
                        <input type="hidden" name="id" value="<?php echo $img['id']; ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                    <p>Category: <?php echo htmlspecialchars($img['category']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
