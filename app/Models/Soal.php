<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table        = 'soal';

    protected $primaryKey   = 'id_soal';

    public $incrementing    = false;

    protected $keyType      = 'int';

    protected $fillable     = [
        'id_level',
        'pertanyaan',
        'a',
        'b',
        'c',
        'd',
        'audio',
        'jawaban',
    ];


}
