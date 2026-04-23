<?php
require_once __DIR__ . '/../../helpers/Formatter.php';
?>

<div class="profile-container">
    <!-- Success/Error Messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success-custom">
            <i class="fas fa-check-circle"></i>
            <?php if ($_GET['success'] == 1): ?>
                Profile updated successfully!
            <?php elseif ($_GET['success'] == 2): ?>
                Password changed successfully!
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error-custom">
            <i class="fas fa-exclamation-circle"></i>
            <?php if ($_GET['error'] == 1): ?>
                Failed to update profile. Please try again.
            <?php elseif ($_GET['error'] == 2): ?>
                Current password is incorrect!
            <?php elseif ($_GET['error'] == 3): ?>
                Failed to change password. Please try again.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-header-content">
            <div class="profile-avatar-large">
                <?= strtoupper(substr($data['user']['name'] ?? 'A', 0, 1)); ?>
            </div>
            <div class="profile-header-info">
                <h1 class="profile-name"><?= htmlspecialchars($data['user']['name'] ?? 'Admin'); ?></h1>
                <p class="profile-email"><?= htmlspecialchars($data['user']['email'] ?? ''); ?></p>
                <span class="profile-badge">
                    <i class="fas fa-shield-alt"></i>
                    Administrator
                </span>
            </div>
        </div>
        <div class="profile-header-actions">
            <a href="<?= BASEURL; ?>/admin" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="row g-4">
        <!-- Profile Information Card -->
        <div class="col-lg-8">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="profile-card-title">
                        <i class="fas fa-user"></i>
                        Profile Information
                    </h3>
                    <p class="profile-card-subtitle">Manage your account information</p>
                </div>
                <div class="profile-card-body">
                    <form id="profileForm" method="POST" action="<?= BASEURL; ?>/admin/updateProfile">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i>
                                Full Name
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   value="<?= htmlspecialchars($data['user']['name'] ?? ''); ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email
                            </label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="<?= htmlspecialchars($data['user']['email'] ?? ''); ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-calendar"></i>
                                Date Joined
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   value="<?= isset($data['user']['created_at']) ? Formatter::date($data['user']['created_at'], 'd F Y') : 'N/A'; ?>"
                                   disabled>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i>
                                Save Changes
                            </button>
                            <button type="button" class="btn-cancel" onclick="resetForm()">
                                <i class="fas fa-times"></i>
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Card -->
        <div class="col-lg-4">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="profile-card-title">
                        <i class="fas fa-lock"></i>
                        Security
                    </h3>
                    <p class="profile-card-subtitle">Change password</p>
                </div>
                <div class="profile-card-body">
                    <form id="passwordForm" method="POST" action="<?= BASEURL; ?>/admin/updatePassword">
                        <div class="form-group">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-key"></i>
                                Current Password
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="current_password" 
                                   name="current_password"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="form-label">
                                <i class="fas fa-lock"></i>
                                New Password
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password" 
                                   name="new_password"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Confirm Password
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="confirm_password" 
                                   name="confirm_password"
                                   required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-key"></i>
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Profile Header */
.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.25);
    color: white;
}

.profile-header-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.profile-avatar-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 2.5rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    border: 3px solid rgba(255, 255, 255, 0.3);
    flex-shrink: 0;
}

.profile-header-info {
    flex: 1;
}

.profile-name {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    letter-spacing: -0.5px;
}

.profile-email {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0.75rem;
}

.profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.profile-header-actions {
    display: flex;
    gap: 1rem;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: translateX(-3px);
}

/* Profile Cards */
.profile-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(0, 0, 0, 0.05);
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.profile-card-header {
    padding: 1.75rem;
    border-bottom: 1px solid #e2e8f0;
    background: #fafbfc;
}

.profile-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.profile-card-title i {
    color: #6366f1;
    font-size: 1.1rem;
}

.profile-card-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
}

.profile-card-body {
    padding: 1.75rem;
    flex: 1;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.form-label i {
    color: #6366f1;
    font-size: 0.875rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.form-control:disabled {
    background: #f9fafb;
    color: #6b7280;
    cursor: not-allowed;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.btn-save {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-cancel:hover {
    background: #e2e8f0;
    color: #1e293b;
}

/* Alert Messages */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-success-custom {
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #10b981;
}

.alert-success-custom i {
    color: #10b981;
}

.alert-error-custom {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #ef4444;
}

.alert-error-custom i {
    color: #ef4444;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-header {
        padding: 1.5rem;
    }
    
    .profile-header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-name {
        font-size: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-save,
    .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function resetForm() {
    document.getElementById('profileForm').reset();
    // Reload page to get original values
    window.location.reload();
}

// Form validation
document.getElementById('passwordForm')?.addEventListener('submit', function(e) {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('New password and confirm password do not match!');
        return false;
    }
    
    if (newPassword.length < 6) {
        e.preventDefault();
        alert('Password must be at least 6 characters!');
        return false;
    }
});
</script>

