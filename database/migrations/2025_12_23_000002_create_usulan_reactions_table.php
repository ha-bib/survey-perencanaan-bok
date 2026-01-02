<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usulan_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usulan_id')->constrained('usulans')->onDelete('cascade');
            $table->foreignId('responden_id')->constrained('respondens')->onDelete('cascade');
            $table->enum('reaction', ['like', 'dislike']);
            $table->timestamps();
            $table->unique(['usulan_id', 'responden_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usulan_reactions');
    }
};
