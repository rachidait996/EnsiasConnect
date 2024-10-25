<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ChefDeFiliere;

class Message extends Model
{
    use HasFactory;

    protected $guarded =[];

    // Define the relationship with Creneau
    public function creneau()
    {
        return $this->belongsTo(Creneaux::class);
    }

    // Define the relationship with ChefFiliere
    public function chefFiliere()
    {
        return $this->belongsTo(ChefDeFiliere::class, 'chef_filiere_id');
    }

    // Define the relationship with Professeur
    public function professor()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }
}
