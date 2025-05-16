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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }

        .background-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: #3b82f6;
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: #8b5cf6;
            bottom: -150px;
            right: -100px;
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            background: #ec4899;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .login-wrapper {
            display: flex;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .login-image {
            flex: 1;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-image::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
            animation: pattern 20s linear infinite;
        }

        @keyframes pattern {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-50%, -50%); }
        }

        .login-image h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            position: relative;
        }

        .login-image p {
            font-size: 1.1rem;
            text-align: center;
            opacity: 0.9;
            max-width: 300px;
            position: relative;
        }

        .login-form {
            flex: 1;
            padding: 3rem;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            margin-bottom: 2rem;
        }

        .logo a {
            color: #0f172a;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            color: #3b82f6;
        }

        h2 {
            color: #0f172a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            color: #0f172a;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        input::placeholder {
            color: #94a3b8;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #64748b;
            font-size: 0.875rem;
        }

        .signup-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .signup-link a:hover {
            color: #2563eb;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .login-image {
                padding: 2rem;
                min-height: 200px;
            }

            .login-image h1 {
                font-size: 2rem;
            }

            .login-form {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="background-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    
    <div class="container">
        <div class="login-wrapper">
            <div class="login-image">
                <h1>Welcome to Django Girls</h1>
                <p>Join our community of developers and start your coding journey today.</p>
            </div>
            
            <div class="login-form">
                <div class="logo">
                    <a href="index.php">
                        <i class="fas fa-code"></i>
                        <span>Django Girls</span>
                    </a>
                </div>
                
                <h2>Welcome Back</h2>
                <p class="subtitle">Please enter your details to sign in</p>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                    </div>
                    
                    <button type="submit" name="login">Sign In</button>
                    
                    <div class="signup-link">
                        Don't have an account? <a href="signup.php">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 