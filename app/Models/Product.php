<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'barcode',
        'description',
        'photo',
        'instock',
        'prix_actuel',
        'prix_promotion',
        'promo',
        'qtyB',
        'categorie_id',
        'sub_category_id'
    ];

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function imageProducts()
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
        //  il calcule le stock totale et il ajoute dans la base de donner les stock des article qui j'ai ajouter
        $stock = 0;
        foreach ($this->productSizes as $item) {
            $stock += (int) $item->stock;
        }
        $this->attributes['instock'] = $stock;
    }
}
