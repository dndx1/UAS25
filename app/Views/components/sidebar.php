<<!--=======Top Navigation Bar=======-->
<nav class="navbar navbar-expand-lg fixed-top modern-navbar">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="/">
            <span class="brand-text">Blangkis - Blankon Pakis</span>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if (session()->get('role') == 'guest' || !session()->get('isLoggedIn')) { ?>
                    <!-- Menu untuk Customer/Guest -->
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active' : '' ?>" href="/">
                            <i class="bi bi-grid me-1"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'keranjang') ? 'active' : '' ?>" href="/keranjang">
                            <i class="bi bi-cart-check me-1"></i>
                            <span>Keranjang</span>
                         
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'pesanan') ? 'active' : '' ?>" href="/pesanan">
                            <i class="bi bi-receipt me-1"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if (session()->get('role') == 'admin') { ?>
                    <!-- Menu Admin: Produk -->
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'produk') ? 'active' : '' ?>" href="/produk">
                            <i class="bi bi-box me-1"></i>
                            <span>Produk</span>
                        </a>
                    </li>

                    <!-- Menu Admin: Order -->
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'admin/order') ? 'active' : '' ?>" href="/admin/order">
                            <i class="bi bi-clipboard-check me-1"></i>
                            <span>Kelola Order</span>
                        </a>
                    </li>

                    <!-- Menu Admin: Konsumen -->
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'admin/konsumen') ? 'active' : '' ?>" href="/admin/konsumen">
                            <i class="bi bi-people me-1"></i>
                            <span>Kelola Konsumen</span>
                        </a>
                    </li>

                    <!-- Menu Admin: Laporan -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= (str_contains(uri_string(), 'admin/laporan')) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bar-chart-line me-1"></i>
                            <span>Laporan</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                               <a class="dropdown-item" href="/admin/laporan/global">
                                    <i class="bi bi-globe me-1"></i>Penjualan Global
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/admin/laporan/penjualan">
                                    <i class="bi bi-calendar-check me-1"></i>Penjualan Periodik
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/admin/laporan/pendapatan">
                                    <i class="bi bi-cash-coin me-1"></i>Pendapatan Periodik
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>

            <!-- Right Side Items -->
            <ul class="navbar-nav">
                <!-- Search Bar (non-admin only) -->
                <?php if (session()->get('role') != 'admin') { ?>
                    <li class="nav-item me-3">
                        <form class="search-form" action="/produk/search" method="get">
                            <div class="search-container">
                                <input type="text" class="search-input" placeholder="Search products..." name="q">
                                <button type="submit" class="search-btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                <?php } ?>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <span class="user-name">
                            <?= session()->get('isLoggedIn') ? session()->get('username') : 'Guest' ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-menu">
                        <?php if (session()->get('isLoggedIn')): ?>
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="bi bi-person me-2"></i>My Profile</a></li>

                            <?php if (session()->get('role') == 'customer') { ?>
                                <li><a class="dropdown-item" href="<?= base_url('keranjang') ?>"><i class="bi bi-cart me-2"></i>My Cart</a></li>
                            <?php } ?>

                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right me-2 text-danger"></i>Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item text-primary" href="<?= base_url('login') ?>"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Spacer to prevent content from hiding behind fixed navbar -->
    <div class="navbar-spacer"></div>

    <style>
        /* Traditional Blangkon Navbar Styles */
        .modern-navbar {
            background: linear-gradient(135deg, #8B4513 0%, #DAA520 50%, #CD853F 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(139, 69, 19, 0.3);
            padding: 0.5rem 0;
            transition: all 0.3s ease;
            z-index: 1030;
            border-bottom: 2px solid rgba(255, 215, 0, 0.2);
        }

        .modern-navbar.scrolled {
            background: rgba(139, 69, 19, 0.95);
            backdrop-filter: blur(15px);
            box-shadow: 0 2px 30px rgba(139, 69, 19, 0.4);
            border-bottom-color: rgba(255, 215, 0, 0.4);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: #FFD700 !important;
        }

        .brand-text {
            background: linear-gradient(45deg, #FFD700, #FFF8DC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            text-shadow: none;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
        }

        .navbar-nav .nav-link {
            color: rgba(255, 248, 220, 0.9) !important;
            font-weight: 500;
            padding: 0.75rem 1rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            margin: 0 0.2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link:hover {
            color: #FFD700 !important;
            background: rgba(255, 215, 0, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(218, 165, 32, 0.3);
        }

        .navbar-nav .nav-link.active {
            color: #FFD700 !important;
            background: rgba(255, 215, 0, 0.2);
            box-shadow: 0 4px 15px rgba(218, 165, 32, 0.4);
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .navbar-nav .nav-link.active::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: linear-gradient(90deg, #FFD700, #DAA520);
            border-radius: 2px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Cart Badge */
        .cart-badge {
            background: linear-gradient(135deg, #DC143C, #B22222);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
            animation: pulse 2s infinite;
            box-shadow: 0 2px 4px rgba(220, 20, 60, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Search Form */
        .search-form {
            display: flex;
            align-items: flex-end;
            /* Bikin input sejajar ke bawah */
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .search-input {
            background: rgba(245, 222, 179, 0.15);
            border: 2px solid rgba(255, 215, 0, 0.3);
            border-radius: 25px;
            color: #FFF8DC;
            padding: 8px 45px 8px 15px;
            font-size: 0.9rem;
            width: 250px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .search-input::placeholder {
            color: rgba(255, 248, 220, 0.7);
        }

        .search-input:focus {
            outline: none;
            background: rgba(245, 222, 179, 0.25);
            border-color: rgba(255, 215, 0, 0.6);
            width: 300px;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            color: white;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            background: rgba(255, 215, 0, 0.3);
            border: 1px solid rgba(255, 215, 0, 0.4);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: rgba(255, 215, 0, 0.5);
            transform: scale(1.1);
            color: white;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.4);
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem !important;
            border: 1px solid rgba(255, 215, 0, 0.2);
            border-radius: 25px;
            background: rgba(255, 215, 0, 0.1);
        }

        .user-dropdown:hover {
            background: rgba(255, 215, 0, 0.2);
            border-color: rgba(255, 215, 0, 0.4);
        }

        .user-avatar {
            font-size: 1.5rem;
            margin-right: 0.5rem;
            color: #FFD700;
        }

        .user-name {
            font-weight: 600;
            color: #FFF8DC !important;
        }

        .user-menu {
            background: linear-gradient(135deg, #FFF8DC 0%, #F5DEB3 100%);
            border: 2px solid rgba(218, 165, 32, 0.3);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(139, 69, 19, 0.3);
            margin-top: 0.5rem;
            padding: 0.5rem 0;
            min-width: 200px;
        }

        .user-menu .dropdown-item {
            padding: 0.7rem 1.5rem;
            color: #8B4513;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .user-menu .dropdown-item:hover {
            background: linear-gradient(135deg, #8B4513 0%, #DAA520 100%);
            color: white;
            transform: translateX(5px);
        }

        .user-menu .dropdown-item.text-danger:hover {
            background: linear-gradient(135deg, #DC143C 0%, #B22222 100%);
        }

        .user-menu .dropdown-item.text-primary {
            color: #8B4513 !important;
        }

        .user-menu .dropdown-item.text-primary:hover {
            background: linear-gradient(135deg, #228B22 0%, #32CD32 100%);
            color: white !important;
        }

        /* Mobile Responsive */
        .navbar-toggler {
            border: 2px solid rgba(255, 215, 0, 0.4);
            border-radius: 8px;
            padding: 0.5rem;
            background: rgba(255, 215, 0, 0.1);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 215, 0, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Navbar Spacer */
        .navbar-spacer {
            height: 80px;
            /* Adjust based on your navbar height */
        }

        /* Mobile Styles */
        @media (max-width: 991.98px) {
            .modern-navbar {
                padding: 0.75rem 0;
            }

            .navbar-collapse {
                background: rgba(245, 222, 179, 0.15);
                backdrop-filter: blur(10px);
                border-radius: 15px;
                margin-top: 1rem;
                padding: 1rem;
                border: 1px solid rgba(255, 215, 0, 0.2);
            }

            .search-input {
                width: 100%;
                margin-bottom: 1rem;
            }

            .search-input:focus {
                width: 100%;
            }

            .navbar-nav .nav-link {
                padding: 0.75rem !important;
                margin: 0.2rem 0;
            }

            .user-dropdown {
                border-top: 1px solid rgba(255, 215, 0, 0.3);
                margin-top: 1rem;
                padding-top: 1rem !important;
            }
        }

        @media (max-width: 576px) {
            .brand-text {
                display: none;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar-brand::after {
                content: "Blangkis";
                color: #FFD700;
                font-weight: 800;
            }

            .search-container {
                flex-direction: column;
                width: 100%;
            }

            .search-input {
                margin-bottom: 0.5rem;
            }
        }

        /* Smooth scrolling and navbar behavior */
        html {
            scroll-padding-top: 80px;
        }

        /* Animation for mobile menu */
        .navbar-collapse {
            transition: all 0.3s ease;
        }

        .navbar-collapse.show {
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

        /* Additional Traditional Elements */
        .modern-navbar::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #FFD700, transparent);
            opacity: 0.6;
        }
    </style>

    <script>
        // Add scroll effect to navbar
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.modern-navbar');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Close mobile menu when clicking on a link
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        const navbarToggler = document.querySelector('.navbar-toggler');
                        navbarToggler.click();
                    }
                });
            });

            // Enhanced search functionality
            const searchInput = document.querySelector('.search-input');
            const searchForm = document.querySelector('.search-form');

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const searchTerm = searchInput.value.trim();
                if (searchTerm) {
                    window.location.href = `/produk/search?q=${encodeURIComponent(searchTerm)}`;
                }
            });


            // Add typing effect to search placeholder
            let placeholderTexts = ['Search products...', 'Find amazing deals...', 'Discover new items...'];
            let currentText = 0;

            setInterval(() => {
                currentText = (currentText + 1) % placeholderTexts.length;
                searchInput.placeholder = placeholderTexts[currentText];
            }, 3000);
        });
    </script>