<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table        = 'peserta';

    protected $primaryKey   = 'id_peserta';

    public $incrementing    = true;

    protected $keyType      = 'int';

    protected $fillable     = [
        'id_peserta',
        'nama_peserta',
        'umur',
        'alamat',
        'email',
        'tgl_daftar',
        'level',
        'id_instansi',
    ];


    public function intansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
}
