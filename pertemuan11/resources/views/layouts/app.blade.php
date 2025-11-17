<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KOPI CUSS')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        /* Semua CSS dari kode asli Anda di sini */
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
        
        /* Hero Section Styles */
        .hero-title {
            font-size: 5rem;
            background: linear-gradient(45deg, #dc2626, #ea580c, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        .hero-subtitle {
            font-size: 2.5rem;
            color: white;
            font-weight: 300;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero-description {
            font-size: 1.5rem;
            color: #fecaca;
            margin-bottom: 2rem;
            font-weight: 400;
        }
        
        .color-change-btn { 
            background: linear-gradient(45deg, #dc2626, #ea580c, #dc2626);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            transition: all 0.3s ease;
            border: none;
            font-size: 1.1rem;
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
        
        .magnetic-btn {
            transition: all 0.3s ease;
        }
        
        .magnetic-btn:hover {
            transform: translateY(-2px) scale(1.05);
        }
        
        /* Navigation Styles */
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
        
        .mobile-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(39,39,42,0.95); backdrop-filter: blur(10px); border-bottom: 2px solid #dc2627; z-index: 40; }
        .mobile-menu.active { display: block; } .mobile-menu ul { padding: 1rem 0; } .mobile-menu li { padding: 0.75rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); } .mobile-menu li:last-child { border-bottom: none; }
        .mobile-menu a { display: flex; align-items: center; justify-content: space-between; font-weight: 600; } .mobile-menu a:hover { color: #dc2626; }
        .hamburger { transition: all 0.3s ease; } .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px,5px); } .hamburger.active span:nth-child(2) { opacity: 0; } .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(7px,-6px); }
        .hamburger span { display: block; width: 25px; height: 3px; background-color: white; margin: 5px 0; transition: all 0.3s ease; }
        
        /* Pastikan body memiliki padding untuk nav fixed */
        body {
            padding-top: 80px;
        }
        
        /* Cart Modal Styles */
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
    /* ===== CONTACT PAGE SPECIFIC STYLES ===== */
.contact-hero {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    margin-top: -80px;
    padding-top: 80px;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(139, 69, 19, 0.4) 0%, rgba(101, 67, 33, 0.6) 100%);
    z-index: 1;
}

.contact-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 800px;
    padding: 0 20px;
}

.contact-hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    z-index: 0;
    filter: brightness(1.1) contrast(1.1);
    transform: scale(1.05);
    transition: transform 0.5s ease;
}

.contact-section {
    position: relative;
    padding: 80px 0;
    overflow: hidden;
}

.contact-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1600') center/cover no-repeat;
    opacity: 0.1;
    z-index: -1;
}

.contact-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(24, 24, 27, 0.9), rgba(39, 39, 42, 0.95));
    z-index: -1;
}

/* Contact Form Styles */
.contact-form input, .contact-form textarea { 
    background: rgba(255,255,255,0.1); 
    border: 1px solid rgba(255,255,255,0.2); 
    border-radius: 12px; 
    padding: 14px; 
    color: white; 
    width: 100%; 
    transition: all 0.3s ease; 
    font-size: 16px;
}

.contact-form input:focus, .contact-form textarea:focus { 
    outline: none; 
    border-color: #dc2626; 
    background: rgba(255,255,255,0.15); 
    box-shadow: 0 0 0 3px rgba(220,38,38,0.1); 
}

.contact-form input::placeholder, .contact-form textarea::placeholder { 
    color: rgba(255,255,255,0.6); 
}

.contact-info-card {
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 30px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.1);
    height: 100%;
    backdrop-filter: blur(10px);
}

.contact-info-card:hover {
    transform: translateY(-5px);
    border-color: rgba(220, 38, 38, 0.5);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

/* Contact Methods */
.contact-methods {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 20px;
    justify-content: center;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.05);
    padding: 12px 20px;
    border-radius: 50px;
    transition: all 0.3s ease;
    color: white;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.1);
}

.contact-method:hover {
    background: rgba(220, 38, 38, 0.2);
    color: white;
    transform: translateY(-2px);
}

.contact-method i {
    color: #dc2626;
    font-size: 1.2rem;
}

.whatsapp-link {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.05);
    padding: 12px 20px;
    border-radius: 50px;
    transition: all 0.3s ease;
    color: white;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.1);
}

.whatsapp-link:hover {
    background: rgba(37, 211, 102, 0.2);
    color: white;
    transform: translateY(-2px);
}

.whatsapp-link i {
    color: #25D366;
    font-size: 1.2rem;
}

/* Social Links */
.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

.social-link {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    color: white;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.1);
}

.social-link:hover {
    background: #dc2626;
    transform: translateY(-3px) scale(1.1);
    color: white;
}

/* Event Catering Section */
.event-catering-section {
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    padding: 30px;
    border: 1px solid rgba(255,255,255,0.1);
    height: 100%;
    backdrop-filter: blur(10px);
}

.event-catering-title {
    text-align: center;
    margin-bottom: 30px;
}

.event-catering-title h2 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #dc2626;
    margin-bottom: 10px;
}

.event-catering-title p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.1rem;
}

.event-types {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.event-type {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 15px;
    padding: 25px 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.1);
}

.event-type:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-5px);
    border-color: rgba(220, 38, 38, 0.5);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.event-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    background: linear-gradient(45deg, #dc2626, #ea580c);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.event-type h3 {
    font-weight: 600;
    color: white;
    margin-bottom: 8px;
    font-size: 1.1rem;
}

.event-type p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    line-height: 1.4;
}

.event-cta {
    background: linear-gradient(45deg, #25d366, #128c7e);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: bold;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    display: block;
    width: 100%;
    text-decoration: none;
    margin-top: 20px;
}

.event-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
}

/* Hours Container */
.hours-container {
    margin-top: 20px;
}

.hour-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
    padding: 15px;
    background: rgba(255,255,255,0.05);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.hour-item:hover {
    background: rgba(255,255,255,0.08);
    transform: translateX(5px);
}

.hour-icon {
    width: 50px;
    height: 50px;
    background: rgba(220, 38, 38, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.hour-icon i {
    color: #dc2626;
    font-size: 1.2rem;
}

.hour-details h3 {
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 1.1rem;
    color: white;
}

.hour-details p {
    color: rgba(255, 255, 255, 0.7);
}

/* Branch Locations */
.branch-locations {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.branch-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 25px;
    border-left: 4px solid #dc2626;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
}

.branch-card:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.branch-name {
    font-weight: bold;
    color: #dc2626;
    margin-bottom: 12px;
    font-size: 1.2rem;
}

.branch-address {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.5;
}

/* Floating Action */
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
    text-decoration: none;
}

.floating-action:hover {
    transform: scale(1.1);
    background: #b91c1c;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(220, 38, 38, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
}

/* Image Enhancement */
.image-enhancement {
    filter: brightness(1.15) contrast(1.2) saturate(1.1);
    transform: scale(1.02);
}

.sharp-image {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-hero {
        min-height: 50vh;
        padding-top: 100px;
    }
    
    .contact-hero h1 {
        font-size: 2.5rem !important;
    }
    
    .contact-methods {
        flex-direction: column;
        align-items: center;
    }
    
    .event-types {
        grid-template-columns: 1fr;
    }
    
    .branch-locations {
        grid-template-columns: 1fr;
    }
    
    .contact-section {
        padding: 50px 0;
    }
}

@media (max-width: 480px) {
    .contact-hero h1 {
        font-size: 2rem !important;
    }
    
    .contact-hero-content {
        padding: 0 15px;
    }
    
    .event-catering-section,
    .contact-info-card {
        padding: 20px;
    }
    
    .branch-card {
        padding: 20px;
    }
}
/* ===== ABOUT PAGE SPECIFIC STYLES ===== */
.about-background {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.about-background img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.08;
    animation: zoomSlow 20s ease-in-out infinite;
}

@keyframes zoomSlow {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.about-background::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), transparent);
}

.section-title {
    background: linear-gradient(135deg, #dc2626, #ef4444, #f87171);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: titleGlow 3s ease-in-out infinite;
    position: relative;
    display: inline-block;
}

@keyframes titleGlow {
    0%, 100% { filter: brightness(1); }
    50% { filter: brightness(1.3); }
}

.fade-in-up {
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in-up:nth-child(1) { animation-delay: 0.1s; }
.fade-in-up:nth-child(2) { animation-delay: 0.2s; }
.fade-in-up:nth-child(3) { animation-delay: 0.3s; }
.fade-in-up:nth-child(4) { animation-delay: 0.4s; }
.fade-in-up:nth-child(5) { animation-delay: 0.5s; }

.feature-card {
    position: relative;
    overflow: hidden;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.1);
    transition: all 0.4s ease;
    border-radius: 20px;
    padding: 25px;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(220, 38, 38, 0.2), transparent);
    transition: left 0.5s ease;
}

.feature-card:hover::before {
    left: 100%;
}

.feature-card:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(220, 38, 38, 0.5);
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(220, 38, 38, 0.3);
}

.feature-icon {
    transition: all 0.4s ease;
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #dc2626, #991b1b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
    margin-bottom: 15px;
}

.feature-card:hover .feature-icon {
    transform: scale(1.2) rotate(10deg);
    box-shadow: 0 15px 30px rgba(220, 38, 38, 0.5);
}

.image-container {
    position: relative;
    perspective: 1000px;
}

.main-image {
    border-radius: 25px;
    box-shadow: 0 25px 60px rgba(220, 38, 38, 0.4);
    transition: all 0.5s ease;
    animation: imageFloat 6s ease-in-out infinite;
    border: 3px solid rgba(220, 38, 38, 0.3);
}

@keyframes imageFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.main-image:hover {
    transform: scale(1.05) rotateY(5deg);
    box-shadow: 0 35px 80px rgba(220, 38, 38, 0.6);
}

.image-decoration {
    position: absolute;
    bottom: -25px;
    right: -25px;
    width: 250px;
    height: 250px;
    background: linear-gradient(135deg, #dc2626, #991b1b);
    border-radius: 25px;
    z-index: -1;
    animation: decorationPulse 4s ease-in-out infinite;
    opacity: 0.7;
}

@keyframes decorationPulse {
    0%, 100% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

/* Stats Section */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin: 60px 0;
}

.stat-card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #dc2626, #ea580c);
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(220, 38, 38, 0.3);
    border-color: rgba(220, 38, 38, 0.5);
}

.stat-number {
    font-size: 3rem;
    font-weight: bold;
    background: linear-gradient(135deg, #dc2626, #ea580c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 10px;
}

.stat-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.1rem;
    font-weight: 600;
}

/* Mission Section */
.mission-section {
    background: rgba(255,255,255,0.03);
    border-radius: 30px;
    padding: 50px;
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    margin: 60px 0;
}

.mission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.mission-item {
    text-align: center;
    padding: 30px;
}

.mission-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #dc2626, #991b1b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
    transition: all 0.4s ease;
}

.mission-item:hover .mission-icon {
    transform: scale(1.1) rotate(15deg);
    box-shadow: 0 15px 30px rgba(220, 38, 38, 0.5);
}

/* Responsive Design */
@media (max-width: 768px) {
    .section-title {
        font-size: 2.5rem !important;
    }
    
    .image-decoration {
        width: 150px;
        height: 150px;
        bottom: -15px;
        right: -15px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .mission-section {
        padding: 30px 20px;
    }
    
    .feature-card {
        padding: 20px;
    }
    
    .feature-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 2rem !important;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .mission-grid {
        grid-template-columns: 1fr;
    }
}
/* ===== MENU PAGE SPECIFIC STYLES ===== */
.menu-image-container { 
    position: relative; 
    overflow: hidden; 
    border-radius: 1rem; 
}

.menu-image { 
    width: 100%; 
    height: 250px; 
    object-fit: cover; 
    object-position: center; 
    transition: transform 0.5s ease; 
}

.menu-image:hover { 
    transform: scale(1.1); 
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
    padding: 12px 24px;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.2);
}

.menu-tab.active {
    background: #dc2626;
    color: white;
    border-color: #dc2626;
    box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
}

.menu-tab:hover {
    background: rgba(220, 38, 38, 0.7);
    transform: translateY(-2px);
}

.menu-category {
    display: none;
}

.menu-category.active {
    display: block;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
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
    backdrop-filter: blur(10px);
}

.menu-item-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
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
    padding: 25px;
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
    line-height: 1.6;
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
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: bold;
    z-index: 10;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
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

/* Menu Section Background */
.menu-section {
    background: linear-gradient(135deg, rgba(24, 24, 27, 0.95), rgba(39, 39, 42, 0.98));
    position: relative;
    overflow: hidden;
}

.menu-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1600') center/cover no-repeat;
    opacity: 0.05;
    z-index: -1;
}

/* Button Styles */
.whatsapp-order-btn, .add-to-cart {
    transition: all 0.3s ease;
    font-weight: 600;
}

.whatsapp-order-btn {
    background: linear-gradient(45deg, #25d366, #128c7e);
}

.whatsapp-order-btn:hover {
    background: linear-gradient(45deg, #128c7e, #25d366);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
}

.add-to-cart {
    background: linear-gradient(45deg, #dc2626, #b91c1c);
}

.add-to-cart:hover {
    background: linear-gradient(45deg, #b91c1c, #dc2626);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 38, 38, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .menu-category-tabs {
        gap: 8px;
    }
    
    .menu-tab {
        padding: 10px 16px;
        font-size: 0.9rem;
    }
    
    .menu-item-content {
        padding: 20px;
    }
    
    .menu-item-title {
        font-size: 1.3rem;
    }
    
    .menu-item-actions {
        flex-direction: column;
        gap: 8px;
    }
    
    .menu-item-actions button {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .menu-category-tabs {
        flex-direction: column;
        align-items: center;
    }
    
    .menu-tab {
        width: 200px;
        text-align: center;
    }
    
    .menu-item-footer {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .menu-item-actions {
        width: 100%;
    }
}
/* Enhanced Cart Styles */
.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #374151;
    transition: all 0.3s ease;
}

.cart-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    padding: 15px 10px;
    margin: 0 -10px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 4px;
}

.quantity-btn {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #dc2626;
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
}

.quantity-btn:hover {
    background: #b91c1c;
    transform: scale(1.1);
}

.quantity-btn:active {
    transform: scale(0.95);
}

.remove-btn {
    width: 28px;
    height: 28px;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.remove-btn:hover {
    background: #dc2626;
    transform: scale(1.1);
}

.empty-cart {
    text-align: center;
    padding: 60px 20px;
    color: #9ca3af;
}

.empty-cart i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Animation for cart count */
.animate-pulse {
    animation: pulse 0.3s ease-in-out;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

/* Scrollbar styling for cart items */
.cart-items::-webkit-scrollbar {
    width: 6px;
}

.cart-items::-webkit-scrollbar-track {
    background: #1f2937;
    border-radius: 3px;
}

.cart-items::-webkit-scrollbar-thumb {
    background: #dc2626;
    border-radius: 3px;
}

.cart-items::-webkit-scrollbar-thumb:hover {
    background: #b91c1c;
}
    </style>
</head>
<body class="bg-zinc-900 text-white">
    @include('partials.header')

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Cart Modal -->
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
                        <a href="#" id="whatsapp-order" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full transition flex items-center gap-2 text-lg font-semibold">
                            <i class="fab fa-whatsapp text-xl"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
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
                const phoneNumber = '6282349869867';
                const url = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(url, '_blank');
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

            updateCartCount();
        
            if (cart.length === 0) {
                cart = [
                    { name: "Kopi Aren", price: 10, quantity: 3 },
                    { name: "Kopi Signature Cuss", price: 12, quantity: 3 }
                ];
                saveCart();
                updateCartCount();
            }
            <script>
    document.addEventListener('DOMContentLoaded', () => {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartModal = document.getElementById('cart-modal');

        // ... kode yang sudah ada ...

        // Fungsi untuk menambah item ke cart
        function addToCart(productId, productName, productPrice, productImage = '') {
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                });
            }
            
            saveCart();
            updateCartCount();
            showAddToCartNotification(productName);
        }

        // Fungsi untuk menampilkan notifikasi
        function showAddToCartNotification(productName) {
            // Buat notifikasi
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-3';
            notification.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${productName} ditambahkan ke keranjang!</span>
            `;
            
            document.body.appendChild(notification);
            
            // Hapus notifikasi setelah 3 detik
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Update fungsi updateCartDisplay untuk menampilkan gambar
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
                    <div class="flex items-center gap-3 flex-1">
                        ${item.image ? `<img src="{{ asset('images/') }}/${item.image}" alt="${item.name}" class="w-12 h-12 rounded-lg object-cover">` : ''}
                        <div class="flex-1">
                            <div class="font-semibold text-white">${item.name}</div>
                            <div class="text-sm text-gray-400">Rp ${item.price}K</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="quantity-controls">
                            <button class="quantity-btn decrease" data-index="${index}">-</button>
                            <span class="quantity text-white mx-2">${item.quantity}</span>
                            <button class="quantity-btn increase" data-index="${index}">+</button>
                        </div>
                        <div class="font-semibold text-red-400 min-w-16 text-right">Rp ${itemTotal}K</div>
                        <button class="remove-btn" data-index="${index}" title="Hapus item">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });
            
            cartTotal.textContent = `Rp ${total}K`;
            
            // Add event listeners untuk tombol quantity
            document.querySelectorAll('.quantity-btn.decrease').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const index = parseInt(e.target.dataset.index);
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
                    const index = parseInt(e.target.dataset.index);
                    cart[index].quantity++;
                    saveCart();
                    updateCartDisplay();
                    updateCartCount();
                });
            });
            
            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const index = parseInt(e.target.closest('.remove-btn').dataset.index);
                    cart.splice(index, 1);
                    saveCart();
                    updateCartDisplay();
                    updateCartCount();
                });
            });
        }

        function generateOrderMessage() {
            if (cart.length === 0) return '';
            
            let message = "Halo KOPI CUSS! 👋\n\nSaya ingin memesan:\n\n";
            let total = 0;
            
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                message += `✨ ${item.name}\n`;
                message += `   Jumlah: ${item.quantity}\n`;
                message += `   Harga: Rp ${itemTotal}K\n\n`;
            });
            
            message += `💰 *Total: Rp ${total}K*\n\n`;
            message += "Silakan konfirmasi ketersediaan dan informasi lebih lanjut. Terima kasih! 🙏";
            
            return encodeURIComponent(message);
        }

        function updateWhatsAppLink() {
            const message = generateOrderMessage();
            const phoneNumber = '6282349869867';
            whatsappOrder.href = `https://wa.me/${phoneNumber}?text=${message}`;
        }

        const originalSaveCart = saveCart;
        saveCart = function() {
            originalSaveCart();
            updateWhatsAppLink();
        };

        updateCartCount();
        updateWhatsAppLink();
        window.addToCart = addToCart;
    });
</script>
        });
    </script>
</body>
</html>