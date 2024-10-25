<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Reference\Reference;

class professor extends Model


{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professors';
    
    use HasFactory ;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function elementDeModules()
    {
        return $this->belongsToMany(element_de_module::class, 'pivot_element_prof', 'professor_id', 'element_de_module_id');
    }

    public function creneaux()
    {
        return $this->hasMany(Creneaux::class);
    }
}
