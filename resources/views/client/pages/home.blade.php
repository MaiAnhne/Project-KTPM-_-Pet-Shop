@extends('client.layouts.app')
@section('title', 'PetBuddy')
@section('description', 'Khám phá các sản phẩm phù hợp với thú cưng của bạn. Duyệt qua các loại thức ăn, đồ ăn bổ dưỡng và sản phẩm chăm sóc thú cưng.')
@section('keywords', 'đồ ăn thú cưng, thức ăn thú cưng, chăm sóc thú cưng, shopping, ecommerce')
@section('content')
    <!-- Modern Hero Section -->
    <div class="modern-hero">
        <div class="pet-emoji">🐶</div>
        <div class="pet-emoji">🐱</div>
        <div class="pet-emoji">🐰</div>
        <div class="pet-emoji">🐹</div>

        <div class="hero-background">
            <div class="hero-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
        </div>
        <div class="container">
            <div class="hero-content-wrapper">
                <div class="hero-text">
                    <h1 class="hero-title">
                        <span class="title-line">Nhà Ăn Thú Cưng</span>
                        <span class="title-line gradient-text">Hãy chăm sóc các bé</span>
                    </h1>
                    <p class="hero-description">
                    Ăn no, ngủ kĩ, phá phách mỗi ngày cùng thú cưng của bạn
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('products.index') }}" class="primary-btn">
                            <span>Tìm hiểu ngay</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#categories" class="secondary-btn">
                            <i class="fas fa-play"></i>
                            <span>Danh mục</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <section id="categories" class="categories-section">
        <div class="container">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">Danh mục sản phẩm</h2>
                    <div class="title-decoration"></div>
                </div>
                <p class="section-description">Đa dạng sản phẩm, trải nghiệm trọn vẹn,cam  kết an toàn</p>
            </div>

            <div class="categories-container">
                @foreach ($popularCategories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                       class="category-item" 
                       data-aos="fade-up" 
                       data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="category-icon-wrapper">
                            <div class="category-icon">
                                <img src="{{ asset('assets/images/svg/toy.svg') }}" alt="">
                            </div>
                            <div class="icon-glow"></div>
                        </div>
                        <div class="category-content">
                            <h3 class="category-title">{{ $category->name }}</h3>
                            <p class="category-count">{{ $category->products_count }} sản phẩm</p>
                        </div>
                        <div class="category-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section class="products-showcase new-products">
        <div class="container">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">Sản phẩm mới</h2>
                    <div class="title-decoration"></div>
                </div>
                <p class="section-description">Những sản phẩm cập nhật mới nhất</p>
                <a href="{{ route('products.index', ['sort' => 'newest']) }}" class="view-all-link">
                    <span>Xem thêm nhiều lựa chọn</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="products-slider-container">
                <div class="swiper new-products-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($newProducts as $product)
                            <div class="swiper-slide">
                                @include('components.item-product', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bestseller Products Section -->
    <section class="products-showcase bestseller-products">
        <div class="container">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <h2 class="section-title">Sản phẩm bán chạy</h2>
                    <div class="title-decoration"></div>
                </div>
                <p class="section-description">Những sản phẩm được mọi người ưa chuộng nhất</p>
                <a href="{{ route('products.index', ['is_bestseller' => 1]) }}" class="view-all-link">
                    <span>Xem thêm</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="row g-2">
                @foreach ($bestsellerProducts as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        @include('components.item-product', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Modern Hero Section */
        .modern-hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #e7aadf68 0%, #abe3f0ff 100%);
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }

        .hero-shapes {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-text {
            color: white;
        }

        .hero-title {
            color: #000;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 3.5rem;
        }

        .title-line {
            display: block;
        }

        .gradient-text {
            background: linear-gradient(45deg, #4b5b7aff, #deda8dff);
            font-family: Georgia, 'Times New Roman', Times, serif;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            color: #27232bff;
            font-family: 'Instrument Sans', sans-serif;
            font-size: 1.3rem;
            line-height: 1.6;
            margin-bottom: 4.5rem;
            opacity: 0.9;
        }

        .hero-actions {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .primary-btn {
            background: linear-gradient(135deg, #ff6b6b, #ff8e53);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255, 107, 107, 0.6);
        }

        .secondary-btn {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .secondary-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .hero-visual {
            position: relative;
            height: 500px;
        }

        .floating-toys {
            position: relative;
            height: 100%;
        }

        .toy {
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            animation: toyFloat 4s ease-in-out infinite;
        }

        .toy-1 { top: 10%; left: 20%; animation-delay: 0s; }
        .toy-2 { top: 30%; right: 10%; animation-delay: 1s; }
        .toy-3 { bottom: 30%; left: 10%; animation-delay: 2s; }
        .toy-4 { bottom: 10%; right: 30%; animation-delay: 3s; }

        @keyframes toyFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }

        /* Section Styles */
        section {
            padding: 6rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
        }

        .section-title-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #2d3748;
            margin: 0;
        }

        .title-decoration {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #accfe7ff, #764ba2);
            border-radius: 2px;
        }

        .section-description {
            font-size: 1.1rem;
            color: #718096;
            max-width: 600px;
            margin: 0 auto;
        }

        .view-all-link {
            position: absolute;
            top: 0;
            right: 0;
            color: #353f3fff;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .view-all-link:hover {
            color: #764ba2;
            transform: translateX(5px);
        }

        /* Categories Section */
        .categories-section {
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        }

        .categories-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .category-item {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .category-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #c2edf4ff, #c9a5ecff);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .category-item:hover::before {
            opacity: 0.05;
        }

        .category-icon-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .category-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #a3d7eaff, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .icon-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #a5ebefff, #764ba2);
            border-radius: 50%;
            opacity: 0.2;
            filter: blur(15px);
            z-index: 1;
        }

        .category-content {
            flex-grow: 1;
        }

        .category-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #2d3748;
        }

        .category-count {
            color: #718096;
            margin: 0;
        }

        .category-arrow {
            color: #aeb6dbff;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .category-item:hover .category-arrow {
            transform: translateX(5px);
        }

        /* Products Showcase */
        .products-showcase {
            position: relative;
        }

        .new-products {
            background: white;
        }

        .bestseller-products {
            background: linear-gradient(135deg, #d1e2edff 0%, #edf2f7 100%);
        }

        .products-slider-container {
            position: relative;
            margin: 0 -1rem;
        }

        .swiper {
            padding: 2rem 1rem;
        }

        .swiper-button-prev,
        .swiper-button-next {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            color: #dd9ad3ff;
            transition: all 0.3s ease;
        }

        .swiper-button-prev:hover,
        .swiper-button-next:hover {
            background: #df9ce1ff;
            color: white;
            transform: scale(1.1);
        }

        .swiper-button-prev::after,
        .swiper-button-next::after {
            display: none;
        }

        .swiper-pagination-bullet {
            background: #e3b6e6ff;
            opacity: 0.3;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            transform: scale(1.2);
        }

        /* Bestseller Grid */
        .bestseller-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-content-wrapper {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-title {
                font-size: 3rem;
            }

            .view-all-link {
                position: static;
                margin-top: 1rem;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .modern-hero {
                min-height: 80vh;
                padding: 2rem 0;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .primary-btn,
            .secondary-btn {
                width: 100%;
                justify-content: center;
            }

            .categories-container {
                grid-template-columns: 1fr;
            }

            .category-item {
                padding: 1.5rem;
            }

            .bestseller-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .bestseller-grid {
                grid-template-columns: 1fr;
            }
        }
        .pet-emoji {
            position: absolute;
            font-size: 2.5rem;  
            z-index: 3;
            animation: moveRandom 6s infinite ease-in-out;
            user-select: none;
            pointer-events: none;
}

@keyframes moveRandom {
    0% { transform: translate(0, 0); }
    25% { transform: translate(30px, -20px); }
    50% { transform: translate(-20px, 25px); }
    75% { transform: translate(15px, 20px); }
    100% { transform: translate(0, 0); }
}

.pet-emoji {
    position: absolute;
    font-size: 2.8rem;
    z-index: 5;
    animation: moveRandom 6s infinite ease-in-out;
    user-select: none;
    pointer-events: none;
}

/* Animation thú chạy nhẹ */
@keyframes moveRandom {
    0%   { transform: translate(0, 0); }
    25%  { transform: translate(30px, -20px); }
    50%  { transform: translate(-20px, 25px); }
    75%  { transform: translate(15px, 20px); }
    100% { transform: translate(0, 0); }
}

/* Đồ ăn rơi */
.food-drop {
    position: absolute;
    font-size: 2.4rem;
    animation: dropFood 3s linear infinite;
    pointer-events: none;
    user-select: none;
    z-index: 4;
    left: 50%;
    transform: translateX(-50%);
}

@keyframes dropFood {
    0%   { top: -50px; opacity: 1; }
    80%  { top: 70%; opacity: 1; }
    100% { top: 100%; opacity: 0; }
}

    </style>
@endpush

@push('scripts')

    <script>
        function createFood() {
        const food = document.createElement('div');
        food.classList.add('food-drop');
        food.innerHTML = '🍖'; // Có thể thay bằng 🍗, 🦴, 🍣...
        document.body.appendChild(food);

        // Xóa sau khi rơi xong
        setTimeout(() => {
            food.remove();
        }, 3000);
    }

    
    setInterval(createFood, 4000);
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
            const newProductsSwiper = new Swiper('.new-products-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 20,
                    },
                    1280: {
                        slidesPerView: 5,
                        spaceBetween: 20,
                    }
                }
            });

            // Initialize AOS (Animate On Scroll)
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 100
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                
                const heroShapes = document.querySelector('.hero-shapes');
                if (heroShapes) {
                    heroShapes.style.transform = `translateY(${rate}px)`;
                }
            });
        });

        const emojis = document.querySelectorAll('.pet-emoji');
        emojis.forEach(emoji => {
            const randomX = Math.random() * 80 + 5; 
            const randomY = Math.random() * 80 + 5; 
            emoji.style.top = randomY + '%';
            emoji.style.left = randomX + '%';
        });

    </script>
@endpush
