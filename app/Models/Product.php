<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Formdan toplu veri girişine izin verdiğim ürün sütunları
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'discount_rate',
        'sales_count',
        'fav_count',
        'brand',
        'color',
        'size',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('status', 'True');
    }

    // Bu ürünün ait olduğu kategori ilişkisi
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
