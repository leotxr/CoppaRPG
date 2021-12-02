<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    protected $table='breeds';
    protected $fillable=['name','desc'];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(Char::class, 'breed_id');
    }
}
