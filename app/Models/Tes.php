<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;

    protected $table        = 'tes';

    protected $primaryKey   = 'id_tes';

    public $incrementing    = false;

    protected $keyType      = 'int';

    protected $fillable     = [
        'id_tes',
        'tgl_tes',
        'id_peserta',
        'id_soal',
        'nama_soal',
        'jawaban_soal',
        'jawaban_peserta'
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }
}
