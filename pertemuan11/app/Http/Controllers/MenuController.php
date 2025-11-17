<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = $this->getMenuItems();
        return view('menu', compact('menuItems'));
    }
    private function getMenuItems()
    {
        return [
            [
                'id' => 1,
                'name' => 'Kopi Signature Cuss',
                'price' => 12,
                'category' => 'kopi',
                'badge' => 'recommended',
                'image' => 'signature.jpeg',
                'description' => 'Racikan spesial khas KOPI CUSS dengan cita rasa yang unik dan nikmat untuk pengalaman ngopi yang tak terlupakan.'
            ],
            [
                'id' => 2,
                'name' => 'Kopi Aren',
                'price' => 10,
                'category' => 'kopi',
                'badge' => 'best',
                'image' => 'kopi aren.jpeg',
                'description' => 'Kopi dengan gula aren asli yang memberikan rasa manis alami dan aroma khas yang menggugah selera.'
            ],
            [
                'id' => 3,
                'name' => 'Kopi Butterscotch',
                'price' => 12,
                'category' => 'kopi',
                'badge' => 'recommended',
                'image' => 'butterscoth.jpeg',
                'description' => 'Perpaduan sempurna kopi dengan butterscotch yang manis dan creamy, menciptakan harmoni rasa yang memanjakan.'
            ],
            [
                'id' => 4,
                'name' => 'Greentea Cuss',
                'price' => 10,
                'category' => 'non-kopi',
                'badge' => 'recommended',
                'image' => 'green.jpeg',
                'description' => 'Teh hijau segar dengan rasa yang menenangkan, cocok untuk menemani saat-saat santai Anda.'
            ],
            [
                'id' => 5,
                'name' => 'Chocolate Cuss',
                'price' => 10,
                'category' => 'non-kopi',
                'badge' => 'recommended',
                'image' => 'coklat.jpeg',
                'description' => 'Cokelat lezat dengan rasa yang creamy dan nikmat, memberikan kenikmatan yang sempurna bagi pecinta cokelat.'
            ],
            [
                'id' => 6,
                'name' => 'Lychee Tea',
                'price' => 10,
                'category' => 'non-kopi',
                'badge' => 'recommended',
                'image' => 'lecy.jpeg',
                'description' => 'Kesegaran leci yang menyegarkan untuk hari-hari panas, memberikan sensasi rasa buah yang nikmat dan menyegarkan.'
            ]
        ];
    }
    public function getByCategory($category)
    {
        $menuItems = $this->getMenuItems();
        $filteredItems = array_filter($menuItems, function($item) use ($category) {
            return $item['category'] === $category;
        });

        return response()->json(array_values($filteredItems));
    }
    public function getBestSeller()
    {
        $menuItems = $this->getMenuItems();
        $bestSellers = array_filter($menuItems, function($item) {
            return $item['badge'] === 'best';
        });

        return response()->json(array_values($bestSellers));
    }
}