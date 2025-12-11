<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('responden_id')->constrained('respondens')->onDelete('cascade');
            $table->foreignId('indikator_id')->constrained('indikators')->onDelete('cascade');
            $table->string('tingkat_bok', 100)->comment('Provinsi, Kabupaten/Kota, Puskesmas');
            $table->text('saran_kegiatan');
            $table->text('detail_kegiatan');
            $table->text('keriteria_penerima_bok');
            $table->integer('volume');
            $table->string('volume_satuan', 50);
            $table->integer('frekuensi_tahun');
            $table->integer('output');
            $table->string('output_satuan', 50);
            $table->bigInteger('anggaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usulans');
    }
};