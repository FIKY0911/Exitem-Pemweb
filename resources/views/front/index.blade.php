<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exitem - Your Shopping Destination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/css/home.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Top Bar -->
    <div style="background: black; color: white; text-align: center; padding: 12px 0; font-size: 14px;">
        Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! 
        <a href="#" style="color: white; text-decoration: underline; margin-left: 10px;">ShopNow</a>
    </div>

    <!-- Header -->
    <header class="main-header border-bottom">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Logo -->
                <div class="logo">Exitem</div>

                <!-- Navigation -->
                <nav>
                    <ul class="nav-links">
                        <li><a href="{{ route('front.index') }}" class="active">Home</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">About</a></li>
                        @guest
                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                        @endguest
                    </ul>
                </nav>

                <!-- Search & Icons -->
                <div class="nav-icons">
                    <div class="search-box">
                        <input type="text" placeholder="What are you looking for?">
                        <i class="fas fa-search"></i>
                    </div>
                    
                    @auth
                        <div class="profile-container" onclick="toggleDropdown()">
                            <i class="fas fa-user profile-icon"></i>
                            <div class="profile-dropdown" id="profileDropdown">
                                <a href="#"><i class="fas fa-user"></i> My Profile</a>
                                <a href="#"><i class="fas fa-shopping-bag"></i> My Orders</a>
                                <a href="#"><i class="fas fa-heart"></i> My Wishlist</a>
                                <hr>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                    @endauth
                    
                    <i class="fas fa-heart"></i>
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container">
        <div class="hero-section">
            <!-- Sidebar Categories -->
            <div class="sidebar">
                <ul>
                    @foreach($categories->take(8) as $category)
                        <li>
                            <a href="{{ route('front.category', $category->slug) }}" style="text-decoration: none; color: inherit;">
                                {{ $category->name }}
                            </a>
                            <i class="fas fa-chevron-right"></i>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Hero Banner Slider -->
            <div class="hero-banner swiper heroSwiper" style="padding: 0; background: none; display: block; overflow: hidden; position: relative; width: 100%;">
                @php
                    $banners = \App\Models\Banner::where('is_active', true)->orderBy('sort_order')->get();
                @endphp

                <div class="swiper-wrapper">
                    @forelse($banners as $banner)
                        <div class="swiper-slide">
                            <div style="display: flex; justify-content: space-between; align-items: center; background-color: #000; color: white; padding: 40px; min-height: 350px; width: 100%; box-sizing: border-box;">
                                <div class="hero-content" style="flex: 1; margin: 0; max-width: 50%;">
                                    <div class="brand">
                                        @if($banner->brand_icon)
                                            <img src="{{ Storage::url($banner->brand_icon) }}" alt="Brand Icon" style="width: 24px; height: 24px; object-fit: contain; margin-right: 8px;">
                                        @endif
                                        <span>{{ $banner->brand_name }}</span>
                                    </div>
                                    <h1 style="margin-bottom: 20px;">{!! $banner->title !!}</h1>
                                    @if($banner->product_id)
                                        <a href="{{ route('front.details', $banner->product->slug ?? $banner->product_id) }}" class="shop-now">Shop Now <i class="fas fa-arrow-right"></i></a>
                                    @endif
                                </div>
                                <div class="hero-img" style="flex: 1; text-align: right;">
                                    <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->brand_name }}" style="max-height: 250px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Default Static Banner (Fallback) -->
                        <div class="swiper-slide">
                            <div style="display: flex; justify-content: space-between; align-items: center; background-color: #000; color: white; padding: 40px; min-height: 350px; width: 100%; box-sizing: border-box;">
                                <div class="hero-content" style="flex: 1; margin: 0; max-width: 50%;">
                                    <div class="brand">
                                        <i class="fab fa-apple"></i>
                                        <span>iPhone 14 Series</span>
                                    </div>
                                    <h1 style="margin-bottom: 20px;">Up to 10%<br>off Voucher</h1>
                                    <a href="#products" class="shop-now">Shop Now <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <div class="hero-img" style="flex: 1; text-align: right;">
                                    <img src="https://via.placeholder.com/300x200/000000/FFFFFF?text=iPhone+14" alt="iPhone 14" style="max-height: 250px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="container section">
        <div class="section-tag">
            <div class="red-rect"></div>
            <span>Categories</span>
        </div>
        <h2 class="section-title">Browse By Category</h2>
        
        <div class="category-grid">
            @foreach($categories->take(6) as $category)
                <a href="{{ route('front.category', $category->slug) }}" class="cat-box" style="text-decoration: none; color: inherit;">
                    @if($category->icon)
                        <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" style="width: 32px; height: 32px; margin-bottom: 10px;">
                    @else
                        <i class="fas fa-mobile-alt"></i>
                    @endif
                    <span>{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <hr class="divider container">

    <!-- Best Selling Products -->
    <section class="container section" id="products">
        <div class="section-tag">
            <div class="red-rect"></div>
            <span>This Month</span>
        </div>
        
        <div class="section-header">
            <h2 class="section-title">Best Selling Products</h2>
            <button class="btn-red">View All</button>
        </div>

        <div class="product-grid">
            @foreach($popularProducts->take(4) as $product)
                <div class="product-card">
                    <div class="product-thumb">
                        @if($product->thumbnail)
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150x150/F5F5F5/000000?text=No+Image" alt="{{ $product->name }}">
                        @endif
                        <div class="add-to-cart">Add To Cart</div>
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="rating">
                            ⭐⭐⭐⭐⭐ <span>({{ rand(20, 100) }})</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <hr class="divider container">

    <!-- Our Products -->
    <section class="container section">
        <div class="section-tag">
            <div class="red-rect"></div>
            <span>Our Products</span>
        </div>
        <h2 class="section-title">Explore Our Products</h2>

        <div class="product-grid" style="margin-top: 40px;">
            @foreach($latestProducts->take(8) as $product)
                <div class="product-card">
                    <div class="product-thumb">
                        @if($product->thumbnail)
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150x150/F5F5F5/000000?text=No+Image" alt="{{ $product->name }}">
                        @endif
                        <div class="add-to-cart">Add To Cart</div>
                    </div>
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="rating">
                            ⭐⭐⭐⭐⭐ <span>({{ rand(20, 100) }})</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- New Arrival -->
    <section class="container section">
        <div class="section-tag">
            <div class="red-rect"></div>
            <span>Featured</span>
        </div>
        <h2 class="section-title">New Arrival</h2>

        <div class="new-arrival-grid">
            @php $newArrivals = $latestProducts->take(3); @endphp
            
            @if(isset($newArrivals[0]))
                <div class="new-arrival-card big" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ Storage::url($newArrivals[0]->thumbnail) }}');">
                    <div class="new-arrival-content">
                        <h3>{{ $newArrivals[0]->name }}</h3>
                        <p>{{ $newArrivals[0]->category->name ?? 'New Arrival' }}</p>
                        <a href="{{ route('front.details', $newArrivals[0]->slug) }}" class="shop-now">Shop Now</a>
                    </div>
                </div>
            @else
                <div class="new-arrival-card big" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('https://via.placeholder.com/600x580/000000/FFFFFF?text=New+Arrival');">
                    <div class="new-arrival-content">
                        <h3>Coming Soon</h3>
                        <p>New products will be here soon.</p>
                    </div>
                </div>
            @endif

            @if(isset($newArrivals[1]))
                <div class="new-arrival-card" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ Storage::url($newArrivals[1]->thumbnail) }}');">
                    <div class="new-arrival-content">
                        <h3>{{ $newArrivals[1]->name }}</h3>
                        <p>{{ $newArrivals[1]->category->name ?? 'New Arrival' }}</p>
                        <a href="{{ route('front.details', $newArrivals[1]->slug) }}" class="shop-now">Shop Now</a>
                    </div>
                </div>
            @endif

            @if(isset($newArrivals[2]))
                <div class="new-arrival-card" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ Storage::url($newArrivals[2]->thumbnail) }}');">
                    <div class="new-arrival-content">
                        <h3>{{ $newArrivals[2]->name }}</h3>
                        <p>{{ $newArrivals[2]->category->name ?? 'New Arrival' }}</p>
                        <a href="{{ route('front.details', $newArrivals[2]->slug) }}" class="shop-now">Shop Now</a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Services -->
    <section class="container services">
        <div class="services-grid">
            <div class="service-item">
                <i class="fas fa-truck"></i>
                <div class="service-text">
                    <h4>FREE AND FAST DELIVERY</h4>
                    <p>Free delivery for all orders over $140</p>
                </div>
            </div>
            
            <div class="service-item">
                <i class="fas fa-headset"></i>
                <div class="service-text">
                    <h4>24/7 CUSTOMER SERVICE</h4>
                    <p>Friendly 24/7 customer support</p>
                </div>
            </div>
            
            <div class="service-item">
                <i class="fas fa-shield-alt"></i>
                <div class="service-text">
                    <h4>MONEY BACK GUARANTEE</h4>
                    <p>We return money within 30 days</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="logo-light">Exclusive</div>
                    <h3>Subscribe</h3>
                    <p>Get 10% off your first order</p>
                    <div class="email-box">
                        <input type="email" placeholder="Enter your email">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3>Support</h3>
                    <p>111 Bijoy sarani, Dhaka,<br>DH 1515, Bangladesh.</p>
                    <p>exclusive@gmail.com</p>
                    <p>+88015-88888-9999</p>
                </div>
                
                <div class="footer-col">
                    <h3>Account</h3>
                    <ul>
                        <li><a href="{{ route('profile') }}" style="color: white; text-decoration: none;">My Profile</a></li>
                        <li><a href="{{ route('login') }}" style="color: white; text-decoration: none;">Login / Register</a></li>
                        <li><a href="#" style="color: white; text-decoration: none;">Cart</a></li>
                        <li><a href="#" style="color: white; text-decoration: none;">Wishlist</a></li>
                        <li><a href="#" style="color: white; text-decoration: none;">Shop</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Quick Link</h3>
                    <ul>
                        <li><a href="#" style="color: white; text-decoration: none;">Privacy Policy</a></li>
                        <li><a href="#" style="color: white; text-decoration: none;">Terms Of Use</a></li>
                        <li><a href="#" style="color: white; text-decoration: none;">FAQ</a></li>
                        <li><a href="#" style="color: white; text-decoration: none;">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div style="border-top: 1px solid rgba(255,255,255,0.2); margin-top: 40px; padding-top: 20px; text-align: center; color: rgba(255,255,255,0.6);">
                <p>&copy; Copyright Rimel 2022. All right reserved</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var swiper = new Swiper(".heroSwiper", {
                spaceBetween: 30,
                centeredSlides: true,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        });

        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const container = document.querySelector('.profile-container');
            const dropdown = document.getElementById('profileDropdown');
            
            if (container && dropdown && !container.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    </script>
</body>
</html>
