<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Formdan toplu veri yüklemesine izin verdiğim sütunları tanımlıyorum
    protected $fillable = [
        'name',
        'description',
    ];

    // Ürünlerle olan ilişkisi (Daha sonra işime yarayacak)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
