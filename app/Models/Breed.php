<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    protected $table='breed';
    protected $fillable=['name','desc'];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(ModelChar::class, 'breed_id');
    }
}
