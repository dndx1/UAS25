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
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 30%, #F4A460 70%, #DEB887 100%);
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
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="batik" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M10 5 L15 10 L10 15 L5 10 Z" fill="none" stroke="rgba(139,69,19,0.1)" stroke-width="0.5"/><circle cx="10" cy="10" r="2" fill="rgba(210,105,30,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23batik)"/></svg>');
        opacity: 0.6;
    }
    
    .login-card {
        background: rgba(255, 248, 238, 0.95);
        backdrop-filter: blur(20px);
        border: 2px solid rgba(139, 69, 19, 0.2);
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(139, 69, 19, 0.25);
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
        height: 6px;
        background: linear-gradient(90deg, #8B4513, #D2691E, #CD853F, #DEB887);
        background-size: 300% 100%;
        animation: batikFlow 4s ease infinite;
    }
    
    @keyframes batikFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .blangkon-logo {
        width: 100px;
        height: 100px;
        margin: 0 auto 1rem;
        position: relative;
        display: inline-block;
    }
    
    .blangkon-svg {
        width: 100%;
        height: 100%;
        filter: drop-shadow(0 10px 30px rgba(139, 69, 19, 0.3));
        transition: transform 0.3s ease;
    }
    
    .blangkon-svg:hover {
        transform: scale(1.05) rotate(5deg);
    }
    
    .brand-title {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #8B4513, #D2691E);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-top: 1rem;
        letter-spacing: -0.5px;
        font-family: 'Georgia', serif;
    }
    
    .subtitle {
        font-size: 0.9rem;
        color: #8B4513;
        font-style: italic;
        margin-top: 0.5rem;
        font-family: 'Georgia', serif;
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .login-header h2 {
        color: #8B4513;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
        font-family: 'Georgia', serif;
    }
    
    .login-header p {
        color: #A0522D;
        font-size: 0.95rem;
        margin: 0;
    }
    
    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating .form-control {
        border: 2px solid #DEB887;
        border-radius: 15px;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #FFF8DC;
        color: #8B4513;
    }
    
    .form-floating .form-control:focus {
        border-color: #D2691E;
        box-shadow: 0 0 0 0.3rem rgba(210, 105, 30, 0.15);
        background: #FFFAF0;
        transform: translateY(-2px);
    }
    
    .form-floating .form-control::placeholder {
        color: #CD853F;
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #CD853F;
        font-size: 1.1rem;
        z-index: 10;
        transition: color 0.3s ease;
    }
    
    .form-floating .form-control:focus + .input-icon {
        color: #D2691E;
    }
    
    .btn-login {
        background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #CD853F 100%);
        border: none;
        border-radius: 15px;
        padding: 0.875rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        margin-top: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }
    
    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
    }
    
    .btn-login:hover::before {
        left: 100%;
    }
    
    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(139, 69, 19, 0.4);
        background: linear-gradient(135deg, #A0522D 0%, #D2691E 50%, #DEB887 100%);
    }
    
    .alert-modern {
        border: none;
        border-radius: 15px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #CD5C5C, #B22222);
        color: white;
        border-left: 4px solid rgba(255, 255, 255, 0.3);
        animation: slideIn 0.4s ease;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .footer-credits {
        text-align: center;
        margin-top: 2rem;
        color: rgba(139, 69, 19, 0.8);
        font-size: 0.85rem;
    }
    
    .footer-credits a {
        color: rgba(139, 69, 19, 0.9);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .footer-credits a:hover {
        color: #8B4513;
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
        background: rgba(139, 69, 19, 0.1);
        animation: float 8s ease-in-out infinite;
    }
    
    .shape:nth-child(1) {
        width: 120px;
        height: 120px;
        top: 15%;
        left: 8%;
        animation-delay: -1s;
        background: rgba(210, 105, 30, 0.08);
    }
    
    .shape:nth-child(2) {
        width: 80px;
        height: 80px;
        top: 65%;
        right: 12%;
        animation-delay: -3s;
        background: rgba(222, 184, 135, 0.12);
    }
    
    .shape:nth-child(3) {
        width: 100px;
        height: 100px;
        bottom: 25%;
        left: 15%;
        animation-delay: -2s;
        background: rgba(205, 133, 63, 0.1);
    }
    
    .shape:nth-child(4) {
        width: 60px;
        height: 60px;
        top: 40%;
        right: 25%;
        animation-delay: -4s;
        background: rgba(160, 82, 45, 0.08);
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-25px) rotate(120deg);
        }
        66% {
            transform: translateY(-10px) rotate(240deg);
        }
    }
    
    .batik-decoration {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        opacity: 0.1;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50 10 Q70 30 50 50 Q30 30 50 10 Z M50 50 Q70 70 50 90 Q30 70 50 50 Z" fill="%238B4513"/></svg>');
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    @media (max-width: 768px) {
        .login-card {
            margin: 1rem;
            border-radius: 20px;
        }
        
        .brand-title {
            font-size: 1.6rem;
        }
        
        .login-header h2 {
            font-size: 1.5rem;
        }
        
        .blangkon-logo {
            width: 80px;
            height: 80px;
        }
    }
</style>

<section class="login-container d-flex align-items-center justify-content-center">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <div class="login-card p-5">
                    <div class="batik-decoration"></div>
                    
                    <!-- Logo Section with Blangkon -->
                    <div class="logo-container">
                        <div class="blangkon-logo">
                            <svg class="blangkon-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <!-- Blangkon Shape -->
                                <defs>
                                    <radialGradient id="blangkonGrad" cx="50%" cy="30%" r="70%">
                                        <stop offset="0%" style="stop-color:#DEB887;stop-opacity:1" />
                                        <stop offset="50%" style="stop-color:#D2691E;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#8B4513;stop-opacity:1" />
                                    </radialGradient>
                                    <radialGradient id="mondol" cx="50%" cy="50%" r="40%">
                                        <stop offset="0%" style="stop-color:#CD853F;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#A0522D;stop-opacity:1" />
                                    </radialGradient>
                                </defs>
                                
                                <!-- Main Blangkon Body -->
                                <path d="M15 45 Q15 25 50 25 Q85 25 85 45 Q85 65 70 70 L65 80 Q50 85 35 80 L30 70 Q15 65 15 45 Z" 
                                      fill="url(#blangkonGrad)" stroke="#8B4513" stroke-width="1"/>
                                
                                <!-- Mondol (decorative knot) -->
                                <circle cx="75" cy="45" r="8" fill="url(#mondol)" stroke="#8B4513" stroke-width="0.5"/>
                                <circle cx="75" cy="45" r="4" fill="#DEB887"/>
                                
                                <!-- Batik Pattern -->
                                <path d="M25 35 Q30 30 35 35 Q30 40 25 35" fill="none" stroke="#8B4513" stroke-width="0.8" opacity="0.6"/>
                                <path d="M45 30 Q50 25 55 30 Q50 35 45 30" fill="none" stroke="#8B4513" stroke-width="0.8" opacity="0.6"/>
                                <path d="M35 50 Q40 45 45 50 Q40 55 35 50" fill="none" stroke="#8B4513" stroke-width="0.8" opacity="0.6"/>
                                
                                <!-- Traditional dots -->
                                <circle cx="40" cy="40" r="1.5" fill="#8B4513" opacity="0.7"/>
                                <circle cx="60" cy="35" r="1.5" fill="#8B4513" opacity="0.7"/>
                                <circle cx="45" cy="55" r="1.5" fill="#8B4513" opacity="0.7"/>
                            </svg>
                        </div>
                        <h1 class="brand-title">Blangkis</h1>
                        <p class="subtitle">Balkon Pukis - Sistem Tradisional</p>
                    </div>

                    <!-- Login Header -->
                    <div class="login-header">
                        <h2>Sugeng Rawuh!</h2>
                        <p>Monggo dipun lebeti kangge ngakses sistem</p>
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
                                Mangga dipun isi jeneng pangguna ingkang sah.
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating">
                            <?= form_password($password) ?>
                            <i class="fas fa-lock input-icon"></i>
                            <div class="invalid-feedback">
                                Mangga dipun isi tembung wadi.
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <?= form_submit('submit', 'Mlebet Sistem', ['class' => 'btn btn-login']) ?>
                        </div>

                    <?= form_close() ?>
                </div>

                <!-- Footer Credits -->
                <div class="footer-credits">
                    Dipun damel kanthi ❤️ dening <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
                    <br><small>Tema Blangkon - Budaya Jawa</small>
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
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Nglebeti...';
            submitBtn.disabled = true;
        }
    });
    
    // Add cultural greeting based on time
    const currentHour = new Date().getHours();
    const headerTitle = document.querySelector('.login-header h2');
    
    if (currentHour < 10) {
        headerTitle.textContent = 'Sugeng Enjing!';
    } else if (currentHour < 15) {
        headerTitle.textContent = 'Sugeng Siang!';
    } else if (currentHour < 18) {
        headerTitle.textContent = 'Sugeng Sonten!';
    } else {
        headerTitle.textContent = 'Sugeng Dalu!';
    }
});
</script>

<?= $this->endSection() ?>