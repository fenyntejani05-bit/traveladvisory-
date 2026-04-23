<?php
require_once __DIR__ . '/../../helpers/Formatter.php';
?>

<!-- Welcome Header -->
<div class="dashboard-welcome mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="welcome-title">Welcome back, <span class="text-gradient"><?= htmlspecialchars($_SESSION['user_name']); ?></span> 👋</h2>
            <p class="welcome-subtitle">Here is a summary of TravelAdvisor activities today</p>
        </div>
        <div class="welcome-date">
            <div class="date-day"><?= date('l, d F Y') ?></div>
            <div class="date-time"><?= date('H:i') ?> WIB</div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <!-- Total Paket Wisata -->
    <div class="col-md-6 col-xl-3">
        <div class="stat-card stat-card-tours">
            <div class="stat-card-inner">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="stat-card-trend">
                        <i class="fas fa-globe"></i>
                    </div>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-label">Tour Packages</div>
                    <div class="stat-card-value"><?= Formatter::currency($data['stats']['total_tours']); ?></div>
                    <div class="stat-card-footer">
                        <span class="stat-card-change">
                            <i class="fas fa-box"></i>
                            Packages available
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Premium Styles -->
<style>
/* Welcome Section */
.dashboard-welcome {
    background: linear-gradient(135deg);
    color: white;
    padding: 2rem 2.5rem;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.25);
    margin-bottom: 2rem;
}

.welcome-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    letter-spacing: -0.5px;
}

.text-gradient {
    background: linear-gradient(135deg, #fef08a 0%, #fde047 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.welcome-subtitle {
    font-size: 0.95rem;
    opacity: 0.9;
    margin: 0;
}

.welcome-date {
    text-align: right;
}

.date-day {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 0.25rem;
}

.date-time {
    font-size: 1.1rem;
    font-weight: 600;
}

/* Stat Cards Premium */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    overflow: hidden;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.stat-card-inner {
    padding: 1.5rem;
}

.stat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.stat-card-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    background: linear-gradient(135deg, var(--card-color-1), var(--card-color-2));
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.stat-card-trend {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.03);
    color: var(--card-color-1);
    font-size: 0.875rem;
}

.stat-card-body {
    flex: 1;
}

.stat-card-label {
    color: #64748b;
    font-size: 0.8125rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-card-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.stat-card-footer {
    display: flex;
    align-items: center;
}

.stat-card-change {
    font-size: 0.75rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-weight: 500;
}

.stat-card-tours {
    --card-color-1: #8b5cf6;
    --card-color-2: #a78bfa;
}

/* Responsive */
@media (max-width: 1200px) {
    .stat-card-value {
        font-size: 1.25rem;
    }
}

@media (max-width: 768px) {
    .dashboard-welcome {
        padding: 1.5rem;
    }
    
    .welcome-title {
        font-size: 1.5rem;
    }
    
    .stat-card-value {
        font-size: 1.125rem;
    }
}
</style>
