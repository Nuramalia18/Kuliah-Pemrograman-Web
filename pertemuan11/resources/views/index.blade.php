@extends('layouts.app')

@section('title', 'Home - KOPI CUSS')

@section('content')
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0 flex items-center justify-center">
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/70 via-zinc-900/80 to-black/70"></div>
        <img src="{{ asset('image/foto2.jpeg') }}" alt="Coffee Background" class="w-full h-full object-cover opacity-70">
        <div class="absolute inset-0 bg-pattern"></div>
    </div>
    
    <div id="particles-container" class="absolute inset-0 overflow-hidden"></div>
    
    <div class="coffee-bean w-16 h-16 top-20 left-10" style="animation-delay: 0s;"></div>
    <div class="coffee-bean w-12 h-12 top-40 right-20" style="animation-delay: 1s;"></div>
    <div class="coffee-bean w-20 h-20 bottom-32 left-1/4" style="animation-delay: 2s;"></div>
    <div class="coffee-bean w-14 h-14 bottom-20 right-1/3" style="animation-delay: 1.5s;"></div>

    <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
        <div class="animate-fadeInUp">
           <h1 class="hero-title font-pacifico">KOPI CUSS</h1>
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="h-1 w-20 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
                <span class="text-red-600 text-2xl">🥤</span>
                <div class="h-1 w-20 bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
            </div>
            <p class="hero-subtitle">Singgah, Seruput, Cuuuss</p>
            <p class="hero-description">Sambut langkah Pertamamu dengan Kopi Cuss </p>
            <p class="text-2xl md:text-3xl mb-8 text-red-200 font-light">take your coffee and cuss your way!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/menu') }}" class="color-change-btn text-white font-bold py-4 px-8 rounded-full magnetic-btn">Lihat Menu</a>
                <a href="{{ url('/contact') }}" class="color-change-btn text-white font-bold py-4 px-8 rounded-full magnetic-btn">Pesan Sekarang</a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#about">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </a>
    </div>
</section>
@endsection