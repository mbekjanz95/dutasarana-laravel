<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiTransaksi extends Model
{
    use HasFactory;
    protected $table='bukti_transaksi';

    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'iduser',
        'url_resi',
        'bank_tujuan',
        'bank_asal',
        'pemilik_rekening',
        'no_rekening_pemilik',
        'tanggal_pembayaran',
        'total_bayar',
        'keterangan',
    ];

    public $timestamps = false;
}
