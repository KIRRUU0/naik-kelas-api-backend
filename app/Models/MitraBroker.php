<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MitraBroker extends Model
{
    use HasFactory;

    protected $table = 'mitra_broker';
    protected $fillable = [
        'id',
        'tipe_broker',
        'kategori_id',
        'gambar',
        'nama_kategori',
        'deskripsi',
        'fitur_unggulan',
        'url_cta',
    ];
    public $timestamps = false;
}
