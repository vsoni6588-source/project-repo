<?php
$conn = new mysqli("localhost", "root", "", "expense_tracker");

$message = "";

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $pass  = $_POST['password'];
    $confirm = $_POST['confirm'];

    // Check if passwords match
    if ($pass != $confirm) {
        $message = "<div class='error-box'>Passwords do not match!</div>";
    } else {
        // Check if username already exists
        $check = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($check->num_rows > 0) {
            $message = "<div class='error-box'>Username already registered!</div>";
        } else {
            // Insert user
            $conn->query("INSERT INTO users(username, password) VALUES('$username', '$pass')");
            $message = "<div class='success-box'>Account Created Successfully! 🎉</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>

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

        .signup-card {
            width: 380px;
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 22px;
            backdrop-filter: blur(20px);
            box-shadow: 0px 10px 35px rgba(0,0,0,0.25);
            color: #fff;
            text-align: center;
        }

        .signup-card h2 {
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

        .signup-btn {
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

        .signup-btn:hover {
            background: #452ac0;
        }

        .error-box,
        .success-box {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .error-box {
            background: rgba(255, 0, 0, 0.45);
        }

        .success-box {
            background: rgba(0, 255, 0, 0.35);
        }

        .login-link {
            margin-top: 12px;
            display: block;
            color: #fff;
            text-decoration: none;
            opacity: 0.8;
        }

        .login-link:hover {
            opacity: 1;
        }
    </style>
</head>

<body>

<div class="signup-card">

    <h2>📝 Create Account</h2>

    <?= $message ?>

    <form method="POST">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm" required>
        </div>

        <button class="signup-btn" name="signup">Signup</button>
    </form>

    <a href="login.php" class="login-link">Already have an account? Login</a>

</div>

</body>
</html>

