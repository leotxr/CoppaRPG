<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $table='talents';
    protected $fillable=['name',
    'desc',
    'benefit',
    'prereq',
    'special'

];

    use HasFactory;

    public function chars()
    {
        return $this->belongsToMany(Char::class, 'char_talents');
    }
}
