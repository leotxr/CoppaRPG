<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $table='weapons';
    protected $fillable=['name',
    'value',
    'keyhab',
    'habmod', 
    'gratuation',
    'other'
];
    use HasFactory;

    public function relChars()
    {
        return $this->hasMany(Char::class);
    }
}