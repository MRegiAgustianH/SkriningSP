<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePenyakitToTingkatKecanduan extends Migration
{
    public function up()
    {
        // 1. Drop foreign keys yang merujuk ke tabel penyakit
        Schema::table('aturan', function (Blueprint $table) {
            $table->dropForeign(['penyakit_id']);
        });
        Schema::table('hasil', function (Blueprint $table) {
            $table->dropForeign(['penyakit_id']);
        });

        // 2. Rename tabel penyakit → tingkat_kecanduan
        Schema::rename('penyakit', 'tingkat_kecanduan');

        // 3. Rename kolom di tingkat_kecanduan
        Schema::table('tingkat_kecanduan', function (Blueprint $table) {
            $table->renameColumn('kode_penyakit', 'kode_kecanduan');
            $table->renameColumn('nama_penyakit', 'nama_kecanduan');
        });

        // 4. Rename FK kolom di aturan: penyakit_id → kecanduan_id
        Schema::table('aturan', function (Blueprint $table) {
            $table->renameColumn('penyakit_id', 'kecanduan_id');
        });
        Schema::table('aturan', function (Blueprint $table) {
            $table->foreign('kecanduan_id')->references('id')->on('tingkat_kecanduan')->cascadeOnDelete();
        });

        // 5. Rename FK kolom di hasil: penyakit_id → kecanduan_id
        Schema::table('hasil', function (Blueprint $table) {
            $table->renameColumn('penyakit_id', 'kecanduan_id');
        });
        Schema::table('hasil', function (Blueprint $table) {
            $table->foreign('kecanduan_id')->references('id')->on('tingkat_kecanduan')->cascadeOnDelete();
        });
    }

    public function down()
    {
        // Reverse FK di hasil
        Schema::table('hasil', function (Blueprint $table) {
            $table->dropForeign(['kecanduan_id']);
            $table->renameColumn('kecanduan_id', 'penyakit_id');
        });

        // Reverse FK di aturan
        Schema::table('aturan', function (Blueprint $table) {
            $table->dropForeign(['kecanduan_id']);
            $table->renameColumn('kecanduan_id', 'penyakit_id');
        });

        // Reverse kolom rename
        Schema::table('tingkat_kecanduan', function (Blueprint $table) {
            $table->renameColumn('kode_kecanduan', 'kode_penyakit');
            $table->renameColumn('nama_kecanduan', 'nama_penyakit');
        });

        // Reverse table rename
        Schema::rename('tingkat_kecanduan', 'penyakit');

        // Re-add FKs
        Schema::table('aturan', function (Blueprint $table) {
            $table->foreign('penyakit_id')->references('id')->on('penyakit')->cascadeOnDelete();
        });
        Schema::table('hasil', function (Blueprint $table) {
            $table->foreign('penyakit_id')->references('id')->on('penyakit')->cascadeOnDelete();
        });
    }
}
