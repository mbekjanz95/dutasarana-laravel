<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variations extends Model
{
    use HasFactory;
    protected $table='variations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_idproduct',
        'value',
        'sku',
        'pricebefore',
        'priceafter',
    ];
}
