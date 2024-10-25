<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\professor;
use App\Models\User;

class professorseeder extends Seeder
{ 

    public function run(): void
    {
// Fetch all professors from the users table
$professors = User::where('role', 'professeur')->get();

// Iterate over the professors and insert into the 'professors' table
foreach ($professors as $prof) {
    Professor::create([
        'user_id' => $prof->id,
        'department' => 'Department Name',
        'bibliographique' => 'biblio'
    ]);
}
}
}

