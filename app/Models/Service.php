<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table='service';

    protected $primaryKey = 'id';

    protected $fillable = [
        'no_so',
        'id_user',
        'status',
        'keluhan',
        'merk',
        'tipe_barang',
        'serial_number',
        'tanggal_masuk',
        'unit_diterima',
        'nama_teknisi',
        'analisa_teknisi',
        'solusi_saran',
        'part_diganti',
        'status_sparepart',
        'harga',
    ];

    public $timestamps = false;
}
