<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnimasiToGejalaTable extends Migration
{
    public function up()
    {
        Schema::table('gejala', function (Blueprint $table) {
            $table->string('animasi')->nullable()->after('nama_gejala');
        });
    }

    public function down()
    {
        Schema::table('gejala', function (Blueprint $table) {
            $table->dropColumn('animasi');
        });
    }
}
