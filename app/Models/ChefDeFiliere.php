<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChefDeFiliere extends Model
{
    use HasFactory;


        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chefs_de_filiere';

    protected $fillable = [
        'user_id',
        'filiere_id',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Filiere model
    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'filiere_id');
    }

    // Relationship with Creneaux if needed
    public function creneaux()
    {
        return $this->hasMany(Creneaux::class);
    }
}
