<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Reference\Reference;

class semestre extends Model

{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semesters';


    use HasFactory;
    
    public function periods()
    {
        return $this->hasMany(periode::class);
    }

    public function modules()
    {
        return $this->hasMany(module::class);
    }


}
