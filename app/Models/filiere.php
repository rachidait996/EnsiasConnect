<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filiere extends Model
{
    use HasFactory;


      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'filieres';


    protected $guarded = [];

    public function groups()
    {
        return $this->hasMany(Groupe::class);
    }
}
