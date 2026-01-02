<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usulans', function (Blueprint $table) {
            if (Schema::hasColumn('usulans', 'saran_kegiatan')) {
                $table->renameColumn('saran_kegiatan', 'rincian_menu');
            }
            if (Schema::hasColumn('usulans', 'keriteria_penerima_bok')) {
                $table->renameColumn('keriteria_penerima_bok', 'sasaran_rincian_menu');
            }

            $dropColumns = [];
            foreach (['volume', 'volume_satuan', 'frekuensi_tahun', 'output', 'output_satuan', 'anggaran'] as $col) {
                if (Schema::hasColumn('usulans', $col)) {
                    $dropColumns[] = $col;
                }
            }
            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }

    public function down(): void
    {
        Schema::table('usulans', function (Blueprint $table) {
            if (Schema::hasColumn('usulans', 'rincian_menu')) {
                $table->renameColumn('rincian_menu', 'saran_kegiatan');
            }
            if (Schema::hasColumn('usulans', 'sasaran_rincian_menu')) {
                $table->renameColumn('sasaran_rincian_menu', 'keriteria_penerima_bok');
            }

            if (!Schema::hasColumn('usulans', 'volume')) {
                $table->integer('volume')->nullable();
            }
            if (!Schema::hasColumn('usulans', 'volume_satuan')) {
                $table->string('volume_satuan', 50)->nullable();
            }
            if (!Schema::hasColumn('usulans', 'frekuensi_tahun')) {
                $table->integer('frekuensi_tahun')->nullable();
            }
            if (!Schema::hasColumn('usulans', 'output')) {
                $table->integer('output')->nullable();
            }
            if (!Schema::hasColumn('usulans', 'output_satuan')) {
                $table->string('output_satuan', 50)->nullable();
            }
            if (!Schema::hasColumn('usulans', 'anggaran')) {
                $table->bigInteger('anggaran')->nullable();
            }
        });
    }
};
