<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = ['judul', 'gambar', 'isi', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
