<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    .search-results-container {
        min-height: 100vh;
        padding: 2rem 0;
        position: relative;
    }
    
    .search-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 2px solid rgba(212, 175, 55, 0.3);
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
        background: linear-gradient(90deg, #d4af37, #b8860b, #daa520, #cd853f);
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
        background: linear-gradient(135deg, #d4af37, #b8860b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .search-title i {
        background: linear-gradient(135deg, #d4af37, #b8860b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.5rem;
    }
    
    .search-keyword {
        color: #d4af37;
        font-weight: 600;
        text-decoration: underline;
        text-decoration-color: rgba(212, 175, 55, 0.5);
        text-underline-offset: 4px;
    }
    
    .results-count {
        color: #6d4c41;
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
        border: 2px solid rgba(212, 175, 55, 0.2);
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
        border-color: rgba(212, 175, 55, 0.6);
    }
    
    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent, rgba(212, 175, 55, 0.1));
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
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #2c1810;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
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
        background: linear-gradient(135deg, #d4af37, #b8860b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
    }
    
    .btn-detail {
        background: linear-gradient(135deg, #8d6e63 0%, #5d4037 100%);
        border: 2px solid #d4af37;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        color: #d4af37;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .btn-detail::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(212,175,55,0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-detail:hover::before {
        left: 100%;
    }
    
    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #2c1810;
        border-color: #d4af37;
    }
    
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(62, 39, 35, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(212, 175, 55, 0.3);
        margin-top: 2rem;
        position: relative;
        z-index: 1;
    }
    
    .no-results-icon {
        font-size: 4rem;
        color: #8d6e63;
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
        color: #d7ccc8;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .no-results p {
        color: #a1887f;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
    
    .no-results strong {
        color: #d4af37;
    }
    
    .btn-back-search {
        background: linear-gradient(135deg, #8d6e63, #5d4037);
        border: 2px solid #d4af37;
        border-radius: 50px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #d4af37;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-back-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        background: linear-gradient(135deg, #d4af37, #b8860b);
        color: #2c1810;
        text-decoration: none;
        border-color: #d4af37;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 80px; /* Space for navbar */
        width: 100%;
        height: calc(100% - 80px);
        background-color: rgba(0,0,0,0.8);
        backdrop-filter: blur(5px);
    }

    .modal-content {
        background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(250,250,250,0.95));
        backdrop-filter: blur(20px);
        margin: 3% auto;
        padding: 25px;
        border-radius: 20px;
        width: 85%;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        border: 2px solid rgba(212, 175, 55, 0.3);
        position: relative;
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #d4af37, #b8860b, #daa520);
        border-radius: 20px 20px 0 0;
    }

    .close {
        color: #8d6e63;
        float: right;
        font-size: 32px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(212, 175, 55, 0.1);
        margin: -10px -10px 10px 0;
    }

    .close:hover {
        color: #d4af37;
        background: rgba(212, 175, 55, 0.2);
        transform: rotate(90deg) scale(1.1);
    }

    .modal-content img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .modal-content img:hover {
        transform: scale(1.02);
    }

    .modal-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        background: linear-gradient(135deg, #d4af37, #b8860b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .modal-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #8d6e63;
        margin-top: 10px;
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
        background: rgba(212, 175, 55, 0.1);
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

        .modal-content {
            width: 95%;
            margin: 10% auto;
            padding: 20px;
        }

        .modal-content img {
            height: 250px;
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

        .modal {
            top: 60px;
            height: calc(100% - 60px);
        }

        .modal-content {
            width: 98%;
            margin: 5% auto;
            padding: 15px;
        }

        .modal-content img {
            height: 200px;
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
                                    <button onclick="showImageDetail('<?= base_url('img/' . $p['foto']) ?>', '<?= esc($p['nama']) ?>', '<?= number_format($p['harga'], 0, ',', '.') ?>')" class="btn-detail">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </button>
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

<!-- Image Detail Modal -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="modalImage" src="" alt="">
        <h4 id="modalTitle" class="modal-title"></h4>
        <div id="modalPrice" class="modal-price"></div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
function showImageDetail(imageSrc, productName, productPrice) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = productName;
    document.getElementById('modalPrice').textContent = 'Rp' + productPrice;
    document.getElementById('imageModal').style.display = 'block';
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

// Close modal function
function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('DOMContentLoaded', function() {
    // Close button event
    document.querySelector('.close').onclick = closeModal;
    
    // Click outside modal to close
    window.onclick = function(event) {
        const modal = document.getElementById('imageModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    
    // ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
    
    // Add loading animation to detail buttons
    const detailButtons = document.querySelectorAll('.btn-detail');
    
    detailButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            
            // Reset after a short delay
            setTimeout(() => {
                this.innerHTML = originalContent;
            }, 800);
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
    
    // Add hover effects
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.willChange = 'transform';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.willChange = 'auto';
        });
    });
});
</script>

<?= $this->endSection() ?>