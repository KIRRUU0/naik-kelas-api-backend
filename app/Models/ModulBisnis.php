<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModulBisnis extends Model
{
    use HasFactory;

    protected $table = 'modul_bisnis';
    protected $fillable = [
        'kategori_id',
        'judul_bisnis',
        'deskripsi',
        'fitur_unggulan',
        'url_cta',
    ];
    public $timestamps = false;
}
