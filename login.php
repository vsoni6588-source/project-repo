<?php
session_start();

// DB Connection
$conn = new mysqli("localhost", "root", "", "expense_tracker");

// Login Logic
$error = "";
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass  = $_POST['password'];

   $check = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$pass'");

if ($check->num_rows > 0) {
    $user = $check->fetch_assoc();

    $_SESSION['user_id'] = $user['id'];   // IMPORTANT
    $_SESSION['username']   = $user['username'];

    header("Location: index.php");
}
 else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial;
            background: linear-gradient(135deg, #4b33d8, #a86bff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            width: 380px;
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 22px;
            backdrop-filter: blur(20px);
            box-shadow: 0px 10px 35px rgba(0,0,0,0.25);
            color: #fff;
            text-align: center;
        }

        .login-card h2 {
            margin-bottom: 20px;
            font-size: 32px;
        }

        .input-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .input-group label {
            font-size: 14px;
            opacity: 0.85;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            outline: none;
            border-radius: 10px;
            margin-top: 5px;
            font-size: 15px;
            background: rgba(255,255,255,0.9);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #5f3ded;
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #452ac0;
        }

        .error-box {
            background: rgba(255, 0, 0, 0.4);
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .signup-link {
            margin-top: 12px;
            display: block;
            color: #fff;
            text-decoration: none;
            opacity: 0.8;
        }

        .signup-link:hover {
            opacity: 1;
        }
    </style>
</head>

<body>

<div class="login-card">

    <h2>🔐 Login</h2>

    <?php if ($error != "") { ?>
        <div class="error-box"><?= $error ?></div>
    <?php } ?>

    <form method="POST">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button class="login-btn" name="login">Login</button>
    </form>

    <a href="signup.php" class="signup-link">Create new account</a>

</div>

</body>
</html>
