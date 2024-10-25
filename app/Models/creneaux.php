<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creneaux extends Model
{
    use HasFactory;

      
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'creneaux';

    protected $guarded = [];
    

   

    public function elementDeModule()
    {
        return $this->belongsTo(element_de_module::class, 'module_element_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'professor_id');
    }

    public function room()
    {
        return $this->belongsTo(room::class, 'room_id');
    }
}




