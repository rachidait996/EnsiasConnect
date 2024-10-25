<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class element_de_module extends Model
{
    
    
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'module_elements';

    use HasFactory;

   
    public function professeur(){
        return $this->belongsToMany(professor::class);
    } 
   
   
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
