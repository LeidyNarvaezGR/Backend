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
        Schema::create('estudent_module', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('estudent_id');
            $table->unsignedBigInteger('module_id');

            $table->foreign('estudent_id')
                  ->references('id')
                  ->on('estudents')
                  ->onDelete('cascade');

            $table->foreign('module_id')
                  ->references('id')
                  ->on('modules')
                  ->onDelete('cascade');

            $table->unique(['estudent_id', 'module_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudent_module');
    }
};
