<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class seeduser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([ 
            'name'=> 'etu','email'=> 'etu@etu.com','password'=> bcrypt('etu123'),'role'=> 'étudiant',
            ]);

    }
}
