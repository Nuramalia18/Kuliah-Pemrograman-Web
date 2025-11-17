@extends('layouts.app')

@section('title', 'Menu - KOPI CUSS')

@section('content')
<!-- Menu Section -->
<section id="menu" class="menu-section min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="font-pacifico text-4xl md:text-5xl text-red-600 mb-4">Menu Lengkap</h2>
            <p class="text-gray-400 text-lg mb-8">Pilihan terbaik untuk setiap momen spesial Anda</p>
            
            <!-- Category Tabs -->
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
                        <img src="{{ asset('image/signature.jpeg') }}" alt="Kopi Signature Cuss" class="menu-item-image">
                        <div class="badge badge-recommended">🔥 Recommended</div>
                    </div>
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Kopi Signature Cuss</h3>
                        <p class="menu-item-description">Racikan spesial khas KOPI CUSS dengan cita rasa yang unik dan nikmat untuk pengalaman ngopi yang tak terlupakan.</p>
                        <div class="menu-item-footer">
                            <span class="menu-item-price">12K</span>
                            <div class="menu-item-actions">
                                <button class="whatsapp-order-btn text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Kopi Signature Cuss" data-price="12">
                                    <i class="fab fa-whatsapp mr-1"></i> Pesan
                                </button>
                                <button class="add-to-cart text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Kopi Signature Cuss" data-price="12">
                                    <i class="fas fa-cart-plus mr-1"></i> Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item-card hover-scale" data-category="kopi best-seller">
                    <div class="relative">
                        <img src="{{ asset('image/kopi aren.jpeg') }}" alt="Kopi Aren" class="menu-item-image">
                        <div class="badge badge-best">⭐ Best Seller</div>
                    </div>
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Kopi Aren</h3>
                        <p class="menu-item-description">Kopi dengan gula aren asli yang memberikan rasa manis alami dan aroma khas yang menggugah selera.</p>
                        <div class="menu-item-footer">
                            <span class="menu-item-price">10K</span>
                            <div class="menu-item-actions">
                                <button class="whatsapp-order-btn text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Kopi Aren" data-price="10">
                                    <i class="fab fa-whatsapp mr-1"></i> Pesan
                                </button>
                                <button class="add-to-cart text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Kopi Aren" data-price="10">
                                    <i class="fas fa-cart-plus mr-1"></i> Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item-card hover-scale" data-category="kopi">
                    <div class="relative">
                        <img src="{{ asset('image/butterscoth.jpeg') }}" alt="Kopi Butterscotch" class="menu-item-image">
                        <div class="badge badge-recommended">🔥 Recommended</div>
                    </div>
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Kopi Butterscotch</h3>
                        <p class="menu-item-description">Perpaduan sempurna kopi dengan butterscotch yang manis dan creamy, menciptakan harmoni rasa yang memanjakan.</p>
                        <div class="menu-item-footer">
                            <span class="menu-item-price">12K</span>
                            <div class="menu-item-actions">
                                <button class="whatsapp-order-btn text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Kopi Butterscotch" data-price="12">
                                    <i class="fab fa-whatsapp mr-1"></i> Pesan
                                </button>
                                <button class="add-to-cart text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Kopi Butterscotch" data-price="12">
                                    <i class="fas fa-cart-plus mr-1"></i> Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item-card hover-scale" data-category="non-kopi">
                    <div class="relative">
                        <img src="{{ asset('image/green.jpeg') }}" alt="Greentea Cuss" class="menu-item-image">
                        <div class="badge badge-recommended">🌿 Recommended</div>
                    </div>
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Greentea Cuss</h3>
                        <p class="menu-item-description">Teh hijau segar dengan rasa yang menenangkan, cocok untuk menemani saat-saat santai Anda.</p>
                        <div class="menu-item-footer">
                            <span class="menu-item-price">10K</span>
                            <div class="menu-item-actions">
                                <button class="whatsapp-order-btn text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Greentea Cuss" data-price="10">
                                    <i class="fab fa-whatsapp mr-1"></i> Pesan
                                </button>
                                <button class="add-to-cart text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Greentea Cuss" data-price="10">
                                    <i class="fas fa-cart-plus mr-1"></i> Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item-card hover-scale" data-category="non-kopi">
                    <div class="relative">
                        <img src="{{ asset('image/coklat.jpeg') }}" alt="Chocolate Cuss" class="menu-item-image">
                        <div class="badge badge-recommended">🍫 Recommended</div>
                    </div>
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Chocolate Cuss</h3>
                        <p class="menu-item-description">Cokelat lezat dengan rasa yang creamy dan nikmat, memberikan kenikmatan yang sempurna bagi pecinta cokelat.</p>
                        <div class="menu-item-footer">
                            <span class="menu-item-price">10K</span>
                            <div class="menu-item-actions">
                                <button class="whatsapp-order-btn text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Chocolate Cuss" data-price="10">
                                    <i class="fab fa-whatsapp mr-1"></i> Pesan
                                </button>
                                <button class="add-to-cart text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Chocolate Cuss" data-price="10">
                                    <i class="fas fa-cart-plus mr-1"></i> Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item-card hover-scale" data-category="non-kopi">
                    <div class="relative">
                        <img src="{{ asset('image/lecy.jpeg') }}" alt="Lychee Tea" class="menu-item-image">
                        <div class="badge badge-recommended">🍓 Recommended</div>
                    </div>
                    <div class="menu-item-content">
                        <h3 class="menu-item-title">Lychee Tea</h3>
                        <p class="menu-item-description">Kesegaran leci yang menyegarkan untuk hari-hari panas, memberikan sensasi rasa buah yang nikmat dan menyegarkan.</p>
                        <div class="menu-item-footer">
                            <span class="menu-item-price">10K</span>
                            <div class="menu-item-actions">
                                <button class="whatsapp-order-btn text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Lychee Tea" data-price="10">
                                    <i class="fab fa-whatsapp mr-1"></i> Pesan
                                </button>
                                <button class="add-to-cart text-white px-4 py-2 rounded-full transition text-sm" 
                                        data-name="Lychee Tea" data-price="10">
                                    <i class="fas fa-cart-plus mr-1"></i> Keranjang
                                </button>
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

<a href="https://wa.me/6282349869867" target="_blank" class="floating-action" id="whatsapp-btn">
    <i class="fab fa-whatsapp"></i>
</a>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuTabs = document.querySelectorAll('.menu-tab');
    const menuCategories = document.querySelectorAll('.menu-category');
    const menuItems = document.querySelectorAll('.menu-item-card');
    
    menuTabs.forEach(tab => {
        tab.addEventListener('click', () => {
    
            menuTabs.forEach(t => t.classList.remove('active'));

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
                        attachEventListeners(clonedItem);
                    }
                });
            }
        });
    });

    function attachEventListeners(item) {
        item.querySelector('.add-to-cart').addEventListener('click', function(e) {
            const name = this.getAttribute('data-name');
            const price = parseInt(this.getAttribute('data-price'));
            addToCart(name, price);
        });
        item.querySelector('.whatsapp-order-btn').addEventListener('click', function(e) {
            const name = this.getAttribute('data-name');
            const price = parseInt(this.getAttribute('data-price'));
            orderViaWhatsApp(name, price);
        });
    }
    document.querySelectorAll('.menu-item-card').forEach(item => {
        attachEventListeners(item);
    });

    function addToCart(name, price) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItemIndex = cart.findIndex(item => item.name === name);
        
        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += 1;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        showToast(`${name} ditambahkan ke keranjang!`);
    }

    function orderViaWhatsApp(name, price) {
        const message = `Halo KOPI CUSS, saya ingin memesan:\n\n• ${name} x1 = ${price}K\n\nTotal: ${price}K\n\nMohon konfirmasi ketersediaan dan informasi pengiriman. Terima kasih!`;
        const encodedMessage = encodeURIComponent(message);
        const phoneNumber = '6282349869867';
        const url = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
        window.open(url, '_blank');
    }
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        const formattedCount = totalItems >= 1000 ? (totalItems / 1000).toFixed(1) + 'k' : totalItems.toString();
        
        document.querySelectorAll('.cart-count').forEach(element => {
            element.textContent = formattedCount;
        });
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'form-success';
        toast.innerHTML = `
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 3000);
    }
    document.addEventListener('DOMContentLoaded', function() {

    function attachMenuEventListeners() {
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                
                if (window.cartManager) {
                    window.cartManager.addItem(name, price);
                } else {
                    console.error('Cart manager not initialized');
                }
            });
        });
    
        document.querySelectorAll('.whatsapp-order-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                
                if (window.cartManager) {
                    const message = window.cartManager.generateSingleOrderMessage(name, price);
                    const phoneNumber = '6282349869867';
                    const url = `https://wa.me/${phoneNumber}?text=${message}`;
                    window.open(url, '_blank');
                }
            });
        });
    }
  
    attachMenuEventListeners();

    const menuTabs = document.querySelectorAll('.menu-tab');
    if (menuTabs.length > 0) {
        menuTabs.forEach(tab => {
            tab.addEventListener('click', function() {

                setTimeout(attachMenuEventListeners, 100);
            });
        });
    }
});

    updateCartCount();
});
</script>
@endsection