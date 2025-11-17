@extends('layouts.app')

@section('title', 'Tentang Kami - KOPI CUSS')

@section('content')
<!-- About Hero Section -->
<section id="about" class="relative py-20 overflow-hidden min-h-screen flex items-center">
    <div class="about-background">
        <img src="{{ asset('image/foto1.jpeg') }}" alt="Coffee Shop Background">
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Image Section - Dipindahkan ke kiri -->
            <div class="image-container order-1 lg:order-1">
                <img src="{{ asset('image/menu.jpeg') }}" alt="Coffee Making Process" class="main-image w-full">
                <div class="image-decoration"></div>
            </div>

            <!-- Content Section - Dipindahkan ke kanan -->
            <div class="order-2 lg:order-2">
                <h2 class="font-pacifico text-4xl md:text-6xl section-title mb-8">Tentang KOPI CUSS</h2>
                
                <p class="text-xl text-gray-300 mb-6 leading-relaxed fade-in-up">
                    KOPI CUSS ngopi santai dimana aja.
                </p>
                
                <p class="text-xl text-gray-300 mb-6 leading-relaxed fade-in-up font-semibold text-red-400">
                    Take Your Coffee and Cuss Your Way.
                </p>
                
                <p class="text-lg text-gray-300 mb-6 leading-relaxed fade-in-up">
                    Fresh brew, good vibes, and pure dedication. Kopi Cuss hadir untuk mencerahkan hari anda dengan secangkir kopi berkualitas.
                </p>
                
                <p class="text-lg text-gray-300 mb-6 leading-relaxed fade-in-up">
                    Teman setia harimu siap nemenin fokus dan istirahatmu. Nggak perlu jauh-jauh, kopi cuss udah standby di titik strategis kampus dan kantormu.
                </p>
                
                <p class="text-lg text-gray-300 mb-10 leading-relaxed fade-in-up">
                    Kami menghadirkan berbagai pilihan menu kopi dan non-kopi yang sempurna untuk menemani setiap momen Anda, dari yang sederhana hingga acara spesial.
                </p>

                <!-- Features Grid -->
                <div class="space-y-5 mb-10">
                    <!-- Feature 1 -->
                    <div class="feature-card">
                        <div class="flex items-start space-x-4">
                            <div class="feature-icon">
                                🥤
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-red-400 mb-2">Cup Spesial</h4>
                                <p class="text-gray-300 leading-relaxed">Minuman disajikan dalam cup eksklusif KOPI CUSS yang membuat pengalaman ngopi semakin spesial</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card">
                        <div class="flex items-start space-x-4">
                            <div class="feature-icon">
                                ⚡
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-red-400 mb-2">Pelayanan Cepat</h4>
                                <p class="text-gray-300 leading-relaxed">Siap melayani pesanan Anda dengan cepat dan efisien tanpa mengorbankan kualitas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card">
                        <div class="flex items-start space-x-4">
                            <div class="feature-icon">
                                💰
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-red-400 mb-2">Harga Terjangkau</h4>
                                <p class="text-gray-300 leading-relaxed">Kualitas premium dengan harga bersahabat, cocok untuk kantong mahasiswa dan profesional</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ url('/menu') }}" class="color-change-btn text-white font-bold py-4 px-8 rounded-full inline-block text-lg shadow-2xl transition-all duration-400">
                        Lihat Menu Lengkap <i class="fas fa-arrow-right ml-2"></i>
                    </a>
        </div>
@endsection