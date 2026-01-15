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
            $table->string('level_kegiatan', 100)->comment('Provinsi, Kabupaten/Kota, Puskesmas');
            $table->string('kategori_kegiatan', 100)->comment('Pertemuan/Rapat, Kunjungan, Monev, Belanja, Pelatihan, Lainnya');
            $table->text('nama_kegiatan');
            $table->text('detail_kegiatan');
            $table->text('sasaran_kegiatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usulans');
    }
};