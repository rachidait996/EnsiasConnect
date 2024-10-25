<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop the existing foreign key if it exists
            $table->dropForeign(['chef_filiere_id']); // Replace with your actual foreign key column name
            
            // If you need to change the column type as well, uncomment and modify the following line
            // $table->unsignedBigInteger('new_foreign_key_column')->change();

            // Add the new foreign key reference
            $table->foreign('chef_filiere_id')  // Replace with the correct column
                  ->references('id')             // Assuming the referenced column is 'id'
                  ->on('users')               // The referenced table (replace with your actual table)
                  ->onDelete('cascade');         // Optional: handle what happens on delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop the new foreign key
            $table->dropForeign(['chef_filiere_id']);
            
            // Revert to the old foreign key or previous state
            // $table->foreign('chef_filiere_id')->references('id')->on('old_table')->onDelete('cascade');
        });
    }
};
