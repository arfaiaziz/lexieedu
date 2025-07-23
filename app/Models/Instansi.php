<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table        = 'instansi';

    protected $primaryKey   = 'id_instansi';

    public $incrementing    = false;

    protected $keyType      = 'int';

    protected $fillable     = [
        'id_instansi',
        'nama_instansi',
        'tgl_mulai',
        'tgl_berakhir',
        'jumlah_sesi',
    ];


}
