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
        Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('creneau_id');
                $table->unsignedBigInteger('chef_filiere_id');
                $table->unsignedBigInteger('professeur_id');
                $table->enum('message_type', ['cancel', 'reschedule', 'other']);
                $table->text('message_content')->nullable();
                $table->timestamps();
    
                // Foreign key constraints
                $table->foreign('creneau_id')->references('id')->on('creneaux')->onDelete('cascade');
                $table->foreign('chef_filiere_id')->references('id')->on('chefs_de_filiere')->onDelete('cascade');
                $table->foreign('professeur_id')->references('id')->on('users')->onDelete('cascade'); // assuming 'users' table contains professors
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
