<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'password123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 320px;
            text-align: center;
        }
        input[type=text], input[type=password] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background: #f3961c;
            border: none;
            padding: 10px 25px;
            color: white;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #d3740b;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .go-home {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #f3961c;
            font-weight: bold;
            border: 2px solid #f3961c;
            padding: 8px 20px;
            border-radius: 30px;
            transition: background 0.3s, color 0.3s;
        }
        .go-home:hover {
            background: #f3961c;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="admin.php">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <a class="go-home" href="index.php">Go back to Home</a>
    </div>
</body>
</html>
