<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periode extends Model
{

    
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'periods';

    use HasFactory;

    public function semestre()
    {
        return $this->belongsTo(semestre::class,'semester_id');
    }


}
