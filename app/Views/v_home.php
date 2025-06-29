<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
/* Traditional Blangkon E-commerce Styles */
.hero-section {
    background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #CD853F 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
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
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    animation: slideInDown 1s ease-out;
    color: #FFD700;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 2rem;
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

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .product-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}
</style>

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
            <div class="hero-stats mt-4">
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
                            <i class="fas fa-eye me-2"></i>Quick View
                        </button>
                    </div>
                </div>
                
                <div class="product-info">
                    <h3 class="product-name"><?php echo $item['nama'] ?></h3>
                    <div class="product-price"><?php echo number_to_currency($item['harga'], 'IDR') ?></div>
                    <button type="submit" class="buy-btn">
                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
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
        <h5 class="modal-title" id="quickViewLabel">Product Details</h5>
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
        <h2 class="section-title">Why Choose Us?</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4>Fast Delivery</h4>
                    <p>Lightning-fast shipping to your doorstep with real-time tracking</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Secure Payment</h4>
                    <p>Your transactions are protected with bank-level security</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Round-the-clock customer service for all your needs</p>
                </div>
            </div>
        </div>
    </div>
    
</section>

<script>
// Add some interactive effects
document.addEventListener('DOMContentLoaded', function() {
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
document.querySelectorAll('.quick-view-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('quickViewName').textContent = this.dataset.nama;
        document.getElementById('quickViewPrice').textContent = this.dataset.harga;
        document.getElementById('quickViewImage').src = this.dataset.foto;
    });
});

</script>

<?= $this->endSection() ?>