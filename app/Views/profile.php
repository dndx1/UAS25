<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <?= session()->getFlashData('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="card profile-card shadow-sm">
                <div class="card-body text-center pt-4">
                    <div class="profile-avatar mb-3">
                        <div class="default-avatar rounded-circle">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </div>
                    
                    <h4 class="profile-name">
                        <?= isset($user['username']) && !empty($user['username']) ? esc($user['username']) : 'Username Belum Diisi' ?>
                    </h4>
                    
                    
                    
                    
                    <div class="profile-stats">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="stat-item">
                                    <h6 class="stat-number">
                                        <?= isset($user['created_at']) ? date('Y', strtotime($user['created_at'])) : 'N/A' ?>
                                    </h6>
                                    <small class="text-muted">Member Since</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <h6 class="stat-number">
                                        <?= isset($user['updated_at']) ? date('M Y', strtotime($user['updated_at'])) : 'Never' ?>
                                    </h6>
                                    <small class="text-muted">Last Update</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="col-xl-8 col-lg-7 col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered mb-4" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" 
                                    data-bs-target="#overview" type="button" role="tab" aria-controls="overview" 
                                    aria-selected="true">
                                <i class="bi bi-person me-2"></i>Overview
                            </button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-tab" data-bs-toggle="tab" 
                                    data-bs-target="#edit-profile" type="button" role="tab" aria-controls="edit-profile" 
                                    aria-selected="false">
                                <i class="bi bi-pencil me-2"></i>Edit Profile
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="password-tab" data-bs-toggle="tab" 
                                    data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" 
                                    aria-selected="false">
                                <i class="bi bi-key me-2"></i>Change Password
                            </button>
                        </li> -->
                    </ul>
                    
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <h5 class="card-title mb-4">
                                <i class="bi bi-info-circle me-2"></i>Profile Details
                            </h5>
                            
                            <div class="profile-details">
                                <div class="detail-row">
                                    <div class="detail-label">
                                        <i class="bi bi-person me-2"></i>Username
                                    </div>
                                    <div class="detail-value">
                                        <?= isset($user['username']) && !empty($user['username']) ? esc($user['username']) : '<span class="text-muted">Belum diisi</span>' ?>
                                    </div>
                                </div>
                                
                                <div class="detail-row">
                                    <div class="detail-label">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </div>
                                    <div class="detail-value">
                                        <?= isset($user['email']) && !empty($user['email']) ? esc($user['email']) : '<span class="text-muted">Belum diisi</span>' ?>
                                    </div>
                                </div>
                                
                               
                                
                                <div class="detail-row">
                                    <div class="detail-label">
                                        <i class="bi bi-calendar-plus me-2"></i>Created At
                                    </div>
                                    <div class="detail-value">
                                        <?= isset($user['created_at']) && !empty($user['created_at']) ? date('d M Y H:i', strtotime($user['created_at'])) : '<span class="text-muted">Belum diisi</span>' ?>
                                    </div>
                                </div>
                                
                                <div class="detail-row">
                                    <div class="detail-label">
                                        <i class="bi bi-calendar-check me-2"></i>Last Updated
                                    </div>
                                    <div class="detail-value">
                                        <?= isset($user['updated_at']) && !empty($user['updated_at']) ? date('d M Y H:i', strtotime($user['updated_at'])) : '<span class="text-muted">Belum diisi</span>' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Profile Tab -->
                        <div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-tab">
                            <h5 class="card-title mb-4">
                                <i class="bi bi-pencil me-2"></i>Edit Profile
                            </h5>
                            
                            <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                
                                <div class="row mb-3">
                                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="username" type="text" class="form-control" id="username" 
                                               value="<?= isset($user['username']) ? esc($user['username']) : '' ?>" required>
                                        <small class="text-muted">Username harus unik dan minimal 3 karakter</small>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email" 
                                               value="<?= isset($user['email']) ? esc($user['email']) : '' ?>" required>
                                        <small class="text-muted">Email harus valid dan unik</small>
                                    </div>
                                </div>
                                
                              
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Save Changes
                                    </button>
                                    <button type="button" class="btn btn-secondary ms-2" onclick="window.location.reload()">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="password-tab">
                            <h5 class="card-title mb-4">
                                <i class="bi bi-key me-2"></i>Change Password
                            </h5>
                            
                            <form action="<?= base_url('profile/changePassword') ?>" method="post">
                                <?= csrf_field(); ?>
                                
                                <div class="row mb-3">
                                    <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="current_password" type="password" class="form-control" id="current_password" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="new_password" type="password" class="form-control" id="new_password" required>
                                        <small class="text-muted">Password minimal 8 karakter</small>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="confirm_password" type="password" class="form-control" id="confirm_password" required>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-key me-2"></i>Change Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-card {
    border: none;
    border-radius: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.profile-avatar {
    position: relative;
    display: inline-block;
}

.profile-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.default-avatar {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 60px;
    color: white;
    border: 4px solid #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.profile-name {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.profile-id {
    font-size: 0.9rem;
}

.profile-status {
    margin-bottom: 1rem;
}

.profile-stats {
    border-top: 1px solid #dee2e6;
    padding-top: 1rem;
}

.stat-item {
    padding: 0.5rem 0;
}

.stat-number {
    font-size: 1.25rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.25rem;
}

.nav-tabs-bordered {
    border-bottom: 2px solid #dee2e6;
}

.nav-tabs-bordered .nav-link {
    border: none;
    border-bottom: 2px solid transparent;
    color: #6c757d;
    font-weight: 500;
    padding: 0.75rem 1rem;
    margin-bottom: -2px;
}

.nav-tabs-bordered .nav-link:hover {
    color: #0d6efd;
    border-bottom-color: #0d6efd;
}

.nav-tabs-bordered .nav-link.active {
    color: #0d6efd;
    border-bottom-color: #0d6efd;
    background: none;
}

.profile-details {
    margin-top: 1rem;
}

.detail-row {
    display: flex;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid #f8f9fa;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    flex: 0 0 200px;
    font-weight: 600;
    color: #495057;
    display: flex;
    align-items: center;
}

.detail-value {
    flex: 1;
    color: #6c757d;
    padding-left: 1rem;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-warning {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    color: #212529;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    color: #212529;
}

@media (max-width: 768px) {
    .detail-row {
        flex-direction: column;
    }
    
    .detail-label {
        flex: none;
        margin-bottom: 0.5rem;
    }
    
    .detail-value {
        padding-left: 0;
    }
}
</style>

<?= $this->endSection() ?>