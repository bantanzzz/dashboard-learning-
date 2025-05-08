<?php include 'config.php'; ?>

<?php
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid Credentials!');</script>";
        }
    } else {
        echo "<script>alert('No user found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Django Girls</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo a {
            color: white;
            text-decoration: none;
            font-size: 2rem;
            font-weight: bold;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .logo a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .logo i {
            margin-right: 10px;
        }

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 1rem;
        }

        button:hover {
            background: #764ba2;
        }

        .signup-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="logo">
        <a href="index.php">
            <i class="fas fa-code"></i>Django Girls
        </a>
    </div>
    <div class="login-container">
        <h2>Welcome Back</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html> 