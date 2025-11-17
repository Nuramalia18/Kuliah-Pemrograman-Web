<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $branches = [
            [
                'name' => 'UNM Parangtambung',
                'address' => 'Jl. Mallengkeri Raya (Depan Kampus UNM Parangtambung)'
            ],
            [
                'name' => 'UNM Gunungsari',
                'address' => 'Jl. Raya Pendidikan (Depan kampus UNM Gunungsari)'
            ],
            [
                'name' => 'Hotel Lamacca',
                'address' => 'Jl. A.P. Pettarani (Samping Hotel Lamacca)'
            ],
            [
                'name' => 'KMR.DIY Samata',
                'address' => 'Jl. Sultan Alauddin Samata (Depan KMR.DIY Samata)'
            ],
            [
                'name' => 'UIN Samata',
                'address' => 'Jl. Sultan Alauddin Samata (Depan Kampus UIN Samata)'
            ],
            [
                'name' => 'Patria Artha',
                'address' => 'Jl. Tun Abdul Razak (Depan Kampus Patria Artha)'
            ],
            [
                'name' => 'SPBU Hertasning',
                'address' => 'Jl. Hertasning Raya (Depan SPBU Hertasning)'
            ],
            [
                'name' => 'Modern Estate',
                'address' => 'Jl. Tun Abdul Razak (Depan Modern Estate)'
            ]
        ];

        $eventTypes = [
            [
                'icon' => 'school',
                'title' => 'Kegiatan Sekolah',
                'description' => 'Seminar, workshop, acara sekolah'
            ],
            [
                'icon' => 'music',
                'title' => 'Festival & Konser',
                'description' => 'Event musik dan festival budaya'
            ],
            [
                'icon' => 'building',
                'title' => 'Acara Kantor',
                'description' => 'Meeting, training, company event'
            ],
            [
                'icon' => 'users',
                'title' => 'Acara Lainnya',
                'description' => 'Pernikahan, ulang tahun, gathering'
            ]
        ];

        return view('contact', compact('branches', 'eventTypes'));
    }

 
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda telah berhasil dikirim! Kami akan menghubungi Anda segera.'
        ]);
    }
    public function getBranches()
    {
        $branches = [
            [
                'name' => 'UNM Parangtambung',
                'address' => 'Jl. Mallengkeri Raya (Depan Kampus UNM Parangtambung)'
            ],
        ];

        return response()->json($branches);
    }
}