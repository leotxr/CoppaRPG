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
        $armors = Armor::all();
        $shields = Shield::all();
        $expertises = Expertise::all();

        return view('create', compact('users', 'breeds', 'classes', 'weapons', 'armors', 'shields', 'expertises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastExpertise = DB::table('expertises')->orderBy('id')->first();

        $cad = Char::create([
            //bd                html

            'name' => $request->name,
            'age' => $request->age,
            'breed_id' => $request->breed_id,
            'class_id' => $request->class_id,
            'user_id' => auth()->user()->id,
            'expertise_id' => $request->expertise_id,
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

        $cad->weapons()->attach(
            [
                'weapon_id' => $request->weapon_id
            ]
        );

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
        $armors = Armor::all();
        $shields = Shield::all();
        return view('create', compact('char', 'users', 'breeds', 'classes', 'weapons', 'armors', 'shields'));
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

        ]);

        $sql = DB::table('char_weapons')->count('char_id');
        if ($sql > 5) {
            return Redirect()->back()->withErrors(['msg', 'The Message']);
        } else {
            $edit = Char::find($id);
            $edit->weapons()->attach([
                'weapon_id' => $request->weapon_id
            ]);
            if ($edit)
                return redirect('chars');
        }
    }

    public function destroy($id)
    {
        $char_id = $this->objChar->destroy($id);
        $sql = "Delete from chars ";
        $sql = $sql . " WHERE id = '$char_id'  ";
        $delete = DB::delete($sql);

        return redirect('chars');
    }

    public function infoweapon(Request $request)
    {
        $dataForm = $request->all();
        $weapon_id = $dataForm['weapon_id'];
        $sql = "Select * from weapons ";
        $sql = $sql . " WHERE id = '$weapon_id'  ";
        $weapons = DB::select($sql);
        return view('funcao_ajax', ['weapons' => $weapons]);
    }

    public function infomyweapon(Request $request)
    {
        $dataForm = $request->all();
        $myweapon_id = $dataForm['myweapon_id'];
        $sql = "Select * from weapons ";
        $sql = $sql . " WHERE id = '$myweapon_id'  ";
        $weapons = DB::select($sql);
        return view('funcao_ajax', ['weapons' => $weapons]);
    }

    public function delmyweapon(Request $request)
    {
        $dataForm = $request->all();
        $myweapon_id = $dataForm['myweapon_id'];
        $sql = "Delete from char_weapons ";
        $sql = $sql . " WHERE weapon_id = '$myweapon_id'  ";
        $weapons = DB::delete($sql);
        return redirect()->back();
    }

    public function addweapon(Request $request, $id)
    {
        $edit = Char::find($id);
        $dataForm = $request->all();
        $weapon_id = $dataForm['weapon_id'];
        $sql = "Insert into char_weapons (char_id, weapon_id) ";
        $sql = $sql . " VALUES char_id = '$edit', ";
        $sql = $sql . " weapon_id = '$weapon_id' ";
        $weapons = DB::insert($sql);
        return view('funcao_ajax', ['weapons' => $weapons]);
    }


    public function infoarmor(Request $request)
    {
        $dataForm = $request->all();
        $armor_id = $dataForm['armor_id'];
        $sql = "Select * from armors ";
        $sql = $sql . " WHERE id = '$armor_id'  ";
        $armors = DB::select($sql);
        return view('armors', ['armors' => $armors]);
    }

    public function infoshield(Request $request)
    {
        $dataForm = $request->all();
        $shield_id = $dataForm['shield_id'];
        $sql = "Select * from shields ";
        $sql = $sql . " WHERE id = '$shield_id'  ";
        $shields = DB::select($sql);
        return view('shields', ['shields' => $shields]);
    }
}
