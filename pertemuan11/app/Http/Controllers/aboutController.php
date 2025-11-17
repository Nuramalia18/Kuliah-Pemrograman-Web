<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $features = [
            [
                'icon' => '🥤',
                'title' => 'Cup Spesial',
                'description' => 'Minuman disajikan dalam cup eksklusif KOPI CUSS yang membuat pengalaman ngopi semakin spesial'
            ],
            [
                'icon' => '⚡',
                'title' => 'Pelayanan Cepat',
                'description' => 'Siap melayani pesanan Anda dengan cepat dan efisien tanpa mengorbankan kualitas'
            ],
            [
                'icon' => '💰',
                'title' => 'Harga Terjangkau',
                'description' => 'Kualitas premium dengan harga bersahabat, cocok untuk kantong mahasiswa dan profesional'
            ]
        ];

        $stats = [
            [
                'number' => '8+',
                'label' => 'Lokasi Strategis'
            ],
            [
                'number' => '50+',
                'label' => 'Menu Variatif'
            ],
            [
                'number' => '1000+',
                'label' => 'Pelanggan Setia'
            ],
            [
                'number' => '24/7',
                'label' => 'Layanan Cepat'
            ]
        ];

        $missions = [
            [
                'icon' => 'heart',
                'title' => 'Kualitas Terbaik',
                'description' => 'Selalu menggunakan bahan-bahan terbaik untuk memberikan pengalaman kopi yang tak terlupakan'
            ],
            [
                'icon' => 'users',
                'title' => 'Komunitas',
                'description' => 'Membangun komunitas pecinta kopi yang solid dan saling mendukung'
            ],
            [
                'icon' => 'leaf',
                'title' => 'Ramah Lingkungan',
                'description' => 'Berkomitmen untuk praktik bisnis yang berkelanjutan dan ramah lingkungan'
            ]
        ];

        return view('about', compact('features', 'stats', 'missions'));
    }
}