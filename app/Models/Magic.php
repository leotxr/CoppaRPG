<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magic extends Model
{
    protected $table='magics';
    protected $fillable=['name',
    'desc',
    'class_name',
    'type',
    'level',
    'component',
    'reach',
    'duration',
    'target'
];
    use HasFactory;

    public function chars()
    {
        return $this->belongsToMany(Char::class, 'char_magics');
    }
}
