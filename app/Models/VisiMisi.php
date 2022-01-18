<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_urut',
        'visi',
        'misi',
        'ketua',
        'nimketua',
        'jurusanketua',
        'angkatanketua',
        'wakil',
        'nimwakil',
        'jurusanwakil',
        'angkatanwakil',
    ];
}
