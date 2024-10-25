<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupe extends Model
{
    use HasFactory;

      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goupe';

    protected $guarded = [];


    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
}
