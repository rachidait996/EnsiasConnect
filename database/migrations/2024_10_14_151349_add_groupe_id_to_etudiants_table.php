<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('etudiants', function (Blueprint $table) {
            // Add the groupe_id column and set it as a foreign key
            $table->unsignedBigInteger('groupe_id')->nullable()->after('user_id'); // Place it after the user_id column
            $table->foreign('groupe_id')->references('id')->on('goupe')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('etudiants', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['groupe_id']);
            $table->dropColumn('groupe_id');
        });
    }
    
};
