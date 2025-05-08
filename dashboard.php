<?php include 'config.php'; ?>

<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            transition: all 0.3s ease;
        }
        .logo-section {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .logo-text {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        .logo-text:hover {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .welcome-banner {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        /* Settings Dropdown Styles */
        .settings-dropdown {
            position: relative;
        }
        .settings-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .settings-menu {
            display: none;
            background-color: #2c3136;
            padding: 5px 0;
            margin-left: 15px;
            border-left: 2px solid #007bff;
        }
        .settings-dropdown:hover .settings-menu {
            display: block;
        }
        .settings-menu a {
            padding: 8px 15px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .settings-menu a:hover {
            background-color: #007bff;
            padding-left: 20px;
        }
        .settings-menu i {
            width: 20px;
            text-align: center;
        }

        /* Mobile Navigation Styles */
        .mobile-nav-toggle {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: #343a40;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-nav-toggle {
                display: block;
            }
            
            .sidebar {
                position: fixed;
                left: -100%;
                width: 250px;
                z-index: 999;
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            }
            
            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }

            .settings-dropdown:hover .settings-menu {
                display: none;
            }

            .settings-dropdown.active .settings-menu {
                display: block;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 998;
            }

            .overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Navigation Toggle -->
    <button class="mobile-nav-toggle" id="mobileNavToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar" id="sidebar">
                <!-- Logo Section -->
                <div class="logo-section">
                    <a href="#" class="logo-text">
                        <i class="fas fa-code me-2"></i>Django Girls
                    </a>
                </div>
                <div class="text-center mb-4">
                    <i class="fas fa-user-circle fa-3x text-white"></i>
                    <h5 class="text-white mt-2"><?php echo $_SESSION['user_name']; ?></h5>
                </div>
                <nav>
                    <a href="#"><i class="fas fa-home me-2"></i> Dashboard</a>
                    <a href="#"><i class="fas fa-user me-2"></i> View Profile</a>
                    <div class="settings-dropdown">
                        <a href="#" class="settings-toggle"><i class="fas fa-cog me-2"></i> Settings <i class="fas fa-chevron-down ms-2"></i></a>
                        <div class="settings-menu">
                            <a href="settings/account-security.php"><i class="fas fa-user-shield me-2"></i> Account Security</a>
                            <a href="settings/notifications.php"><i class="fas fa-bell me-2"></i> Notification Preferences</a>
                            <a href="settings/theme.php"><i class="fas fa-palette me-2"></i> Theme Settings</a>
                            <a href="#"><i class="fas fa-language me-2"></i> Language</a>
                            <a href="#"><i class="fas fa-lock me-2"></i> Privacy Settings</a>
                            <a href="#"><i class="fas fa-key me-2"></i> Change Password</a>
                        </div>
                    </div>
                    <a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="welcome-banner">
                    <h2>Welcome back, <?php echo $_SESSION['user_name']; ?>!</h2>
                    <p>Here's what's happening with your account today.</p>
                </div>

                <div class="row">
                    <!-- Quick Stats -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-chart-line me-2"></i>Account Status</h5>
                                <p class="card-text">Your account is active and secure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-bell me-2"></i>Notifications</h5>
                                <p class="card-text">You have no new notifications.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-shield-alt me-2"></i>Security</h5>
                                <p class="card-text">Last login: <?php echo date('Y-m-d H:i:s'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Navigation Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileNavToggle = document.getElementById('mobileNavToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const settingsDropdowns = document.querySelectorAll('.settings-dropdown');

            // Toggle sidebar
            mobileNavToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                this.querySelector('i').classList.toggle('fa-bars');
                this.querySelector('i').classList.toggle('fa-times');
            });

            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                mobileNavToggle.querySelector('i').classList.add('fa-bars');
                mobileNavToggle.querySelector('i').classList.remove('fa-times');
            });

            // Handle settings dropdown on mobile
            settingsDropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.settings-toggle');
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                });
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        mobileNavToggle.querySelector('i').classList.add('fa-bars');
                        mobileNavToggle.querySelector('i').classList.remove('fa-times');
                    }
                }
            });
        });
    </script>
</body>
</html>
