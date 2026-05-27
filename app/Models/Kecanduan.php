<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecanduan extends Model
{
    protected $table = 'tingkat_kecanduan';
    protected $guarded = ['id'];
    public $timestamps = false;
}
