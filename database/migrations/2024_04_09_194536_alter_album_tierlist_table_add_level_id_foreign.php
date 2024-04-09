<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('album_tierlist', function (Blueprint $table) {
            $table->foreignId('level_id')->constrained()->cascadeOnDelete()->after('tierlist_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('album_tierlist', function (Blueprint $table) {
            $table->dropForeign('album_tierlist_level_id_foreign');

            $table->dropColumn('level_id');
        });
    }
};
