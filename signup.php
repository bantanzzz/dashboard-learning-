<?php include 'config.php'; ?>

<?php
if (isset($_POST['signup'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password === $confirm) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! Please login.'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error: Email already exists!');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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

        .signup-container {
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

        .login-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 0.25rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="logo">
        <a href="index.php">
            <i class="fas fa-code"></i>Django Girls
        </a>
    </div>
    <div class="signup-container">
        <h2>Create Account</h2>
        <form method="POST" onsubmit="return validateSignupForm()">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
                <div id="email-error" class="error-message">Please enter a valid email address</div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Create a password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
                <div id="password-error" class="error-message">Passwords do not match</div>
            </div>
            <button type="submit" name="signup">Create Account</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

    <script>
    function validateSignupForm() {
        const email = document.getElementById('email').value;
        const pass = document.getElementById('password').value;
        const confirm = document.getElementById('confirm_password').value;
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        let isValid = true;

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            emailError.style.display = 'block';
            isValid = false;
        } else {
            emailError.style.display = 'none';
        }

        if (pass !== confirm) {
            passwordError.style.display = 'block';
            isValid = false;
        } else {
            passwordError.style.display = 'none';
        }

        return isValid;
    }
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>
