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
    <title>Dashboard - Django Girls</title>
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
            background: #f8fafc;
            display: flex;
        }

        .sidebar {
            width: 280px;
            background: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 2rem;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .logo {
            margin-bottom: 2.5rem;
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

        .nav-menu {
            list-style: none;
            margin-bottom: 2rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: #f1f5f9;
            color: #3b82f6;
        }

        .nav-link i {
            font-size: 1.25rem;
        }

        .user-profile {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .user-info:hover {
            background: #f1f5f9;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            color: #0f172a;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-email {
            color: #64748b;
            font-size: 0.75rem;
        }

        .logout-btn {
            color: #ef4444;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border-radius: 12px;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
        }

        .logout-btn:hover {
            background: #fee2e2;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 12px;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            flex: 1;
            max-width: 400px;
        }

        .search-bar i {
            color: #64748b;
            margin-right: 0.75rem;
        }

        .search-bar input {
            border: none;
            outline: none;
            background: none;
            width: 100%;
            font-size: 0.875rem;
            color: #0f172a;
        }

        .search-bar input::placeholder {
            color: #94a3b8;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification-btn {
            position: relative;
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .notification-btn:hover {
            background: #f1f5f9;
            color: #3b82f6;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 0.75rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 12px -1px rgba(0, 0, 0, 0.15);
        }

        .action-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .action-details {
            flex: 1;
        }

        .action-title {
            color: #0f172a;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .action-description {
            color: #64748b;
            font-size: 0.75rem;
        }

        .progress-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .progress-title {
            color: #0f172a;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .view-all {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .course-progress {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .course-progress:last-child {
            border-bottom: none;
        }

        .course-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .course-details {
            flex: 1;
        }

        .course-name {
            color: #0f172a;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: #3b82f6;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .progress-text {
            color: #64748b;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .page-title {
            color: #0f172a;
            font-size: 1.875rem;
            font-weight: 700;
        }

        .welcome-message {
            color: #64748b;
            font-size: 1rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            color: #0f172a;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .bg-blue {
            background: #dbeafe;
            color: #3b82f6;
        }

        .bg-purple {
            background: #ede9fe;
            color: #8b5cf6;
        }

        .bg-pink {
            background: #fce7f3;
            color: #ec4899;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }

        .card-label {
            color: #64748b;
            font-size: 0.875rem;
        }

        .recent-activity {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            color: #0f172a;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            color: #64748b;
            font-size: 0.75rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar {
                max-width: none;
            }

            .header-actions {
                justify-content: flex-end;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <a href="dashboard.php">
                <i class="fas fa-code"></i>
                <span>Django Girls</span>
            </a>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>

        <div class="user-profile">
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                </div>
                <div class="user-details">
                    <div class="user-name"><?php echo $_SESSION['user_name']; ?></div>
                    <div class="user-email"><?php echo $_SESSION['user_email']; ?></div>
                </div>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search courses, lessons, or resources...">
            </div>
            <div class="header-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
            </div>
        </div>

        <div class="quick-actions">
            <div class="action-card">
                <div class="action-icon bg-blue">
                    <i class="fas fa-play"></i>
                </div>
                <div class="action-details">
                    <div class="action-title">Continue Learning</div>
                    <div class="action-description">Resume your last course</div>
                </div>
            </div>
            <div class="action-card">
                <div class="action-icon bg-purple">
                    <i class="fas fa-book"></i>
                </div>
                <div class="action-details">
                    <div class="action-title">Browse Courses</div>
                    <div class="action-description">Explore new courses</div>
                </div>
            </div>
            <div class="action-card">
                <div class="action-icon bg-pink">
                    <i class="fas fa-users"></i>
                </div>
                <div class="action-details">
                    <div class="action-title">Community</div>
                    <div class="action-description">Connect with learners</div>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Total Courses</h2>
                    <div class="card-icon bg-blue">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="card-value">12</div>
                <div class="card-label">Available courses</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Progress</h2>
                    <div class="card-icon bg-purple">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="card-value">75%</div>
                <div class="card-label">Course completion</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Achievements</h2>
                    <div class="card-icon bg-pink">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
                <div class="card-value">8</div>
                <div class="card-label">Badges earned</div>
            </div>
        </div>

        <div class="progress-section">
            <div class="progress-header">
                <h2 class="progress-title">Course Progress</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="course-progress">
                <div class="course-icon bg-blue">
                    <i class="fas fa-code"></i>
                </div>
                <div class="course-details">
                    <div class="course-name">Python Basics</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>
                    <div class="progress-text">75% Complete</div>
                </div>
            </div>
            <div class="course-progress">
                <div class="course-icon bg-purple">
                    <i class="fas fa-database"></i>
                </div>
                <div class="course-details">
                    <div class="course-name">Django Fundamentals</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 45%"></div>
                    </div>
                    <div class="progress-text">45% Complete</div>
                </div>
            </div>
            <div class="course-progress">
                <div class="course-icon bg-pink">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="course-details">
                    <div class="course-name">Web Development</div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 30%"></div>
                    </div>
                    <div class="progress-text">30% Complete</div>
                </div>
            </div>
        </div>

        <div class="recent-activity">
            <h2 class="card-title">Recent Activity</h2>
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon bg-blue">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Completed Python Basics</div>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon bg-purple">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Started Django Project</div>
                        <div class="activity-time">5 hours ago</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon bg-pink">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="activity-details">
                        <div class="activity-title">Earned "Quick Learner" Badge</div>
                        <div class="activity-time">1 day ago</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
