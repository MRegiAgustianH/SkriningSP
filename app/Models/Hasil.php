<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';
    protected $fillable = ['nama', 'no_hp', 'jenis_kelamin', 'alamat', 'gejala', 'kecanduan_id', 'cf'];

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class);
    }
}
