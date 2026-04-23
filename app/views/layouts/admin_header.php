<?php
// Deteksi halaman aktif berdasarkan URL
$current_url = $_SERVER['REQUEST_URI'];

// Deteksi halaman aktif dengan pattern matching yang lebih akurat
$active_dashboard = (preg_match('#/admin/?$#', $current_url) || preg_match('#/admin/index#', $current_url)) ? 'active' : '';

$active_tours = (preg_match('#/admin/tours#', $current_url) || preg_match('#/admin/(create|edit|store|delete)Tour#', $current_url)) ? 'active' : '';
$active_profile = (preg_match('#/admin/profile#', $current_url)) ? 'active' : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['page_title']; ?> - TravelAdvisor Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Premium Admin Dashboard -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            color: #2d3748;
            overflow-x: hidden;
        }

        /* Sidebar Premium Elegant */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 280px;
            background: linear-gradient(180deg, #0a0e27 0%, #1a1f3a 50%, #0f1419 100%);
            backdrop-filter: blur(20px);
            box-shadow: 4px 0 40px rgba(0, 0, 0, 0.3), 
                        inset -1px 0 0 rgba(255, 255, 255, 0.05);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            padding: 0;
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(180deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);
            pointer-events: none;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar-header {
            padding: 32px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(15, 23, 42, 0.3);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
        }

        .sidebar-brand {
            color: #ffffff;
            font-weight: 800;
            font-size: 1.65rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: -0.8px;
            position: relative;
        }

        .sidebar-brand::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand:hover {
            color: #e0e7ff;
            transform: translateX(4px);
        }

        .sidebar-brand:hover::after {
            width: 100%;
        }

        .sidebar-brand i {
            font-size: 2rem;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 12px rgba(99, 102, 241, 0.5));
            transition: all 0.4s ease;
        }

        .sidebar-brand:hover i {
            filter: drop-shadow(0 0 16px rgba(99, 102, 241, 0.7));
            transform: scale(1.05) rotate(5deg);
        }

        .sidebar-nav {
            padding: 24px 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
            position: relative;
            z-index: 1;
        }

        .nav-section-title {
            padding: 16px 20px 8px 20px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(148, 163, 184, 0.5);
            margin-top: 8px;
        }

        .sidebar-nav .nav-item {
            margin-bottom: 4px;
            position: relative;
        }

        .sidebar-nav .nav-link {
            color: #cbd5e1;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-radius: 12px;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-weight: 500;
            font-size: 0.9375rem;
            text-decoration: none;
            margin: 0 4px;
            overflow: hidden;
        }

        .sidebar-nav .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transform-origin: center;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-nav .nav-link::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.35s ease;
            border-radius: 12px;
            z-index: 0;
        }

        .sidebar-nav .nav-link i {
            width: 24px;
            font-size: 1.15rem;
            text-align: center;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            color: #94a3b8;
            position: relative;
            z-index: 1;
        }

        .sidebar-nav .nav-link span {
            position: relative;
            z-index: 1;
            transition: all 0.35s ease;
            flex: 1;
        }

        .sidebar-nav .nav-link:hover {
            color: #ffffff;
            transform: translateX(6px);
            padding-left: 22px;
        }

        .sidebar-nav .nav-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar-nav .nav-link:hover::after {
            opacity: 1;
        }

        .sidebar-nav .nav-link:hover i {
            color: #818cf8;
            transform: scale(1.15) translateX(2px);
        }

        .sidebar-nav .nav-link.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.25) 0%, rgba(139, 92, 246, 0.2) 100%);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            padding-left: 22px;
        }

        .sidebar-nav .nav-link.active::before {
            transform: scaleY(1);
        }

        .sidebar-nav .nav-link.active::after {
            opacity: 1;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.15) 100%);
        }

        .sidebar-nav .nav-link.active i {
            color: #a5b4fc;
            transform: scale(1.2) translateX(2px);
            filter: drop-shadow(0 0 8px rgba(99, 102, 241, 0.6));
        }

        .sidebar-nav .nav-link.active span {
            text-shadow: 0 0 10px rgba(99, 102, 241, 0.3);
        }

        /* Active indicator dot - menggunakan span tambahan */
        .sidebar-nav .nav-link.active span::after {
            content: '';
            position: absolute;
            right: -24px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            box-shadow: 0 0 12px rgba(99, 102, 241, 0.8);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: translateY(-50%) scale(1);
            }
            50% {
                opacity: 0.7;
                transform: translateY(-50%) scale(1.2);
            }
        }

        /* Top Navbar Premium */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 70px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .navbar-content {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            letter-spacing: -0.5px;
            margin: 0;
        }

        /* Navbar User Profile - Styles dipindah ke komponen modular */

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            margin-top: 70px;
            padding: 35px;
            min-height: calc(100vh - 70px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .top-navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidebar-nav .nav-item {
            animation: slideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }

        .sidebar-nav .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .sidebar-nav .nav-item:nth-child(2) { animation-delay: 0.2s; }
        .sidebar-nav .nav-item:nth-child(3) { animation-delay: 0.3s; }
        .sidebar-nav .nav-item:nth-child(4) { animation-delay: 0.4s; }
    </style>
    <!-- Script untuk dropdown dipindah ke komponen modular -->
</head>
<body>

<!-- Top Navbar -->
<nav class="top-navbar">
    <div class="navbar-content">
        <h1 class="navbar-title"><?= $data['page_title']; ?></h1>
        <?php 
        // Include komponen navbar profile secara modular
        $componentPath = __DIR__ . '/../admin/components/navbar_profile.php';
        if (file_exists($componentPath)) {
            require_once $componentPath;
        } else {
            // Fallback jika komponen tidak ditemukan
            echo '<div class="navbar-user">Error: Component not found</div>';
        }
        ?>
    </div>
</nav>

<!-- Sidebar Menu -->
<div class="sidebar text-white">
    <div class="sidebar-header">
        <a class="sidebar-brand" href="<?= BASEURL; ?>/admin">
            <i class="fa-solid fa-umbrella-beach"></i>
            <span>TravelAdvisor</span>
        </a>
    </div>
    
    <ul class="nav flex-column sidebar-nav">
        <div class="nav-section-title">Main Menu</div>
        <li class="nav-item">
            <a class="nav-link <?= $active_dashboard; ?>" href="<?= BASEURL; ?>/admin">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $active_tours; ?>" href="<?= BASEURL; ?>/admin/tours">
                <i class="fa-solid fa-map-location-dot"></i>
                <span>Manage Tours</span>
            </a>
        </li>
    </ul>
</div>

<!-- Konten Utama (Area Kanan) -->
<main class="main-content">