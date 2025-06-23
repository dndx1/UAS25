<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control form-control-lg',
    'placeholder' => 'Enter your username',
    'required' => true
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control form-control-lg',
    'placeholder' => 'Enter your password',
    'required' => true
];
?>

<style>
    .login-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }
    
    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 300% 100%;
        animation: gradientShift 3s ease infinite;
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .logo-container img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .logo-container img:hover {
        transform: scale(1.05);
    }
    
    .brand-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-top: 1rem;
        letter-spacing: -0.5px;
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .login-header h2 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
    }
    
    .login-header p {
        color: #7f8c8d;
        font-size: 0.95rem;
        margin: 0;
    }
    
    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating .form-control {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        background: #fff;
        transform: translateY(-2px);
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 1.1rem;
        z-index: 10;
        transition: color 0.3s ease;
    }
    
    .form-floating .form-control:focus + .input-icon {
        color: #667eea;
    }
    
    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        margin-top: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-login:hover::before {
        left: 100%;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }
    
    .alert-modern {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        border-left: 4px solid rgba(255, 255, 255, 0.3);
        animation: slideIn 0.3s ease;
    }
    
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
    
    .footer-credits {
        text-align: center;
        margin-top: 2rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }
    
    .footer-credits a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .footer-credits a:hover {
        color: white;
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: -1s;
    }
    
    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 15%;
        animation-delay: -3s;
    }
    
    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: -2s;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
        }
    }
    
    @media (max-width: 768px) {
        .login-card {
            margin: 1rem;
            border-radius: 15px;
        }
        
        .brand-title {
            font-size: 1.5rem;
        }
        
        .login-header h2 {
            font-size: 1.5rem;
        }
    }
</style>

<section class="login-container d-flex align-items-center justify-content-center">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <div class="login-card p-5">
                    <!-- Logo Section -->
                    <div class="logo-container">
                        <img src="<?php echo base_url() ?>NiceAdmin/assets/img/logo.png" 
                             alt="Logo" 
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iNDAiIGN5PSI0MCIgcj0iNDAiIGZpbGw9InVybCgjZ3JhZGllbnQpIi8+CjxwYXRoIGQ9Ik0yNSAzNUg1NVY0NUgyNVYzNVoiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0zNSAyNUg0NVY1NUgzNVYyNVoiIGZpbGw9IndoaXRlIi8+CjxkZWZzPgo8bGluZWFyR3JhZGllbnQgaWQ9ImdyYWRpZW50IiB4MT0iMCIgeTE9IjAiIHgyPSI4MCIgeTI9IjgwIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiM2NjdlZWEiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjNzY0YmEyIi8+CjwvbGluZWFyR3JhZGllbnQ+CjwvZGVmcz4KPC9zdmc+'" />
                        <h1 class="brand-title">Blangkis - Balkon Pukis</h1>
                    </div>

                    <!-- Login Header -->
                    <div class="login-header">
                        <h2>Welcome Back!</h2>
                        <p>Please sign in to your account to continue</p>
                    </div>

                    <!-- Error Alert -->
                    <?php if (session()->getFlashData('failed')): ?>
                        <div class="alert-modern" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?= session()->getFlashData('failed') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <?= form_open('login', 'class="needs-validation" novalidate') ?>
                        
                        <!-- Username Field -->
                        <div class="form-floating">
                            <?= form_input($username) ?>
                            <i class="fas fa-user input-icon"></i>
                            <div class="invalid-feedback">
                                Please enter a valid username.
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating">
                            <?= form_password($password) ?>
                            <i class="fas fa-lock input-icon"></i>
                            <div class="invalid-feedback">
                                Please enter your password.
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <?= form_submit('submit', 'Sign In', ['class' => 'btn btn-login']) ?>
                        </div>

                    <?= form_close() ?>
                </div>

                <!-- Footer Credits -->
                <div class="footer-credits">
                    Designed with ❤️ by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
// Form Validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Enhanced form interactions
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-control');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check if input has value on load
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Add loading state to submit button
    const submitBtn = document.querySelector('.btn-login');
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function() {
        if (form.checkValidity()) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing In...';
            submitBtn.disabled = true;
        }
    });
});
</script>

<?= $this->endSection() ?>