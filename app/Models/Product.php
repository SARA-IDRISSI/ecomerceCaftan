<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'barcode',
        'description',
        'photo',
        'instock',
        'prix_actuel',
        'prix_promotion',
        'promo',
        'categorie_id',
        'sub_category_id'
    ];

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function productImages()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function getInstockAttribute()
    {
        $stock = 0;
        foreach ($this->productSizes as $item) {
            $stock += (int) $item->stock;
        }
        return $stock;
    }

    public function setInstockAttribute()
    {
        $stock = 0;
        foreach ($this->productSizes as $item) {
            $stock += (int) $item->stock;
        }
        $this->attributes['instock'] = $stock;
    }
}
