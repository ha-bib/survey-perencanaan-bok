<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Performance indexes for faster queries
     */
    public function up(): void
    {
        // Indexes for indikators table - frequently filtered/sorted columns
        Schema::table('indikators', function (Blueprint $table) {
            $table->index('is_display', 'idx_indikators_is_display');
            $table->index('tingkat', 'idx_indikators_tingkat');
            $table->index('nomor', 'idx_indikators_nomor');
            $table->index(['is_display', 'nomor'], 'idx_indikators_display_nomor');
            // Composite index for filter queries
            $table->index(['is_RENSTRA', 'is_RIBK', 'is_RPJMN'], 'idx_indikators_flags');
        });

        // Indexes for usulans table - optimize joins and filters
        Schema::table('usulans', function (Blueprint $table) {
            $table->index('created_at', 'idx_usulans_created_at');
            // Composite for common query patterns
            $table->index(['responden_id', 'created_at'], 'idx_usulans_responden_created');
        });

        // Indexes for usulan_reactions - optimize count queries
        Schema::table('usulan_reactions', function (Blueprint $table) {
            $table->index(['usulan_id', 'reaction'], 'idx_reactions_usulan_reaction');
        });
    }

    public function down(): void
    {
        Schema::table('indikators', function (Blueprint $table) {
            $table->dropIndex('idx_indikators_is_display');
            $table->dropIndex('idx_indikators_tingkat');
            $table->dropIndex('idx_indikators_nomor');
            $table->dropIndex('idx_indikators_display_nomor');
            $table->dropIndex('idx_indikators_flags');
        });

        Schema::table('usulans', function (Blueprint $table) {
            $table->dropIndex('idx_usulans_created_at');
            $table->dropIndex('idx_usulans_responden_created');
        });

        Schema::table('usulan_reactions', function (Blueprint $table) {
            $table->dropIndex('idx_reactions_usulan_reaction');
        });
    }
};
