<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Char extends Model
{
    protected $table = 'chars';
    protected $fillable = [
        'name', 
        'age',
        'user_id',
        'breed_id',
        'class_id',
        'weapon_id',
        'expertise_id',
        'armor_id',
        'shield_id',
        'level',
        'trend',
        'religion',
        'sex',
        'eyes',
        'size',
        'hair',
        'weight',
        'height',
        'str',
        'dex',
        'con',
        'int',
        'wiz',
        'cha',
        'modstr',
        'moddex',
        'modcon',
        'modint',
        'modwiz',
        'modcha',
        'grab',
        'pv',
        'actpv',
        'dv',
        'desloc',
        'modarmor',
        'modshield',
        'modotherca',
        'modsize',
        'ca',
        'initiative',
        'bba',
        'for',
        'basefor',
        'habfor',
        'magicfor',
        'otherfor',
        'ref',
        'baseref',
        'habref',
        'magicref',
        'otherref',
        'will',
        'basewill',
        'habwill',
        'magicwill',
        'otherwill',
        'natural_armor',
        'touch_ca',
        'surprise_ca',
        'xp',
        'bag',
        'gp',
        'sp',
        'cp'
    ];
    use HasFactory;



    public function relUsers()
    {

        return $this->belongsTo(User::class);
    }

    /*
    public function scopeGetUserChars($query, $user_id)
    {
        return $query->with('relClasses', 'relBreeds')
        ->where('user_id', '=', $user_id);
    }
    */

    public function weapons()
    {
        return $this->belongsToMany(Weapon::class, 'char_weapons');
    }

    public function magics()
    {
        return $this->belongsToMany(Magic::class, 'char_magics');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'char_skills');
    }

    public function talents()
    {
        return $this->belongsToMany(Talent::class, 'char_talents');
    }

    public function relArmors()
    {
        return $this->hasOne('App\Models\Armor', 'id', 'armor_id');
    }

    public function relBreeds()
    {
        return $this->hasOne('App\Models\Breed', 'id', 'breed_id');
    }

    public function relClasses()
    {
        return $this->hasOne('App\Models\Classes', 'id', 'class_id');
        
    }

    public function relShields()
    {
        return $this->hasOne('App\Models\Shield', 'id', 'shield_id');

    }

    public function relExpertises()
    {
        return $this->hasOne('App\Models\Expertise', 'id', 'expertise_id');

    }

    /**
     * @param  \App\Models\Char  $query
     * @param  int                                    $id
     * @return \App\Models\Char
     */
}
