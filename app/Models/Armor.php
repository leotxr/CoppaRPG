<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    protected $table='armor';
    protected $fillable=['name',
    'desc',
    'type',
    'ca_bonus', 
    'max_dex', 
    'penal', 
    'desloc', 
    'weight', 
    'value',
    'special' 
];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(ModelChar::class, 'armor_id');
    }
}
