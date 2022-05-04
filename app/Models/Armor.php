<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    protected $table='armors';
    protected $fillable=['name',
    'desc',
    'type',
    'ca_bonus', 
    'penal_dex', 
    'max_bonus', 
    'desloc', 
    'weight', 
    'value',
    'special',
    'arcane_fail',
    'arcane_magic'
];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(Char::class, 'armor_id');
    }
}
