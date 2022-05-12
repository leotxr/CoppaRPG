<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table='skills';
    protected $fillable=['name',
    'desc',
    'type'
];
    use HasFactory;

    public function chars()
    {
        return $this->belongsToMany(Char::class, 'char_skills');
    }
}
