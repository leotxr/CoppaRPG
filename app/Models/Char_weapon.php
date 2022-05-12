<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Char_weapon extends Model
{
    protected $table = 'char_weapons';
    protected $fillable = [
        'observation',
        'total_bba',
        'total_damage'
    ];
    use HasFactory;
}
