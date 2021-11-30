<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    protected $table='weapon';
    protected $fillable=['name',
    'desc',
    'damage',
    'size', 
    'total_bba', 
    'decisive', 
    'reach', 
    'weight', 
    'type',
    'special',
    'value' 
];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(ModelChar::class);
    }
}
