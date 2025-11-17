<!-- Navigation Bar -->
<nav class="fixed w-full z-50 bg-zinc-900/95 backdrop-blur-lg border-b-2 border-red-600 top-0 left-0 right-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg shadow-red-600/50 overflow-hidden logo-container">
                        <img src="{{ asset('image/foto1.jpeg') }}" alt="Logo Kopi" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="font-pacifico text-2xl text-red-600 drop-shadow-lg leading-none">KOPI</span>
                        <span class="font-pacifico text-2xl text-red-600 drop-shadow-lg leading-none">CUSS</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-8 items-center">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-red-600 transition font-semibold {{ request()->is('/') ? 'text-red-600' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('/menu') }}" class="hover:text-red-600 transition font-semibold {{ request()->is('menu') ? 'text-red-600' : '' }}">
                        Menu
                    </a>
                </li>
                <li>
                    <a href="{{ url('/about') }}" class="hover:text-red-600 transition font-semibold {{ request()->is('about') ? 'text-red-600' : '' }}">
                        Tentang
                    </a>
                </li>
                <li>
                    <a href="{{ url('/contact') }}" class="hover:text-red-600 transition font-semibold {{ request()->is('contact') ? 'text-red-600' : '' }}">
                        Kontak
                    </a>
                </li>
                <li>
                    <a href="#" class="cart-icon hover:text-red-600 transition font-semibold relative" id="cart-button">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="cart-count">0</span>
                    </a>
                </li>
            </ul>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center space-x-4">
                <a href="#" class="cart-icon relative" id="mobile-cart-button">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="cart-count">0</span>
                </a>
                <button id="hamburger-btn" class="text-white hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu">
        <ul>
            <li>
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-red-600' : '' }}">
                    Home <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <li>
                <a href="{{ url('/menu') }}" class="{{ request()->is('menu') ? 'text-red-600' : '' }}">
                    Menu <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <li>
                <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'text-red-600' : '' }}">
                    Tentang <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <li>
                <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'text-red-600' : '' }}">
                    Kontak <i class="fas fa-chevron-right"></i>
                </a>
            </li>
            <li>
                <a href="#" class="cart-icon relative flex justify-between items-center" id="mobile-menu-cart-button">
                    <span>Keranjang <i class="fas fa-shopping-cart ml-1"></i></span>
                    <span class="cart-count">0</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Cart Modal -->
<div id="cart-modal" class="cart-modal">
    <div class="cart-content">
        <div class="cart-header">
            <h2 class="text-xl font-bold text-red-600">Keranjang Pesanan</h2>
            <button id="close-cart" class="text-gray-400 hover:text-white text-2xl transition-colors">&times;</button>
        </div>
        <div class="cart-items" id="cart-items">
            <!-- Cart items will be populated here -->
        </div>
        <div class="cart-footer">
            <div class="flex justify-between items-center mb-4">
                <span class="font-semibold text-lg">Total:</span>
                <span class="font-bold text-red-600 text-xl" id="cart-total">Rp 0</span>
            </div>
            <div class="chat-integration">
                <p class="text-sm text-gray-300 mb-3">Kirim pesanan melalui WhatsApp:</p>
                <div class="flex gap-3 justify-center">
                    <a href="#" id="whatsapp-order" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-full transition-all duration-300 flex items-center gap-2 text-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fab fa-whatsapp text-xl"></i> Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast Container -->
<div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2"></div>

<!-- JavaScript for Navigation and Cart Functionality -->
<script>
// Cart Management System
class CartManager {
    constructor() {
        this.cart = this.loadCart();
        this.init();
    }

    // Initialize cart functionality
    init() {
        this.updateCartCount();
        this.setupEventListeners();
    }

    // Load cart from localStorage
    loadCart() {
        try {
            return JSON.parse(localStorage.getItem('cart')) || [];
        } catch (error) {
            console.error('Error loading cart:', error);
            return [];
        }
    }

    // Save cart to localStorage
    saveCart() {
        try {
            localStorage.setItem('cart', JSON.stringify(this.cart));
        } catch (error) {
            console.error('Error saving cart:', error);
        }
    }

    // Add item to cart
    addItem(name, price) {
        const existingItemIndex = this.cart.findIndex(item => item.name === name);
        
        if (existingItemIndex !== -1) {
            this.cart[existingItemIndex].quantity += 1;
        } else {
            this.cart.push({ 
                name, 
                price: parseInt(price), 
                quantity: 1 
            });
        }
        
        this.saveCart();
        this.updateCartCount();
        this.showToast(`${name} ditambahkan ke keranjang!`, 'success');
    }

    // Remove item from cart
    removeItem(index) {
        if (index >= 0 && index < this.cart.length) {
            this.cart.splice(index, 1);
            this.saveCart();
            this.updateCartCount();
            this.updateCartDisplay();
        }
    }

    // Update item quantity
    updateQuantity(index, change) {
        if (index >= 0 && index < this.cart.length) {
            this.cart[index].quantity += change;
            
            if (this.cart[index].quantity <= 0) {
                this.removeItem(index);
            } else {
                this.saveCart();
                this.updateCartCount();
                this.updateCartDisplay();
            }
        }
    }

    // Update cart count display
    updateCartCount() {
        const totalItems = this.cart.reduce((total, item) => total + item.quantity, 0);
        const formattedCount = this.formatCount(totalItems);
        
        document.querySelectorAll('.cart-count').forEach(element => {
            element.textContent = formattedCount;
            // Add animation
            element.classList.add('animate-pulse');
            setTimeout(() => element.classList.remove('animate-pulse'), 300);
        });
    }

    // Format count for display
    formatCount(count) {
        if (count >= 1000) {
            return (count / 1000).toFixed(1) + 'k';
        }
        return count.toString();
    }

    // Update cart display in modal
    updateCartDisplay() {
        const cartItems = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        
        if (!cartItems) return;

        cartItems.innerHTML = '';
        
        if (this.cart.length === 0) {
            cartItems.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart text-4xl mb-4 text-gray-500"></i>
                    <p class="text-gray-400">Keranjang Anda kosong</p>
                    <p class="text-sm text-gray-500 mt-2">Silakan tambahkan item dari menu</p>
                </div>
            `;
            cartTotal.textContent = 'Rp 0';
            return;
        }
        
        let total = 0;
        
        this.cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <div class="flex-1">
                    <div class="font-semibold text-white">${item.name}</div>
                    <div class="text-sm text-gray-400">Rp ${item.price}K</div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="quantity-controls">
                        <button class="quantity-btn decrease" data-index="${index}" type="button">
                            <i class="fas fa-minus text-xs"></i>
                        </button>
                        <span class="quantity text-white font-semibold min-w-8 text-center">${item.quantity}</span>
                        <button class="quantity-btn increase" data-index="${index}" type="button">
                            <i class="fas fa-plus text-xs"></i>
                        </button>
                    </div>
                    <div class="font-semibold text-white min-w-16 text-right">Rp ${itemTotal}K</div>
                    <button class="remove-btn" data-index="${index}" type="button" title="Hapus item">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </div>
            `;
            cartItems.appendChild(cartItem);
        });
        
        cartTotal.textContent = `Rp ${total}K`;
        
        // Reattach event listeners
        this.attachCartEventListeners();
    }

    // Attach event listeners to cart buttons
    attachCartEventListeners() {
        // Decrease quantity buttons
        document.querySelectorAll('.quantity-btn.decrease').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.updateQuantity(index, -1);
            });
        });
        
        // Increase quantity buttons
        document.querySelectorAll('.quantity-btn.increase').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.updateQuantity(index, 1);
            });
        });
        
        // Remove buttons
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.currentTarget.dataset.index);
                this.removeItem(index);
            });
        });
    }

    // Generate WhatsApp order message
    generateOrderMessage() {
        if (this.cart.length === 0) return '';
        
        let message = "Halo KOPI CUSS, saya ingin memesan:\n\n";
        let total = 0;
        
        this.cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            message += `• ${item.name} x${item.quantity} = Rp ${itemTotal}K\n`;
        });
        
        message += `\n*Total: Rp ${total}K*\n\n`;
        message += "Mohon konfirmasi ketersediaan dan informasi pengiriman. Terima kasih! 🙏";
        
        return encodeURIComponent(message);
    }

    // Generate single item order message
    generateSingleOrderMessage(name, price) {
        let message = `Halo KOPI CUSS, saya ingin memesan:\n\n`;
        message += `• ${name} x1 = Rp ${price}K\n\n`;
        message += `*Total: Rp ${price}K*\n\n`;
        message += "Mohon konfirmasi ketersediaan dan informasi pengiriman. Terima kasih! 🙏";
        
        return encodeURIComponent(message);
    }

    // Show toast notification
    showToast(message, type = 'success') {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toast = document.createElement('div');
        toast.className = `form-success ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
        toast.innerHTML = `
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        
        toastContainer.appendChild(toast);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 3000);
    }

    // Setup event listeners
    setupEventListeners() {
        // Cart modal toggle
        const cartModal = document.getElementById('cart-modal');
        const cartButton = document.getElementById('cart-button');
        const mobileCartButton = document.getElementById('mobile-cart-button');
        const mobileMenuCartButton = document.getElementById('mobile-menu-cart-button');
        const closeCart = document.getElementById('close-cart');
        const whatsappOrder = document.getElementById('whatsapp-order');

        // Open cart modal
        const openCartModal = () => {
            cartModal.classList.add('active');
            this.updateCartDisplay();
            document.body.style.overflow = 'hidden';
        };

        // Close cart modal
        const closeCartModal = () => {
            cartModal.classList.remove('active');
            document.body.style.overflow = '';
        };

        // Cart button events
        [cartButton, mobileCartButton, mobileMenuCartButton].forEach(btn => {
            if (btn) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    openCartModal();
                });
            }
        });

        // Close cart events
        if (closeCart) {
            closeCart.addEventListener('click', closeCartModal);
        }

        // Close modal when clicking outside
        if (cartModal) {
            cartModal.addEventListener('click', (e) => {
                if (e.target === cartModal) {
                    closeCartModal();
                }
            });
        }

        // WhatsApp order
        if (whatsappOrder) {
            whatsappOrder.addEventListener('click', (e) => {
                e.preventDefault();
                if (this.cart.length === 0) {
                    this.showToast('Keranjang Anda kosong. Silakan tambahkan item terlebih dahulu.', 'error');
                    return;
                }
                
                const message = this.generateOrderMessage();
                const phoneNumber = '6282349869867';
                const url = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(url, '_blank');
                closeCartModal();
            });
        }

        // Mobile menu functionality
        this.setupMobileMenu();
    }

    // Setup mobile menu functionality
    setupMobileMenu() {
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (!hamburgerBtn || !mobileMenu) return;

        const toggleMobileMenu = () => {
            mobileMenu.classList.toggle('active');
            hamburgerBtn.classList.toggle('active');
        };

        const closeMobileMenu = () => {
            mobileMenu.classList.remove('active');
            hamburgerBtn.classList.remove('active');
        };

        hamburgerBtn.addEventListener('click', toggleMobileMenu);

        // Close mobile menu when clicking on links
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!hamburgerBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
                closeMobileMenu();
            }
        });
    }
}

// Global cart instance
let cartManager;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    cartManager = new CartManager();
    
    // Make cartManager globally available for add to cart buttons
    window.cartManager = cartManager;
});

// Global function to add item to cart (for use in other files)
function addToCart(name, price) {
    if (window.cartManager) {
        window.cartManager.addItem(name, price);
    }
}

// Global function to order single item via WhatsApp
function orderViaWhatsApp(name, price) {
    if (window.cartManager) {
        const message = window.cartManager.generateSingleOrderMessage(name, price);
        const phoneNumber = '6282349869867';
        const url = `https://wa.me/${phoneNumber}?text=${message}`;
        window.open(url, '_blank');
    }
}
</script>