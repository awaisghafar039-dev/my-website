<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 360px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #4e54c8;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #4e54c8;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>
    <?php if (isset($_GET['error'])) { echo "<div class='error'>" . htmlspecialchars($_GET['error']) . "</div>"; } ?>
    <form action="login-check.php" method="post">
        <input type="text" name="username" placeholder="Enter admin username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
