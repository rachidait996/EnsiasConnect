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
        Schema::table('chefs_de_filiere', function (Blueprint $table) {
            
            $table->foreignId('filiere_id')->references('id')->on('filieres')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chefs_de_filiere', function (Blueprint $table) {
            //
        });
    }
};
