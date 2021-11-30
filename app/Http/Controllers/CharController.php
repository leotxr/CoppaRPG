<?php

namespace App\Http\Controllers;

use App\Models\Armor;
use Illuminate\Http\Request;
use App\Models\ModelChar;
use App\Models\User;
use App\Models\Expertise;
use App\Models\Breed;
use App\Models\ModelClass;
use App\Models\Weapon;
use Illuminate\Support\Facades\Auth;

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
        $this->objChar = new ModelChar();
        $this->objWeapon = new Weapon();
        $this->objArmor = new Armor();
        $this->objBreed = new Breed();
        $this->objClass = new ModelClass();
        $this->objClass = new Expertise();
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //$char = ModelChar::byUser(Auth::id())->get();
        $user = auth()->user();
        $char = ModelChar::all();
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
        $classes = ModelClass::all();
        $weapons = Weapon::all();
        $armors = Armor::all();
        $expertises = Expertise::all();
        return view('create', compact('users', 'breeds', 'classes', 'weapons', 'armors','expertises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cad = ModelChar::create([
            'name' => $request->name,
            'age' => $request->age,
            'breed_id' => $request->breed_id,
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
            'weapon_id' => $request->weapon_id,
            'armor_id' => $request->armor_id,
            'level' => $request->level,
            'trend' => $request->trend,
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
            'baswill' => $request->basewill,
            'habwill' => $request->habwill,
            'magicwill' => $request->magicwill,
            'otherwill' => $request->otherwill,
            'natural_armor' => $request->natural_armor,
            'touch_ca' => $request->touch_ca,
            'surprise_ca' => $request->surprise_ca,
            'xp' => $request->xp,
            'bag' => $request->bag

            //'weapon_id'=>$request->weapon_id
        ]);
        if ($cad) {
            return redirect('chars');
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
        $char = ModelChar::find($id);
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
        $char = ModelChar::find($id);
        $users = User::all();
        $breeds = Breed::all();
        $classes = ModelClass::all();
        $weapons = Weapon::all();
        $armors=Armor::all();
        $expertises = Expertise::all();
        return view('create', compact('char', 'users', 'breeds', 'classes', 'weapons', 'armors', 'expertises'));
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
        ModelChar::where(['id' => $id])->update([
            'name' => $request->name,
            'age' => $request->age,
            'breed_id' => $request->breed_id,
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
            'weapon_id' => $request->weapon_id,
            'armor_id' => $request->armor_id,
            'level' => $request->level,
            'trend' => $request->trend,
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
            'baswill' => $request->basewill,
            'habwill' => $request->habwill,
            'magicwill' => $request->magicwill,
            'otherwill' => $request->otherwill,
            'natural_armor' => $request->natural_armor,
            'touch_ca' => $request->touch_ca,
            'surprise_ca' => $request->surprise_ca,
            'xp' => $request->xp,
            'bag' => $request->bag


        ]);
        return redirect('chars');
    }

    public function destroy($id)
    {
        $char = ModelChar::find($id);
        $char->delete();
        return redirect('/chars');
    }
}
