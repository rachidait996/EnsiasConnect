<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      
            DB::statement("ALTER TABLE rooms MODIFY category ENUM('Amphi', 'Salle', 'Salle de TP') NOT NULL");

            // Update existing data to match new categories
            DB::table('rooms')->where('category', 'cours')->update(['category' => 'Amphi']);
            DB::table('rooms')->where('category', 'tp')->update(['category' => 'Salle de TP']);
            DB::table('rooms')->where('category', 'td')->update(['category' => 'Salle']);
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE rooms MODIFY category ENUM('cours', 'tp', 'td') NOT NULL");

        // Revert the data to the original categories
        DB::table('rooms')->where('category', 'Amphi')->update(['category' => 'cours']);
        DB::table('rooms')->where('category', 'Salle de TP')->update(['category' => 'tp']);
        DB::table('rooms')->where('category', 'Salle')->update(['category' => 'td']);
    }
};
