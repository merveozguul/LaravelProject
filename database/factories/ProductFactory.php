<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        // 1. Gerçekçi Ürün Havuzu (Görsel, İsim, Marka ve Açıklama jilet gibi eşli)
        $productPool = [
            [
                'image' => 'uploads/products/default.jpg', // Fallback için havuz dışında kalacak, aşağıda Unsplash ID'leri var
                'name' => 'Minimalist Akıllı Saat', 'brand' => 'Apple', 'color' => 'Space Gray',
                'desc' => 'Stay connected with this premium smart watch featuring advanced health tracking, ambient always-on display, and seamless ecosystem integration.'
            ],
            [
                'name' => 'Pro Wireless Headphones', 'brand' => 'Sony', 'color' => 'Matt Black',
                'desc' => 'Experience industry-leading noise cancellation, crystal-clear audio fidelity, and up to 40 hours of continuous wireless playback.'
            ],
            [
                'name' => 'Air Max Retro Sneakers', 'brand' => 'Nike', 'color' => 'Crimson Red',
                'desc' => 'Step into ultimate comfort and classic street style with responsive air cushioning and breathable engineered mesh infrastructure.'
            ],
            [
                'name' => 'Vintage Polaroid Camera', 'brand' => 'Sony', 'color' => 'Pure White',
                'desc' => 'Capture memories instantly with point-and-shoot simplicity, built-in automatic flash, and authentic analog film chemistry.'
            ],
            [
                'name' => 'Classic Leather Oxford Shoes', 'brand' => 'Zara', 'color' => 'Midnight Blue',
                'desc' => 'Handcrafted premium leather dress shoes designed for modern elegance, refined corporate aesthetics, and long-lasting durability.'
            ],
            [
                'name' => 'Urban Aviator Sunglasses', 'brand' => 'Zara', 'color' => 'Emerald Green',
                'desc' => 'Protect your vision with polarized UV400 lenses wrapped in a lightweight, durable metallic frame tailored for modern urban lifestyles.'
            ],
            [
                'name' => 'Pro Gaming Headset RGB', 'brand' => 'Logitech', 'color' => 'Matt Black',
                'desc' => 'Dominate the battlefield with immersive 7.1 surround sound, a pro-grade noise-cancelling microphone, and dynamic RGB lighting.'
            ],
            [
                'name' => 'Smart Home Bluetooth Speaker', 'brand' => 'Samsung', 'color' => 'Pure White',
                'desc' => 'Fill your living space with rich 360-degree deep bass sound, smart voice assistant control, and elegant modern architectural styling.'
            ],
            [
                'name' => 'Premium Essential Cotton T-Shirt', 'brand' => 'Adidas', 'color' => 'Matt Black',
                'desc' => 'Crafted from 100% organic heavy cotton mesh, offering a relaxed modern fit, premium structural feel, and everyday versatile styling.'
            ],
            [
                'name' => 'Raw Denim Trucker Jacket', 'brand' => 'Puma', 'color' => 'Midnight Blue',
                'desc' => 'A timeless wardrobe cornerstone built from heavy-duty raw denim fabric with structured utility stitching and tailored modern tailoring.'
            ],
            [
                'name' => 'Oversized Fleece Sweatshirt', 'brand' => 'Nike', 'color' => 'Space Gray',
                'desc' => 'Unbelievably soft brushed fleece lining combined with a heavy drop-shoulder silhouette for maximum warmth and contemporary aesthetics.'
            ],
            [
                'name' => 'Waterproof Commuter Backpack', 'brand' => 'HP', 'color' => 'Matt Black',
                'desc' => 'Features a dedicated padded 16-inch laptop pocket, sleek geometric design defenses, and weather-resistant tactical fabrics.'
            ],
            [
                'name' => 'Tailored Slim-Fit Oxford Shirt', 'brand' => 'Zara', 'color' => 'Pure White',
                'desc' => 'Woven from premium long-staple cotton yarns, presenting a crisp, wrinkle-resistant finish optimized for smart-casual wear.'
            ]
        ];

        // Unsplash Görsel ID'leri (Yukarıdaki havuz sırasıyla %100 eşleşiyor)
        $unsplashIds = [
            '1523275335684-37898b6baf30', // Akıllı Saat
            '1505740420928-5e560c06d30e', // Kulaklık
            '1542291026-7eec264c27ff', // Spor Ayakkabı
            '1526170375885-4d8ecf77b99f', // Kamera
            '1560343090-f0409e92791a', // Deri Ayakkabı
            '1572635196237-14b3f281503f', // Gözlük
            '1583394838336-acd977736f90', // Oyuncu Kulaklığı
            '1608248597481-496100c8c836', // Hoparlör
            '1583743814966-8936f5b7be1a', // Siyah Tişört
            '1591047139829-d91aecb6caea', // Kot Ceket
            '1620799140408-edc6dcb6d633', // Sweatshirt
            '1618220179428-22790b461013', // Sırt Çantası
            '1562157873-818bc0726f68', // Gömlek
        ];

        // Havuzdan rastgele bir index seçiyoruz
        $randomIndex = $this->faker->numberBetween(0, count($productPool) - 1);
        $selectedProduct = $productPool[$randomIndex];

        // Veritabanında bir kategori bul veya oluştur
        $category = \App\Models\Category::inRandomOrder()->first() ?? \App\Models\Category::create(['name' => 'General Showcase']);

        return [
            'name' => $selectedProduct['name'],
            'brand' => $selectedProduct['brand'],
            'color' => $selectedProduct['color'],
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'Free Size']),
            'price' => $this->faker->randomFloat(2, 299, 35000),
            'discount_rate' => $this->faker->randomElement([0, 0, 10, 20, 30]),
            'stock' => $this->faker->numberBetween(0, 45),
            'description' => $selectedProduct['desc'],
            'category_id' => $category->id,
            // İlgili indexteki Unsplash görselini basıyoruz
            'image' => 'https://images.unsplash.com/photo-' . $unsplashIds[$randomIndex] . '?w=600&auto=format&fit=crop&q=60',
        ];
    }
}
