<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shield extends Model
{
    

    protected $table='shields';
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
    return $this->hasMany(Char::class, 'shield_id');
}
}
