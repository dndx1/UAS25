<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    .search-results-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        position: relative;
    }
    
    .search-results-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        opacity: 0.5;
    }
    
    .search-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 1;
    }
    
    .search-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 300% 100%;
        animation: gradientShift 3s ease infinite;
        border-radius: 20px 20px 0 0;
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .search-title {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .search-title i {
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.5rem;
    }
    
    .search-keyword {
        color: #e74c3c;
        font-weight: 600;
        text-decoration: underline;
        text-decoration-color: rgba(231, 76, 60, 0.3);
        text-underline-offset: 4px;
    }
    
    .results-count {
        color: #7f8c8d;
        font-size: 1rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .product-grid {
        position: relative;
        z-index: 1;
    }
    
    .product-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent, rgba(102, 126, 234, 0.1));
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 1;
    }
    
    .product-card:hover::before {
        opacity: 1;
    }
    
    .product-image {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
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
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-card:hover .product-overlay {
        opacity: 1;
    }
    
    .price-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        z-index: 2;
    }
    
    .product-body {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }
    
    .product-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .product-price {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-detail:hover::before {
        left: 100%;
    }
    
    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-top: 2rem;
        position: relative;
        z-index: 1;
    }
    
    .no-results-icon {
        font-size: 4rem;
        color: #bdc3c7;
        margin-bottom: 1.5rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    .no-results h3 {
        color: #7f8c8d;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .no-results p {
        color: #95a5a6;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
    
    .btn-back-search {
        background: linear-gradient(135deg, #3498db, #2980b9);
        border: none;
        border-radius: 50px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-back-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .floating-elements {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
        pointer-events: none;
    }
    
    .floating-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: floatMove 8s ease-in-out infinite;
    }
    
    .floating-shape:nth-child(1) {
        width: 100px;
        height: 100px;
        top: 10%;
        left: 5%;
        animation-delay: -1s;
    }
    
    .floating-shape:nth-child(2) {
        width: 150px;
        height: 150px;
        top: 70%;
        right: 10%;
        animation-delay: -3s;
    }
    
    .floating-shape:nth-child(3) {
        width: 80px;
        height: 80px;
        bottom: 10%;
        left: 15%;
        animation-delay: -2s;
    }
    
    @keyframes floatMove {
        0%, 100% {
            transform: translateY(0px) translateX(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-30px) translateX(30px) rotate(120deg);
        }
        66% {
            transform: translateY(30px) translateX(-20px) rotate(240deg);
        }
    }
    
    @media (max-width: 768px) {
        .search-title {
            font-size: 1.5rem;
        }
        
        .product-card {
            margin-bottom: 1.5rem;
        }
        
        .product-image {
            height: 200px;
        }
        
        .search-header {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .search-results-container {
            padding: 1rem 0;
        }
        
        .search-header {
            border-radius: 15px;
            padding: 1rem;
        }
        
        .product-card {
            border-radius: 15px;
        }
    }
</style>

<div class="search-results-container">
    <div class="floating-elements">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>
    
    <div class="container">
        <!-- Search Header -->
        <div class="search-header">
            <div class="search-title">
                <i class="fas fa-search"></i>
                Hasil pencarian untuk: <span class="search-keyword"><?= esc($keyword) ?></span>
            </div>
            <div class="results-count">
                <i class="fas fa-info-circle"></i>
                <?php if (!empty($produk)): ?>
                    Ditemukan <?= count($produk) ?> produk
                <?php else: ?>
                    Tidak ada produk yang ditemukan
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Results -->
        <?php if (!empty($produk)): ?>
            <div class="product-grid">
                <div class="row">
                    <?php foreach ($produk as $p): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="<?= base_url('img/' . $p['foto']) ?>" 
                                         alt="<?= esc($p['nama']) ?>"
                                         />
                                    <div class="product-overlay"></div>
                                    <div class="price-badge">
                                        Rp<?= number_format($p['harga'], 0, ',', '.') ?>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <h5 class="product-title"><?= esc($p['nama']) ?></h5>
                                    <div class="product-price">
                                        Rp<?= number_format($p['harga'], 0, ',', '.') ?>
                                    </div>
                                    <a href="<?= base_url('produk/detail/' . $p['id']) ?>" class="btn-detail">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- No Results -->
            <div class="no-results">
                <div class="no-results-icon">
                    <i class="fas fa-search-minus"></i>
                </div>
                <h3>Produk Tidak Ditemukan</h3>
                <p>Maaf, tidak ada produk yang cocok dengan pencarian "<strong><?= esc($keyword) ?></strong>"</p>
                <p>Silakan coba dengan kata kunci yang berbeda atau lebih spesifik.</p>
                <a href="<?= base_url() ?>" class="btn-back-search">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading animation to detail buttons
    const detailButtons = document.querySelectorAll('.btn-detail');
    
    detailButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            
            // Reset after a short delay in case navigation fails
            setTimeout(() => {
                this.innerHTML = originalContent;
            }, 3000);
        });
    });
    
    // Smooth scroll animation for cards on load
    const cards = document.querySelectorAll('.product-card');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
    
    // Add hover sound effect (optional)
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            // You can add a subtle sound effect here if desired
            this.style.willChange = 'transform';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.willChange = 'auto';
        });
    });
});
</script>

<?= $this->endSection() ?>