<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - KOPI CUSS</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .font-pacifico { font-family: 'Pacifico', cursive; }
        .bg-pattern {
            background-image: linear-gradient(45deg, rgba(255,51,51,0.05) 25%, transparent 25%), linear-gradient(-45deg, rgba(255,51,51,0.05) 25%, transparent 25%), linear-gradient(45deg, transparent 75%, rgba(255,51,51,0.05) 75%), linear-gradient(-45deg, transparent 75%, rgba(255,51,51,0.05) 75%);
            background-size: 50px 50px; background-position: 0 0, 0 25px, 25px -25px, -25px 0px;
        }
        .coffee-bean { position: absolute; background: rgba(139,69,19,0.3); border-radius: 50%; animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-20px) rotate(180deg); } }
        .hover-scale { transition: transform 0.3s ease; } .hover-scale:hover { transform: scale(1.05) translateY(-5px); }
        .glass-effect { background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeInUp { animation: fadeInUp 0.8s ease forwards; }
        .cart-icon { position: relative; } 
        .cart-count { 
            position: absolute; 
            top: -8px; 
            right: -8px; 
            background: #dc2626;  
            color: white; 
            border-radius: 50%; 
            width: 20px; 
            height: 20px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 10px; 
            font-weight: bold;
            border: 2px solid #1f2937;
            z-index: 10;
            min-width: 20px;
            padding: 0 4px;
        }
        .mobile-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(39,39,42,0.95); backdrop-filter: blur(10px); border-bottom: 2px solid #dc2626; z-index: 40; }
        .mobile-menu.active { display: block; } .mobile-menu ul { padding: 1rem 0; } .mobile-menu li { padding: 0.75rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); } .mobile-menu li:last-child { border-bottom: none; }
        .mobile-menu a { display: flex; align-items: center; justify-content: space-between; font-weight: 600; } .mobile-menu a:hover { color: #dc2626; }
        .hamburger { transition: all 0.3s ease; } .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px,5px); } .hamburger.active span:nth-child(2) { opacity: 0; } .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(7px,-6px); }
        .hamburger span { display: block; width: 25px; height: 3px; background-color: white; margin: 5px 0; transition: all 0.3s ease; }
        
        .menu-image-container { position: relative; overflow: hidden; border-radius: 1rem; }
        .menu-image { width: 100%; height: 250px; object-fit: cover; object-position: center; transition: transform 0.5s ease; }
        .menu-image:hover { transform: scale(1.1); }
        
        .color-change-btn { 
            background: linear-gradient(45deg, #dc2626, #ea580c, #dc2626);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            transition: all 0.3s ease;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .color-change-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
        }
        
        .logo-text-effect {
            color: #dc2626;
            -webkit-text-stroke: 10px #000000;
            paint-order: stroke fill;
        }
        .menu-category-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 40px;
        }
        .menu-tab {
            background: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .menu-tab.active {
            background: #dc2626;
            color: white;
        }
        .menu-tab:hover {
            background: rgba(220, 38, 38, 0.7);
        }
        .menu-category {
            display: none;
        }
        .menu-category.active {
            display: block;
        }
        .menu-item-card {
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .menu-item-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            border-color: rgba(220, 38, 38, 0.5);
        }
        .menu-item-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            object-position: center;
            background: linear-gradient(45deg, #374151, #6b7280);
        }
        .menu-item-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .menu-item-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }
        .menu-item-description {
            color: #a1a1aa;
            margin-bottom: 15px;
            flex-grow: 1;
        }
        .menu-item-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
        .menu-item-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc2626;
        }
        .menu-item-actions {
            display: flex;
            gap: 10px;
        }
        .badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            z-index: 10;
        }
        .badge-best {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            color: white;
        }
        .badge-recommended {
            background: linear-gradient(45deg, #10b981, #059669);
            color: white;
        }
        .badge-new {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            color: white;
        }

        nav {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1000 !important;
        }
        
        body {
            padding-top: 80px;
        }
 
        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 2000;
            backdrop-filter: blur(5px);
        }
        
        .cart-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .cart-content {
            background: #1f2937;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            border: 2px solid #dc2626;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
        
        .cart-header {
            padding: 20px;
            border-bottom: 1px solid #374151;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .cart-items {
            padding: 20px;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #374151;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-footer {
            padding: 20px;
            border-top: 1px solid #374151;
        }
        
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #dc2626;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background: #b91c1c;
            transform: scale(1.1);
        }
        
        .remove-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .remove-btn:hover {
            background: #dc2626;
        }
        
        .chat-integration {
            margin-top: 20px;
            text-align: center;
        }
        
        .form-success {
            position: fixed;
            top: 100px;
            right: 20px;
            background: #10b981;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideInRight 0.5s ease, fadeOut 0.5s ease 3.5s forwards;
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        .floating-action {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #dc2626;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
            z-index: 100;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }
        
        .floating-action:hover {
            transform: scale(1.1);
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(220, 38, 38, 0); }
            100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
        }
    </style>
</head>
<body class="bg-zinc-900 text-white">
    <nav class="fixed w-full z-50 bg-zinc-900/95 backdrop-blur-lg border-b-2 border-red-600 top-0 left-0 right-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
              
                <div class="flex items-center space-x-3">
                   <a href="/index" class="flex items-center space-x-3">
                       <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg shadow-red-600/50 overflow-hidden">
                           <img src="image/foto1.jpeg" alt="Logo Kopi" class="w-full h-full object-cover">
                       </div>
                       <div class="flex flex-col items-center">
                           <span class="font-pacifico text-2xl text-red-600 drop-shadow-lg leading-none">KOPI</span>
                           <span class="font-pacifico text-2xl text-red-600 drop-shadow-lg leading-none">CUSS</span>
                       </div>
                   </a>
                </div>
           
                <ul class="hidden md:flex space-x-8 items-center">
                    <li><a href="/index" class="hover:text-red-600 transition font-semibold">Home</a></li>
                    <li><a href="/menu" class="hover:text-red-600 transition font-semibold text-red-600">Menu</a></li>
                    <li><a href="/about" class="hover:text-red-600 transition font-semibold">Tentang</a></li>
                    <li><a href="/contact" class="hover:text-red-600 transition font-semibold">Kontak</a></li>
                    <li>
        
                        <a href="#" class="cart-icon hover:text-red-600 transition font-semibold relative" id="cart-button">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span class="cart-count">0</span>
                        </a>
                    </li>
                </ul>
                
             
                <div class="md:hidden flex items-center space-x-4">
                 
                    <a href="#" class="cart-icon relative" id="mobile-cart-button">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="cart-count">0</span>
                    </a>
                    <button id="hamburger-btn" class="text-white hamburger">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="mobile-menu">
            <ul>
                <li><a href="/index">Home <i class="fas fa-chevron-right"></i></a></li>
                <li><a href="/menu" class="text-red-600">Menu <i class="fas fa-chevron-right"></i></a></li>
                <li><a href="/about">Tentang <i class="fas fa-chevron-right"></i></a></li>
                <li><a href="/contact">Kontak <i class="fas fa-chevron-right"></i></a></li>
                <li>
                    <a href="#" class="cart-icon relative" id="mobile-menu-cart-button">
                        Keranjang <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="cart-modal" class="cart-modal">
        <div class="cart-content">
            <div class="cart-header">
                <h2 class="text-xl font-bold text-red-600">Keranjang Pesanan</h2>
                <button id="close-cart" class="text-gray-400 hover:text-white text-2xl">&times;</button>
            </div>
            <div class="cart-items" id="cart-items">
            </div>
            <div class="cart-footer">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-semibold">Total:</span>
                    <span class="font-bold text-red-600" id="cart-total">Rp 0</span>
                </div>
                <div class="chat-integration">
                    <p class="text-sm text-gray-300 mb-3">Kirim pesanan melalui WhatsApp:</p>
                    <div class="flex gap-3 justify-center">
                        <a href="#" id="whatsapp-order" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full transition flex items-center gap-2 text-lg font-semibold">
                            <i class="fab fa-whatsapp text-xl"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="menu" class="min-h-screen bg-gradient-to-b from-zinc-900 to-zinc-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16">
        <div class="text-center mb-8">
            <h2 class="font-pacifico text-4xl md:text-5xl text-red-600 mb-4">Menu Lengkap</h2>
                <p class="text-gray-400 text-lg">Pilihan terbaik untuk setiap momen spesial Anda</p>
                <div class="menu-category-tabs">
                    <div class="menu-tab active" data-category="all">Semua Menu</div>
                    <div class="menu-tab" data-category="kopi">Kopi</div>
                    <div class="menu-tab" data-category="non-kopi">Non-Kopi</div>
                    <div class="menu-tab" data-category="best-seller">Best Seller</div>
                </div>
            </div>
            
            <div class="menu-category active" id="all">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="menu-item-card hover-scale" data-category="kopi">
                        <div class="relative">
                            <img src="image/signature.jpeg" alt="Kopi Signature Cuss" class="menu-item-image">
                            <div class="badge badge-recommended">🔥 Recommended</div>
                        </div>
                        <div class="menu-item-content">
                            <h3 class="menu-item-title">Kopi Signature Cuss</h3>
                            <p class="menu-item-description">Racikan spesial khas KOPI CUSS dengan cita rasa yang unik dan nikmat untuk pengalaman ngopi yang tak terlupakan.</p>
                            <div class="menu-item-footer">
                                <span class="menu-item-price">12K</span>
                                <div class="menu-item-actions">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition text-sm whatsapp-order-btn" data-name="Kopi Signature Cuss" data-price="12">Pesan</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition text-sm add-to-cart" data-name="Kopi Signature Cuss" data-price="12">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item-card hover-scale" data-category="kopi best-seller">
                        <div class="relative">
                            <img src="image/kopi aren.jpeg" alt="Kopi Aren" class="menu-item-image">
                             <div class="badge badge-best">⭐ Best Seller</div>
                        </div>
                        <div class="menu-item-content">
                            <h3 class="menu-item-title">Kopi Aren</h3>
                            <p class="menu-item-description">Kopi dengan gula aren asli yang memberikan rasa manis alami dan aroma khas yang menggugah selera.</p>
                            <div class="menu-item-footer">
                                <span class="menu-item-price">10K</span>
                                <div class="menu-item-actions">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition text-sm whatsapp-order-btn" data-name="Kopi Aren" data-price="10">Pesan</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition text-sm add-to-cart" data-name="Kopi Aren" data-price="10">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="menu-item-card" data-category="kopi">
                        <div class="relative">
                            <img src="image/butterscoth.jpeg" alt="Kopi Butterscotch" class="menu-item-image">
                            <div class="badge badge-recommended">🔥 Recommended</div>
                        </div>
                        <div class="menu-item-content">
                            <h3 class="menu-item-title">Kopi Butterscotch</h3>
                            <p class="menu-item-description">Perpaduan sempurna kopi dengan butterscotch yang manis dan creamy, menciptakan harmoni rasa yang memanjakan.</p>
                            <div class="menu-item-footer">
                                <span class="menu-item-price">12K</span>
                                <div class="menu-item-actions">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition text-sm whatsapp-order-btn" data-name="Kopi Butterscotch" data-price="12">Pesan</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition text-sm add-to-cart" data-name="Kopi Butterscotch" data-price="12">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item-card hover-scale" data-category="non-kopi">
                        <div class="relative">
                            <img src="image/green.jpeg" alt="Greentea Cuss" class="menu-item-image">
                            <div class="badge badge-recommended">🌿 Recommended</div>
                        </div>
                        <div class="menu-item-content">
                            <h3 class="menu-item-title">Greentea Cuss</h3>
                            <p class="menu-item-description">Teh hijau segar dengan rasa yang menenangkan, cocok untuk menemani saat-saat santai Anda.</p>
                            <div class="menu-item-footer">
                                <span class="menu-item-price">10K</span>
                                <div class="menu-item-actions">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition text-sm whatsapp-order-btn" data-name="Greentea Cuss" data-price="10">Pesan</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition text-sm add-to-cart" data-name="Greentea Cuss" data-price="10">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item-card hover-scale" data-category="non-kopi">
                        <div class="relative">
                            <img src="image/coklat.jpeg" alt="Chocolate Cuss" class="menu-item-image">
                            <div class="badge badge-recommended">🍫 Recommended</div>
                        </div>
                        <div class="menu-item-content">
                            <h3 class="menu-item-title">Chocolate Cuss</h3>
                            <p class="menu-item-description">Cokelat lezat dengan rasa yang creamy dan nikmat, memberikan kenikmatan yang sempurna bagi pecinta cokelat.</p>
                            <div class="menu-item-footer">
                                <span class="menu-item-price">10K</span>
                                <div class="menu-item-actions">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition text-sm whatsapp-order-btn" data-name="Chocolate Cuss" data-price="10">Pesan</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition text-sm add-to-cart" data-name="Chocolate Cuss" data-price="10">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item-card hover-scale" data-category="non-kopi">
                        <div class="relative">
                            <img src="image/lecy.jpeg" alt="Lychee Tea" class="menu-item-image">
                            <div class="badge badge-recommended">🍓 Recommended</div>
                        </div>
                        <div class="menu-item-content">
                            <h3 class="menu-item-title">Lychee Tea</h3>
                            <p class="menu-item-description">Kesegaran leci yang menyegarkan untuk hari-hari panas, memberikan sensasi rasa buah yang nikmat dan menyegarkan.</p>
                            <div class="menu-item-footer">
                                <span class="menu-item-price">10K</span>
                                <div class="menu-item-actions">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full transition text-sm whatsapp-order-btn" data-name="Lychee Tea" data-price="10">Pesan</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full transition text-sm add-to-cart" data-name="Lychee Tea" data-price="10">+ Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-category" id="kopi">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                </div>
            </div>

            <div class="menu-category" id="non-kopi">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                </div>
            </div>

            <div class="menu-category" id="best-seller">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                </div>
            </div>
        </div>
    </section>

    <a href="https://wa.me/6282192347565" target="_blank" class="floating-action" id="whatsapp-btn">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartModal = document.getElementById('cart-modal');
            
            const cartButton = document.getElementById('cart-button');
            const mobileCartButton = document.getElementById('mobile-cart-button');
            const mobileMenuCartButton = document.getElementById('mobile-menu-cart-button');
            const closeCart = document.getElementById('close-cart');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const whatsappOrder = document.getElementById('whatsapp-order');

            function formatCartCount(count) {
                if (count >= 1000) {
                    return (count / 1000).toFixed(1) + 'k';
                }
                return count.toString();
            }

            function updateCartCount() {
                const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
                const formattedCount = formatCartCount(totalItems);
                
                document.querySelectorAll('.cart-count').forEach(element => {
                    element.textContent = formattedCount;
                });
            }

            function updateCartDisplay() {
                cartItems.innerHTML = '';
                
                if (cart.length === 0) {
                    cartItems.innerHTML = '<div class="empty-cart"><i class="fas fa-shopping-cart text-4xl mb-4 text-gray-500"></i><p>Keranjang Anda kosong</p></div>';
                    cartTotal.textContent = 'Rp 0';
                    return;
                }
                
                let total = 0;
                
                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    
                    const cartItem = document.createElement('div');
                    cartItem.className = 'cart-item';
                    cartItem.innerHTML = `
                        <div>
                            <div class="font-semibold">${item.name}</div>
                            <div class="text-sm text-gray-400">${item.price}K</div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="quantity-controls">
                                <button class="quantity-btn decrease" data-index="${index}">-</button>
                                <span class="quantity">${item.quantity}</span>
                                <button class="quantity-btn increase" data-index="${index}">+</button>
                            </div>
                            <div class="font-semibold">${itemTotal}K</div>
                            <button class="remove-btn" data-index="${index}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    cartItems.appendChild(cartItem);
                });
                
                cartTotal.textContent = `Rp ${total}K`;
                document.querySelectorAll('.quantity-btn.decrease').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const index = e.target.dataset.index;
                        if (cart[index].quantity > 1) {
                            cart[index].quantity--;
                        } else {
                            cart.splice(index, 1);
                        }
                        saveCart();
                        updateCartDisplay();
                        updateCartCount();
                    });
                });
                
                document.querySelectorAll('.quantity-btn.increase').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const index = e.target.dataset.index;
                        cart[index].quantity++;
                        saveCart();
                        updateCartDisplay();
                        updateCartCount();
                    });
                });
                
                document.querySelectorAll('.remove-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const index = e.target.closest('.remove-btn').dataset.index;
                        cart.splice(index, 1);
                        saveCart();
                        updateCartDisplay();
                        updateCartCount();
                    });
                });
            }

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function generateOrderMessage() {
                if (cart.length === 0) return '';
                
                let message = "Halo KOPI CUSS, saya ingin memesan:\n\n";
                let total = 0;
                
                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    message += `• ${item.name} x${item.quantity} = ${itemTotal}K\n`;
                });
                
                message += `\nTotal: ${total}K\n\n`;
                message += "Mohon konfirmasi ketersediaan dan informasi pengiriman. Terima kasih!";
                
                return encodeURIComponent(message);
            }

            function generateSingleOrderMessage(itemName, itemPrice) {
                let message = `Halo KOPI CUSS, saya ingin memesan:\n\n`;
                message += `• ${itemName} x1 = ${itemPrice}K\n\n`;
                message += `Total: ${itemPrice}K\n\n`;
                message += "Mohon konfirmasi ketersediaan dan informasi pengiriman. Terima kasih!";
                
                return encodeURIComponent(message);
            }

            function openCart() {
                cartModal.classList.add('active');
                updateCartDisplay();
            }

            function closeCartModal() {
                cartModal.classList.remove('active');
            }

            cartButton.addEventListener('click', (e) => {
                e.preventDefault();
                openCart();
            });

            mobileCartButton.addEventListener('click', (e) => {
                e.preventDefault();
                openCart();
            });
            mobileMenuCartButton.addEventListener('click', (e) => {
                e.preventDefault();
                openCart();
                const mobileMenu = document.getElementById('mobile-menu');
                const hamburgerBtn = document.getElementById('hamburger-btn');
                mobileMenu.classList.remove('active');
                hamburgerBtn.classList.remove('active');
            });

            closeCart.addEventListener('click', closeCartModal);

            cartModal.addEventListener('click', (e) => {
                if (e.target === cartModal) {
                    closeCartModal();
                }
            });

            whatsappOrder.addEventListener('click', (e) => {
                e.preventDefault();
                if (cart.length === 0) {
                    alert('Keranjang Anda kosong. Silakan tambahkan item terlebih dahulu.');
                    return;
                }
                
                const message = generateOrderMessage();
                const phoneNumber = '6282192347565';
                const url = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(url, '_blank');
            });

            document.querySelectorAll('.whatsapp-order-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    const name = e.target.getAttribute('data-name');
                    const price = parseInt(e.target.getAttribute('data-price'));
                    
                    const message = generateSingleOrderMessage(name, price);
                    const phoneNumber = '6282192347565';
                    const url = `https://wa.me/${phoneNumber}?text=${message}`;
                    window.open(url, '_blank');
                });
            });

            const hamburgerBtn = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (hamburgerBtn && mobileMenu) {
                hamburgerBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('active');
                    hamburgerBtn.classList.toggle('active');
                });

                document.querySelectorAll('#mobile-menu a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.remove('active');
                        hamburgerBtn.classList.remove('active');
                    });
                });

                document.addEventListener('click', (e) => {
                    if (!hamburgerBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                        mobileMenu.classList.remove('active');
                        hamburgerBtn.classList.remove('active');
                    }
                });
            }
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', (e) => {
                    const name = e.target.getAttribute('data-name');
                    const price = parseInt(e.target.getAttribute('data-price'));
                    
                    const existingItemIndex = cart.findIndex(item => item.name === name);
                    
                    if (existingItemIndex !== -1) {
                        cart[existingItemIndex].quantity += 1;
                    } else {
                        cart.push({ name, price, quantity: 1 });
                    }
                    
                    saveCart();
                    updateCartCount();
                    
                    const toast = document.createElement('div');
                    toast.className = 'form-success';
                    toast.innerHTML = `
                        <i class="fas fa-check-circle"></i>
                        <span>${name} ditambahkan ke keranjang!</span>
                    `;
                    document.body.appendChild(toast);
                    
                    setTimeout(() => {
                        if (document.body.contains(toast)) {
                            document.body.removeChild(toast);
                        }
                    }, 3000);
                });
            });

            const menuTabs = document.querySelectorAll('.menu-tab');
            const menuCategories = document.querySelectorAll('.menu-category');
            const menuItems = document.querySelectorAll('.menu-item-card');
            
            menuTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    menuTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    menuCategories.forEach(cat => cat.classList.remove('active'));
                    const categoryId = tab.getAttribute('data-category');
                    if (categoryId === 'all') {
                        document.getElementById('all').classList.add('active');
                    } else {
                        document.getElementById(categoryId).classList.add('active');
                        const categoryContainer = document.getElementById(categoryId).querySelector('.grid');
                        categoryContainer.innerHTML = '';
                        menuItems.forEach(item => {
                            const itemCategories = item.getAttribute('data-category').split(' ');
                            if (itemCategories.includes(categoryId)) {
                                const clonedItem = item.cloneNode(true);
                                categoryContainer.appendChild(clonedItem);
     
                                clonedItem.querySelector('.add-to-cart').addEventListener('click', (e) => {
                                    const name = e.target.getAttribute('data-name');
                                    const price = parseInt(e.target.getAttribute('data-price'));
                                    
                                    const existingItemIndex = cart.findIndex(item => item.name === name);
                                    
                                    if (existingItemIndex !== -1) {
                                        cart[existingItemIndex].quantity += 1;
                                    } else {
                                        cart.push({ name, price, quantity: 1 });
                                    }
                                    
                                    saveCart();
                                    updateCartCount();
                                    
                                    const toast = document.createElement('div');
                                    toast.className = 'form-success';
                                    toast.innerHTML = `
                                        <i class="fas fa-check-circle"></i>
                                        <span>${name} ditambahkan ke keranjang!</span>
                                    `;
                                    document.body.appendChild(toast);
                                    
                                    setTimeout(() => {
                                        if (document.body.contains(toast)) {
                                            document.body.removeChild(toast);
                                        }
                                    }, 3000);
                                });

                                clonedItem.querySelector('.whatsapp-order-btn').addEventListener('click', (e) => {
                                    const name = e.target.getAttribute('data-name');
                                    const price = parseInt(e.target.getAttribute('data-price'));
                                    
                                    const message = generateSingleOrderMessage(name, price);
                                    const phoneNumber = '6282192347565';
                                    const url = `https://wa.me/${phoneNumber}?text=${message}`;
                                    window.open(url, '_blank');
                                });
                            }
                        });
                    }
                });
            });
            updateCartCount();
        });
    </script>
</body>
</html>