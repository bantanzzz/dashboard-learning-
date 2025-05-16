<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Django Girls</title>
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
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            color: #0f172a;
            font-size: 1.875rem;
            font-weight: 700;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }

        .profile-sidebar {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: 600;
            margin: 0 auto 1.5rem;
            overflow: hidden;
            position: relative;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar-upload {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            padding: 0.5rem;
            text-align: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .profile-avatar:hover .profile-avatar-upload {
            opacity: 1;
        }

        .profile-avatar-upload i {
            color: white;
            font-size: 1.25rem;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
        }

        .stat-value {
            color: #0f172a;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.75rem;
        }

        .profile-content {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #0f172a;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
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

        input, textarea {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            color: #0f172a;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        button {
            padding: 0.875rem 1.5rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        #profile-picture-input {
            display: none;
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

            .profile-grid {
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
                <a href="dashboard.php" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link active">
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
                    J
                </div>
                <div class="user-details">
                    <div class="user-name">John Doe</div>
                    <div class="user-email">john@example.com</div>
                </div>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="profile-header">
            <h1 class="page-title">Profile Settings</h1>
        </div>

        <div class="profile-grid">
            <div class="profile-sidebar">
                <div class="profile-avatar">
                    J
                    <label for="profile-picture-input" class="profile-avatar-upload">
                        <i class="fas fa-camera"></i>
                    </label>
                    <input type="file" name="profile_picture" id="profile-picture-input" accept="image/*">
                </div>
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">12</div>
                        <div class="stat-label">Courses</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">8</div>
                        <div class="stat-label">Badges</div>
                    </div>
                </div>
            </div>

            <div class="profile-content">
                <h2 class="section-title">Personal Information</h2>
                <form>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="name" name="name" value="John Doe" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" value="john@example.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <div class="input-wrapper">
                            <i class="fas fa-pen"></i>
                            <textarea id="bio" name="bio" placeholder="Tell us about yourself...">Web developer passionate about creating beautiful and functional applications.</textarea>
                        </div>
                    </div>

                    <button type="submit">Update Profile</button>
                </form>

                <h2 class="section-title" style="margin-top: 2rem;">Change Password</h2>
                <form>
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="current_password" name="current_password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="new_password" name="new_password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                    </div>

                    <button type="submit">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>