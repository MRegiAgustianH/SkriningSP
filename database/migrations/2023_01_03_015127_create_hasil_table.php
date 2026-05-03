<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('no_hp', 15)->nullable();
            $table->string('jenis_kelamin', 10)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->text('gejala')->nullable();
            $table->foreignId('penyakit_id')->nullable()->constrained('penyakit')->cascadeOnDelete();
            $table->float('cf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil');
    }
}
