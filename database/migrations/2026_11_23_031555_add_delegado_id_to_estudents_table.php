<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estudents', function (Blueprint $table) {
            $table->foreignId('delegado_id')
                ->nullable()
                ->constrained('estudents')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('estudents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('delegado_id');
        });
    }
};