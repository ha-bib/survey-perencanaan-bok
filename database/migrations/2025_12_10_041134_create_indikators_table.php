<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indikators', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 50);
            $table->enum('tingkat', ['IKK', 'IKP']);
            $table->string('nama');
            $table->string('unit_timker')->nullable();
            $table->boolean('is_RENSTRA')->default(false);
            $table->boolean('is_RIBK')->default(false);
            $table->boolean('is_RPJMN')->default(false);
            $table->boolean('is_display')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indikators');
    }
};