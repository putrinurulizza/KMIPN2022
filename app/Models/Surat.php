<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['jenis_surat'];

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
}
