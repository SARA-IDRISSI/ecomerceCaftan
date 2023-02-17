<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size',
        'colors',
        'stock',
    ];

    public function getColorsAttribute($value)
    {
        $colorsAndStocks = explode(",", $value);
        $colorsAndStocksArray = [];
        foreach ($colorsAndStocks as $colorAndStock) {
            $array = explode(":", $colorAndStock);
            if (count($array) > 1) {
                $colorsAndStocksArray[$array[0]] = $array[1];
            }
        }
        return $colorsAndStocksArray;
    }

    public function colors() {
        
    }
}
