<?php
/**
 * Navbar Profile Component - Modular Component
 * Used to display profile dropdown in admin navbar
 */
$user_name = $_SESSION['user_name'] ?? 'Admin';
$user_email = $_SESSION['user_email'] ?? '';
$user_id = $_SESSION['user_id'] ?? 0;
$user_initial = strtoupper(substr($user_name, 0, 1));
?>
<div class="navbar-user">
    <div class="user-info" id="userDropdownToggle">
        <div class="user-avatar">
            <?= $user_initial; ?>
        </div>
        <div class="user-details">
            <div class="user-name"><?= htmlspecialchars($user_name); ?></div>
            <div class="user-role">Administrator</div>
        </div>
        <i class="fa-solid fa-chevron-down user-dropdown-icon"></i>
    </div>
    <div class="user-dropdown" id="userDropdown">
        <div class="dropdown-header">
            <div class="dropdown-avatar">
                <?= $user_initial; ?>
            </div>
            <div class="dropdown-user-info">
                <div class="dropdown-header-name"><?= htmlspecialchars($user_name); ?></div>
                <div class="dropdown-header-email"><?= htmlspecialchars($user_email); ?></div>
                <div class="dropdown-header-role">Administrator</div>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <a href="<?= BASEURL; ?>/admin/profile" class="dropdown-item">
            <i class="fa-solid fa-user"></i>
            <span>My Profile</span>
        </a>
        <a href="<?= BASEURL; ?>/auth/logout" class="dropdown-item logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>
</div>

<style>
/* Navbar User Profile Styles - Modular */
.navbar-user {
    position: relative;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 16px 8px 12px;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: 12px;
    color: white;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.3);
}

.user-info:hover {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.4);
    transform: translateY(-1px);
}

.user-info.active {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
}

.user-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.4);
    flex-shrink: 0;
    position: relative;
}

.user-avatar::after {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 50%;
    padding: 2px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.user-info:hover .user-avatar::after {
    opacity: 1;
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
}

.user-name {
    font-weight: 600;
    font-size: 0.9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-role {
    font-size: 0.75rem;
    opacity: 0.8;
    color: #94a3b8;
}

.user-dropdown-icon {
    color: #94a3b8;
    font-size: 0.75rem;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
    margin-left: 4px;
}

.user-info.active .user-dropdown-icon {
    transform: rotate(180deg);
}

.user-dropdown {
    position: absolute;
    top: calc(100% + 12px);
    right: 0;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
    min-width: 280px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px) scale(0.95);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    overflow: hidden;
}

.user-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown-header {
    padding: 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    display: flex;
    align-items: center;
    gap: 14px;
    border-bottom: 1px solid #e2e8f0;
}

.dropdown-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    flex-shrink: 0;
}

.dropdown-user-info {
    flex: 1;
    min-width: 0;
}

.dropdown-header-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 0.95rem;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-header-email {
    font-size: 0.8125rem;
    color: #64748b;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-header-role {
    font-size: 0.75rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

.dropdown-divider {
    height: 1px;
    background: #e2e8f0;
    margin: 8px 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: #475569;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.9rem;
    font-weight: 500;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    position: relative;
}

.dropdown-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: #6366f1;
    transform: scaleY(0);
    transition: transform 0.2s ease;
}

.dropdown-item:hover {
    background: #f8fafc;
    color: #1e293b;
    padding-left: 24px;
}

.dropdown-item:hover::before {
    transform: scaleY(1);
}

.dropdown-item i {
    width: 20px;
    font-size: 0.9rem;
    text-align: center;
    color: #64748b;
    transition: color 0.2s ease;
}

.dropdown-item:hover i {
    color: #6366f1;
}

.dropdown-item.logout {
    color: #ef4444;
    border-top: 1px solid #e2e8f0;
    margin-top: 4px;
}

.dropdown-item.logout:hover {
    background: #fef2f2;
    color: #dc2626;
    padding-left: 24px;
}

.dropdown-item.logout i {
    color: #ef4444;
}

.dropdown-item.logout:hover i {
    color: #dc2626;
}

/* Responsive */
@media (max-width: 768px) {
    .user-details {
        display: none;
    }
    
    .user-info {
        padding: 8px 12px;
    }
    
    .user-dropdown {
        min-width: 240px;
        right: -10px;
    }
}
</style>

<script>
// Dropdown toggle functionality - Modular
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.getElementById('userDropdownToggle');
        const dropdown = document.getElementById('userDropdown');

        if (dropdownToggle && dropdown) {
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('show');
                dropdownToggle.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                    dropdownToggle.classList.remove('active');
                }
            });

            // Close dropdown when clicking on dropdown items
            const dropdownItems = dropdown.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    setTimeout(() => {
                        dropdown.classList.remove('show');
                        dropdownToggle.classList.remove('active');
                    }, 100);
                });
            });
        }
    });
})();
</script>

