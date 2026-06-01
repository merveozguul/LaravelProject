<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Formdan toplu veri girişine izin verdiğim ürün sütunları
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'discount_rate',
    ];

    // Bu ürünün ait olduğu kategori ilişkisi
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
