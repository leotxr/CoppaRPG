<?php

namespace App\Http\Controllers;

use App\Models\Armor;
use Illuminate\Http\Request;
use App\Models\Char;
use App\Models\User;
use App\Models\Expertise;
use App\Models\Breed;
use App\Models\Char_weapon;
use App\Models\Classes;
use App\Models\Talent;
use App\Models\Skill;
use App\Models\Magic;
use App\Models\Weapon;
use App\Models\Shield;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CharController extends Controller
{

    private $objUser;
    private $objChar;
    private $objWeapon;
    private $objArmor;
    private $objBreed;
    private $objClass;
    private $objExpertise;

    public function __construct()
    {
        $this->objUser = new User();
        $this->objChar = new Char();
        $this->objWeapon = new Weapon();
        $this->objArmor = new Armor();
        $this->objBreed = new Breed();
        $this->objClass = new Classes();
        $this->objShield = new Shield();
        $this->objExpertise = new Expertise();
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //$char = Char::byUser(Auth::id())->get();
        $user = auth()->user();
        $char = Char::all();
        return view('vertodos', compact('char', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::find(Auth::user());
        $breeds = Breed::all();
        $classes = Classes::all();
        $weapons = Weapon::all();
        $char_weapons = Char_weapon::all();
        $armors = Armor::all();
        $shields = Shield::all();
        $expertises = Expertise::all();
        $talents = Talent::all();
        $skills = Skill::all();
        $magics = Magic::all();

        return view('create', compact('users', 'breeds', 'classes', 'weapons', 'armors', 'shields', 'expertises', 'talents', 'skills', 'magics', 'char_weapons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cad = Char::create([
            //bd                html

            'name' => $request->name,
            'age' => $request->age,
            'breed_id' => $request->breed_id,
            'class_id' => $request->class_id,
            'user_id' => auth()->user()->id,
            'armor_id' => $request->armor_id,
            'shield_id' => $request->shield_id,
            'level' => $request->level,
            'trend' => $request->trend,
            'sex' => $request->sex,
            'eyes' => $request->eyes,
            'size' => $request->size,
            'hair' => $request->hair,
            'religion' => $request->religion,
            'weight' => $request->weight,
            'height' => $request->height,
            'str' => $request->str,
            'dex' => $request->dex,
            'con' => $request->con,
            'int' => $request->int,
            'wiz' => $request->wiz,
            'cha' => $request->cha,
            'modstr' => $request->modstr,
            'moddex' => $request->moddex,
            'modcon' => $request->modcon,
            'modint' => $request->modint,
            'modwiz' => $request->modwiz,
            'modcha' => $request->modcha,
            'pv' => $request->pv,
            'actpv' => $request->actpv,
            'dv' => $request->dv,
            'desloc' => $request->desloc,
            'modarmor' => $request->modarmor,
            'modshield' => $request->modshield,
            'modotherca' => $request->modotherca,
            'modsize' => $request->modsize,
            'ca' => $request->ca,
            'initiative' => $request->initiative,
            'bba' => $request->bba,
            'for' => $request->for,
            'basefor' => $request->basefor,
            'habfor' => $request->habfor,
            'magicfor' => $request->magicfor,
            'otherfor' => $request->otherfor,
            'ref' => $request->ref,
            'baseref' => $request->baseref,
            'habref' => $request->habref,
            'magicref' => $request->magicref,
            'otherref' => $request->otherref,
            'will' => $request->will,
            'basewill' => $request->basewill,
            'habwill' => $request->habwill,
            'magicwill' => $request->magicwill,
            'otherwill' => $request->otherwill,
            'natural_armor' => $request->natural_armor,
            'touch_ca' => $request->touch_ca,
            'surprise_ca' => $request->surprise_ca,
            'xp' => $request->xp,
            'bag' => $request->bag,

        ]);

        $cadexp = Expertise::create([
            'char_id' => $cad->id
        ]);


        /*
        $cad->weapons()->attach(
            [
                'observation' => $request->observation,
                'weapon_id' => $request->weapon_id,
            ]
        );
        */


        if ($cad) {
            return redirect()->action(
                'App\Http\Controllers\CharController@edit', [$cad]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $char = Char::find($id);
        return view('show', compact('char'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $char = Char::find($id);
        $users = User::all();
        $breeds = Breed::all();
        $classes = Classes::all();
        $weapons = Weapon::all();
        $char_weapons = Char_weapon::all();
        $armors = Armor::all();
        $shields = Shield::all();
        $talents = Talent::all();
        $skills = Skill::all();
        $magics = Magic::all();   
        $sql = "Select id from expertises WHERE char_id = '$char->id' ";
        $expertises = DB::select($sql);
        
        

        return view('edit', compact('char', 'users', 'breeds', 'classes', 'weapons', 'armors', 'shields', 'talents', 'skills', 'magics', 'char_weapons', 'expertises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Char::where(['id' => $id])->update([
            'name' => $request->name,
            'age' => $request->age,
            'breed_id' => $request->breed_id,
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
            'armor_id' => $request->armor_id,
            'shield_id' => $request->shield_id,
            'level' => $request->level,
            'trend' => $request->trend,
            'sex' => $request->sex,
            'eyes' => $request->eyes,
            'size' => $request->size,
            'hair' => $request->hair,
            'religion' => $request->religion,
            'weight' => $request->weight,
            'height' => $request->height,
            'str' => $request->str,
            'dex' => $request->dex,
            'con' => $request->con,
            'int' => $request->int,
            'wiz' => $request->wiz,
            'cha' => $request->cha,
            'modstr' => $request->modstr,
            'moddex' => $request->moddex,
            'modcon' => $request->modcon,
            'modint' => $request->modint,
            'modwiz' => $request->modwiz,
            'modcha' => $request->modcha,
            'pv' => $request->pv,
            'actpv' => $request->actpv,
            'dv' => $request->dv,
            'desloc' => $request->desloc,
            'modarmor' => $request->modarmor,
            'modshield' => $request->modshield,
            'modotherca' => $request->modotherca,
            'modsize' => $request->modsize,
            'ca' => $request->ca,
            'initiative' => $request->initiative,
            'bba' => $request->bba,
            'for' => $request->for,
            'basefor' => $request->basefor,
            'habfor' => $request->habfor,
            'magicfor' => $request->magicfor,
            'otherfor' => $request->otherfor,
            'ref' => $request->ref,
            'baseref' => $request->baseref,
            'habref' => $request->habref,
            'magicref' => $request->magicref,
            'otherref' => $request->otherref,
            'will' => $request->will,
            'basewill' => $request->basewill,
            'habwill' => $request->habwill,
            'magicwill' => $request->magicwill,
            'otherwill' => $request->otherwill,
            'natural_armor' => $request->natural_armor,
            'touch_ca' => $request->touch_ca,
            'surprise_ca' => $request->surprise_ca,
            'xp' => $request->xp,
            'bag' => $request->bag,
            'gp' => $request->gp,
            'sp' => $request->sp,
            'cp' => $request->cp,

        ]);


        if ($edit)
            return redirect()->back();
    }

    public function destroy(Char $id)
    {

        $deleted = DB::table('chars')->delete();
        echo 'alert($char_id)';
        if ($deleted)
            return redirect('chars');
    }

}
