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
        Schema::create('creneaux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained()->onDelete('cascade'); // Links the creneau to a specific period
            $table->foreignId('professor_id')->constrained('users')->onDelete('cascade'); // The professor associated with this time slot
            $table->foreignId('module_element_id')->constrained()->onDelete('cascade'); // Links the creneau to a specific module element
            $table->enum('day', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']);
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('group_id')->constrained('goupe')->onDelete('cascade');
            $table->enum('niveau', ['1A','2A','3A']);
            $table->timestamps();       
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creneaux');
    }
};
