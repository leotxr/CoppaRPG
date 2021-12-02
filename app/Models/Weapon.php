<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    protected $table='weapons';
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

    public function chars()
    {
        return $this->belongsToMany(Char::class, 'char_weapons');
    }
}
