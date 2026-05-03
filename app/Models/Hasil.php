<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $table = 'hasil';
    protected $fillable = ['nama', 'no_hp', 'jenis_kelamin', 'alamat', 'gejala', 'penyakit_id', 'cf'];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
