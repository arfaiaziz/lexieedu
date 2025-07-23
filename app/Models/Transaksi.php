<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table        = 'transaksi';

    protected $primaryKey   = 'id_transaksi';

    public $incrementing    = false;

    protected $keyType      = 'int';

    protected $fillable     = [
        'id_transaksi',
        'nama',
        'via_pembayaran',
        'nominal',
        'keterangan',
        'tgl_transaksi',
    ];


}
