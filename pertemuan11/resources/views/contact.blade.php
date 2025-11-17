@extends('layouts.app')

@section('title', 'Kontak - KOPI CUSS')

@section('content')
<!-- Hero Section -->
<section class="contact-hero">
    <img src="{{ asset('image/foto1.jpeg') }}" 
         alt="Coffee Background" class="contact-hero-bg image-enhancement sharp-image">
    
    <!-- Animated Coffee Beans -->
    <div class="coffee-bean w-16 h-16 top-20 left-10" style="animation-delay: 0s;"></div>
    <div class="coffee-bean w-12 h-12 top-40 right-20" style="animation-delay: 1s;"></div>
    <div class="coffee-bean w-20 h-20 bottom-32 left-1/4" style="animation-delay: 2s;"></div>
    <div class="coffee-bean w-14 h-14 bottom-20 right-1/3" style="animation-delay: 1.5s;"></div>

    <div class="contact-hero-content">
        <div class="animate-fadeInUp">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Hubungi <span class="text-red-600">KOPI CUSS</span></h1>
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="h-1 w-20 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
                <span class="text-red-600 text-2xl">📞</span>
                <div class="h-1 w-20 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
            </div>
            <p class="text-xl md:text-2xl mb-8 text-gray-200 font-light">Siap Melayani Pesanan dan Pertanyaan Anda</p>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">Tim profesional kami siap membantu dengan senang hati untuk segala kebutuhan kopi Anda</p>
            
            <div class="contact-methods mt-8">
                <a href="https://www.instagram.com/kopicuss?igsh=MXRsMnp2cGpwemU4YQ==" target="_blank" class="contact-method">
                    <i class="fab fa-instagram"></i>
                    <span class="font-semibold">@kopicuss</span>
                </a>
                <a href="https://wa.me/6282349869867" target="_blank" class="whatsapp-link">
                    <i class="fab fa-whatsapp"></i>
                    <span class="font-semibold">WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="contact-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Services & Contact Info Grid -->
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Event Catering Section -->
            <div class="animate-fadeInUp">
                <div class="event-catering-section hover-scale">
                    <div class="event-catering-title">
                        <h2 class="font-pacifico text-3xl md:text-4xl">Layanan Pesanan</h2>
                        <p class="text-gray-300">Menerima pesanan untuk berbagai acara dan kegiatan</p>
                    </div>
                    
                    <div class="event-types">
                        <div class="event-type hover-scale">
                            <div class="event-icon">
                                <i class="fas fa-school"></i>
                            </div>
                            <h3>Kegiatan Sekolah</h3>
                            <p>Seminar, workshop, acara sekolah</p>
                        </div>
                        
                        <div class="event-type hover-scale">
                            <div class="event-icon">
                                <i class="fas fa-music"></i>
                            </div>
                            <h3>Festival & Konser</h3>
                            <p>Event musik dan festival budaya</p>
                        </div>
                        
                        <div class="event-type hover-scale">
                            <div class="event-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3>Acara Kantor</h3>
                            <p>Meeting, training, company event</p>
                        </div>
                        
                        <div class="event-type hover-scale">
                            <div class="event-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3>Acara Lainnya</h3>
                            <p>Pernikahan, ulang tahun, gathering</p>
                        </div>
                    </div>
                    
                    <a href="https://wa.me/6282349869867?text=Halo%20KOPI%20CUSS,%20saya%20ingin%20konsultasi%20untuk%20pemesanan%20catering%20event" 
                       target="_blank" 
                       class="event-cta hover-scale">
                        <i class="fab fa-whatsapp mr-2"></i> Konsultasi Event via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="animate-fadeInUp" style="animation-delay: 0.2s;">
                <div class="contact-info-card hover-scale">
                    <div class="space-y-6">
                       <div class="text-center mb-6">
                            <h2 class="text-3xl font-bold text-red-600 font-pacifico mb-2">Informasi Kontak</h2>
                            <p class="text-gray-400">Hubungi kami kapan saja</p>
                        </div>
                        
                        <!-- Instagram -->
                        <div class="flex items-center space-x-4 p-4 bg-zinc-800/50 rounded-xl">
                            <div class="w-14 h-14 bg-red-600/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fab fa-instagram text-red-400 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-white">Instagram</h3>
                                <p class="text-gray-300">@kopicuss</p>
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="hours-container">
                            <h3 class="font-semibold text-lg mb-4 text-white">Jam Operasional</h3>
                            <div class="hour-item hover-scale">
                                <div class="hour-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="hour-details">
                                    <h3 class="font-semibold">Cuss In</h3>
                                    <p>Setiap Hari: 09:00 WITA</p>
                                </div>
                            </div>
                            <div class="hour-item hover-scale">
                                <div class="hour-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="hour-details">
                                    <h3 class="font-semibold">Cuss Out</h3>
                                    <p>Setiap Hari: 18:00 WITA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="mt-8 pt-6 border-t border-gray-700">
                        <h3 class="font-semibold text-lg mb-4 text-white text-center">Ikuti Kami</h3>
                        <div class="social-links">
                            <a href="https://www.instagram.com/kopicuss?igsh=MXRsMnp2cGpwemU4YQ==" target="_blank" class="social-link">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://wa.me/6282349869867" target="_blank" class="social-link">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branch Locations -->
        <div class="mt-16 animate-fadeInUp" style="animation-delay: 0.6s;">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-red-600 mb-4 font-pacifico">Semua Lokasi KOPI CUSS</h2>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">Temukan gerai KopiCuss terdekat dari lokasi Anda. Kami hadir di berbagai titik strategis untuk melayani Anda</p>
            </div>
            
            <div class="branch-locations">
                @php
                    $branches = [
                        ['name' => 'UNM Parangtambung', 'address' => 'Jl. Mallengkeri Raya (Depan Kampus UNM Parangtambung)'],
                        ['name' => 'UNM Gunungsari', 'address' => 'Jl. Raya Pendidikan (Depan kampus UNM Gunungsari)'],
                        ['name' => 'Hotel Lamacca', 'address' => 'Jl. A.P. Pettarani (Samping Hotel Lamacca)'],
                        ['name' => 'KMR.DIY Samata', 'address' => 'Jl. Sultan Alauddin Samata (Depan KMR.DIY Samata)'],
                        ['name' => 'UIN Samata', 'address' => 'Jl. Sultan Alauddin Samata (Depan Kampus UIN Samata)'],
                        ['name' => 'Patria Artha', 'address' => 'Jl. Tun Abdul Razak (Depan Kampus Patria Artha)'],
                        ['name' => 'SPBU Hertasning', 'address' => 'Jl. Hertasning Raya (Depan SPBU Hertasning)'],
                        ['name' => 'Modern Estate', 'address' => 'Jl. Tun Abdul Razak (Depan Modern Estate)']
                    ];
                @endphp
                
                @foreach($branches as $branch)
                <div class="branch-card hover-scale">
                    <div class="branch-name">{{ $branch['name'] }}</div>
                    <div class="branch-address">{{ $branch['address'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6282349869867" target="_blank" class="floating-action" id="whatsapp-btn">
    <i class="fab fa-whatsapp"></i>
</a>
@endsection