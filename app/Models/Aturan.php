<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    protected $table = 'aturan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class);
    }
}
