<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Char_magic extends Model
{
    protected $table = 'char_magics';
    protected $fillable = [
        'slots',
        'qpd'
    ];
    use HasFactory;
}
