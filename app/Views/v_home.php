<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
/* Remove gap for home page only */
.navbar-spacer {
    display: none;
}

/* Traditional Blangkon E-commerce Styles */
.hero-section {
    background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #CD853F 100%);
    color: white;
    padding: 6rem 0; /* Increased padding for more height */
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    margin-top: 0; /* Remove negative margin */
    min-height: 70vh; /* Ensure minimum height */
    display: flex;
    align-items: center; /* Center content vertically */
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23FFD700" stop-opacity="0.2"/><stop offset="100%" stop-color="%23FFD700" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="300" r="100" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 100%;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    animation: slideInDown 1s ease-out;
    color: #FFD700;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 3rem; /* Increased margin for better spacing */
    opacity: 0.95;
    animation: slideInUp 1s ease-out 0.3s both;
    color: #F5DEB3;
}

@keyframes slideInDown {
    from { opacity: 0; transform: translateY(-50px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 2rem 0;
}

.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(139, 69, 19, 0.15);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    border: 2px solid transparent;
}

.product-card:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow: 0 25px 50px rgba(139, 69, 19, 0.25);
    border-color: #DAA520;
}

.product-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(139, 69, 19, 0.85), rgba(218, 165, 32, 0.85));
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.quick-view-btn {
    background: white;
    color: #8B4513;
    border: 2px solid #DAA520;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.quick-view-btn:hover {
    background: #DAA520;
    color: white;
}

.product-card:hover .quick-view-btn {
    transform: translateY(0);
}

.product-info {
    padding: 1.5rem;
    text-align: center;
}

.product-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.product-price {
    font-size: 1.5rem;
    font-weight: 600;
    color: #8B4513;
    margin-bottom: 1rem;
}

.buy-btn {
    background: linear-gradient(135deg, #8B4513 0%, #DAA520 50%, #CD853F 100%);
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.buy-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,215,0,0.3), transparent);
    transition: left 0.5s ease;
}

.buy-btn:hover::before {
    left: 100%;
}

.buy-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(139, 69, 19, 0.4);
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 3rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #8B4513 0%, #DAA520 100%);
    border-radius: 2px;
}

.success-alert {
    background: linear-gradient(135deg, #228B22 0%, #32CD32 100%);
    border: none;
    border-radius: 15px;
    color: white;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    animation: slideInDown 0.5s ease-out;
}

.features-section {
    background: linear-gradient(135deg, #F5DEB3 0%, #DEB887 100%);
    padding: 4rem 0;
    margin-top: 4rem;
}

.feature-card {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
    transition: all 0.3s ease;
    margin-bottom: 2rem;
    border: 2px solid transparent;
}

.feature-card:hover {
    transform: translateY(-5px);
    border-color: #DAA520;
    box-shadow: 0 10px 25px rgba(139, 69, 19, 0.2);
}

.feature-icon {
    font-size: 3rem;
    color: #8B4513;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.feature-card:hover .feature-icon {
    color: #DAA520;
}

.hero-stats h3 {
    color: #FFD700;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
}

.hero-stats p {
    color: #F5DEB3;
}

.hero-stats {
    margin-top: 2rem; /* Add more spacing from subtitle */
}

/* Modal styling updates */
.modal-content {
    border: 2px solid #DAA520;
    border-radius: 20px;
}

.modal-title {
    color: #8B4513;
    font-weight: 700;
}

#quickViewPrice {
    color: #8B4513 !important;
}

/* ============= CART NOTIFICATION STYLES ============= */
/* Notification Container */
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
    width: 100%;
}

/* Blangkon themed notification */
.blangkon-notification {
    background: linear-gradient(135deg, #8B4513 0%, #DAA520 50%, #CD853F 100%);
    border: none;
    border-radius: 15px;
    color: white;
    padding: 0;
    margin-bottom: 15px;
    box-shadow: 0 15px 35px rgba(139, 69, 19, 0.4);
    animation: slideInRight 0.5s ease-out;
    overflow: hidden;
    position: relative;
}

.blangkon-notification::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, 
        rgba(255,215,0,0.15) 0%, 
        transparent 50%, 
        rgba(255,215,0,0.15) 100%);
    animation: shimmer 2s infinite;
}

.notification-content {
    padding: 20px;
    position: relative;
    z-index: 2;
}

.notification-header {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.notification-icon {
    background: rgba(255,215,0,0.2);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 20px;
    color: #FFD700;
    animation: pulse 2s infinite;
}

.notification-title {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    color: #FFD700;
}

.notification-message {
    font-size: 14px;
    line-height: 1.4;
    opacity: 0.95;
    margin-bottom: 15px;
    color: #F5DEB3;
}

.notification-actions {
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: space-between;
}

.btn-cart {
    background: rgba(255,215,0,0.9);
    color: #8B4513;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-shadow: none;
}

.btn-cart:hover {
    background: #FFD700;
    color: #8B4513;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-close-notification {
    background: none;
    border: none;
    color: #F5DEB3;
    font-size: 18px;
    cursor: pointer;
    opacity: 0.8;
    transition: opacity 0.3s ease;
    padding: 5px;
}

.btn-close-notification:hover {
    opacity: 1;
    color: white;
}

/* Auto-hide progress bar */
.progress-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: rgba(255,215,0,0.6);
    border-radius: 0 0 15px 15px;
    animation: progress 6s linear forwards;
}

/* Notification Animations */
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(400px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideOutRight {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(400px);
    }
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes progress {
    from { width: 100%; }
    to { width: 0%; }
}

/* Hidden class for exit animation */
.notification-hidden {
    animation: slideOutRight 0.5s ease-out forwards;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-section {
        min-height: 60vh; /* Adjust height for mobile */
        padding: 4rem 0; /* Reduce padding on mobile */
    }
    
    .product-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    /* Mobile notification adjustments */
    .notification-container {
        left: 20px;
        right: 20px;
        max-width: none;
    }
    
    .blangkon-notification {
        margin-bottom: 10px;
    }
    
    .notification-content {
        padding: 15px;
    }
    
    .notification-header {
        margin-bottom: 10px;
    }
    
    .notification-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .notification-title {
        font-size: 16px;
    }
    
    .notification-message {
        font-size: 13px;
    }
}
</style>

<!-- Notification Container -->
<div class="notification-container" id="notificationContainer">
    <!-- Notifications will be dynamically added here -->
</div>

<?php if (session()->getFlashData('success')) { ?>
    <div class="success-alert alert alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Blangkis - Blangkon Pakis</h1>
            <p class="hero-subtitle">Produk Lokal Kualitas Premium</p>
            <div class="hero-stats">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h3 class="fw-bold"><?= count($product) ?>+</h3>
                        <p>Premium Produk</p>
                    </div>
                    <div class="col-md-4">
                        <h3 class="fw-bold">24/7</h3>
                        <p>Dukungan Pelanggan</p>
                    </div>
                    <div class="col-md-4">
                        <h3 class="fw-bold">100%</h3>
                        <p>Jaminan Kepuasan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<div class="container">
    <h2 class="section-title">Produk Unggulan</h2>
    
    <div class="product-grid">
        <?php foreach ($product as $key => $item) : ?>
            <div class="product-card">
                <?= form_open('keranjang') ?>
                <?php
                echo form_hidden('id', $item['id']);
                echo form_hidden('nama', $item['nama']);
                echo form_hidden('harga', $item['harga']);
                echo form_hidden('foto', $item['foto']);
                ?>
                
                <div class="product-image">
                    <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" alt="<?php echo $item['nama'] ?>">
                    <div class="product-overlay">
                       <button type="button" class="quick-view-btn mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#quickViewModal"
                    data-nama="<?= esc($item['nama']) ?>"
                    data-harga="<?= number_to_currency($item['harga'], 'IDR') ?>"
                    data-foto="<?= base_url("img/" . $item['foto']) ?>"
                >
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
                
                <div class="product-info">
                    <h3 class="product-name"><?php echo $item['nama'] ?></h3>
                    <div class="product-price"><?php echo number_to_currency($item['harga'], 'IDR') ?></div>
                    <button type="submit" class="buy-btn" onclick="handleAddToCart(event, '<?= esc($item['nama']) ?>')">
                        <i class="fas fa-shopping-cart me-2"></i>Masukkan Keranjang
                    </button>
                </div>
                
                <?= form_close() ?>
            </div>
        <?php endforeach ?>
    </div>
</div>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="quickViewLabel">Detail Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column flex-md-row align-items-center gap-4">
        <img id="quickViewImage" src="" alt="Product Image" class="img-fluid rounded" style="max-width: 300px;">
        <div>
          <h3 id="quickViewName"></h3>
          <p id="quickViewPrice" class="fw-bold text-primary fs-4 mb-3"></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <h2 class="section-title">Kenapa Pilih Kami?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4>Pengiriman Cepat</h4>
                    <p>Pengiriman dipastikan utama dalam proses pembelian</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Keamanan Transaksi</h4>
                    <p>Transaksi dijamin dengan tenang dan aman</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Selalu ada untuk membantu pelanggan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// ============= CART NOTIFICATION FUNCTIONS =============
function showBlangkonNotification(productName = 'Blangkon') {
    const container = document.getElementById('notificationContainer');
    
    const notification = document.createElement('div');
    notification.className = 'blangkon-notification';
    notification.innerHTML = `
        <div class="notification-content">
            <div class="notification-header">
                <div class="notification-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4 class="notification-title">Berhasil Ditambahkan!</h4>
            </div>
            <div class="notification-message">
                ${productName} telah berhasil ditambahkan ke keranjang belanja Anda.
            </div>
            <div class="notification-actions">
                <a href="<?= base_url('keranjang') ?>" class="btn-cart">
                    <i class="fas fa-shopping-cart"></i> Lihat Keranjang
                </a>
                <button class="btn-close-notification" onclick="closeNotification(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="progress-bar"></div>
        </div>
    `;
    
    container.appendChild(notification);
    
    // Auto-hide after 6 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            closeNotification(notification.querySelector('.btn-close-notification'));
        }
    }, 6000);
}

function closeNotification(button) {
    const notification = button.closest('.blangkon-notification');
    if (notification) {
        notification.classList.add('notification-hidden');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 500);
    }
}

function handleAddToCart(event, productName) {
    // Let the form submit normally first
    setTimeout(() => {
        showBlangkonNotification(productName);
    }, 100);
}

// ============= EXISTING INTERACTIVE EFFECTS =============
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a success flash message and show notification
    <?php if (session()->getFlashData('success')) { ?>
        // Hide the old success alert after showing new notification
        setTimeout(() => {
            const oldAlert = document.querySelector('.success-alert');
            if (oldAlert) {
                oldAlert.style.display = 'none';
            }
            showBlangkonNotification();
        }, 100);
    <?php } ?>
    
    // Animate cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'slideInUp 0.6s ease-out forwards';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.product-card').forEach(card => {
        observer.observe(card);
    });
    
    // Add ripple effect to buy buttons
    document.querySelectorAll('.buy-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255,215,0,0.5);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .buy-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});

// Quick view modal functionality
document.querySelectorAll('.quick-view-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('quickViewName').textContent = this.dataset.nama;
        document.getElementById('quickViewPrice').textContent = this.dataset.harga;
        document.getElementById('quickViewImage').src = this.dataset.foto;
    });
});
</script>

<?= $this->endSection() ?>