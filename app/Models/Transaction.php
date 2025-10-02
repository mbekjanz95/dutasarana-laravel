<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table='transaction';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'iduser',
        'idproduct',
        'idvar',
        'courier_service',
        'no_resi',
        'courier_cost',
        'kota_pengiriman',
        'qty',
        'discount',
        'status',
    ];

    public $timestamps = false;

   /*  use HasFactory;
    protected $table='transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'invoice_number',
        'amount',
        'status',
    ];

    public $timestamps = true; */
}
