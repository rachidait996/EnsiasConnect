<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\filiere;

class departement extends Model
{
    use HasFactory;


        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    protected $guarded = [];


    public function filieres()
    {
        return $this->hasMany(filiere::class);
    }


}
