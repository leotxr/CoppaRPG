<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelClass extends Model
{
    protected $table='classe';
    protected $fillable=['name','desc'];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(ModelChar::class, 'class_id');
    }
}
