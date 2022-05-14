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

        return view('edit', compact('char', 'users', 'breeds', 'classes', 'weapons', 'armors', 'shields', 'talents', 'skills', 'magics', 'char_weapons'));
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

    // FUNCOES UTILIZADAS PELO AJAX PARA MOSTRAR, INSERIR E DELETAR ARMAS DO PERSONAGEM
    public function infoweapon(Request $request)
    {
        $dataForm = $request->all();
        $weapon_id = $dataForm['weapon_id'];
        $sql = "Select * from weapons ";
        $sql = $sql . " WHERE id = '$weapon_id'  ";
        $weapons = DB::select($sql);
        return view('weapon', ['weapons' => $weapons]);
    }

    /*
    public function infomyweapon(Request $request)
    {
        $dataForm = $request->all();
        $myweapon_id = $dataForm['myweapon_id'];
        $sql = "Select * from weapons ";
        $sql = $sql . " WHERE id = '$myweapon_id'  ";
        $weapons = DB::select($sql);
        return view('funcao_ajax', ['weapons' => $weapons]);
    }
    */

    public function infomyweapon(Request $request)
    {
        $char_id = $request->input('char_id');
        $dataForm = $request->all();
        $myweapon_id = $dataForm['myweapon_id'];
        $sql = "Select weapons.name, weapons.desc, weapons.damage, char_weapons.observation, chars.modstr FROM char_weapons ";
        $sql = $sql . " INNER JOIN weapons ON char_weapons.weapon_id = weapons.id  ";
        $sql = $sql . " INNER JOIN chars ON char_weapons.char_id = chars.id  ";
        $sql = $sql . " WHERE chars.id = '$char_id' AND weapons.id = '$myweapon_id'";
        $weapons = DB::select($sql);
        return view('myweapon', ['weapons' => $weapons]);
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

    public function addweapon(Request $request)
    {
        $observation = $request->input('observation');
        $char_id = $request->input('char_id');
        $dataForm = $request->all();
        $weapon_id = $dataForm['weapon_id'];
        $sql = DB::table('char_weapons')->where('char_id', $char_id)->count('char_id');
        if ($sql >= 5) {
            return Redirect()->back()->withErrors(['msg', 'Erro']);
        } else {
            $weapons = DB::table('char_weapons')->insert([
                'char_id' => $char_id,
                'weapon_id' => $weapon_id,
                'observation' => $observation
            ]);
        }
        if ($weapons)
            return redirect('chars');
        else redirect('chars');
    }


    // FIM DAS FUNCOES DA ARMA

        // FUNCOES UTILIZADAS PELO AJAX PARA MOSTRAR, INSERIR E DELETAR TALENTOS DO PERSONAGEM
        public function infotalent(Request $request)
        {
            $dataForm = $request->all();
            $talent_id = $dataForm['talent_id'];
            $sql = "Select * from talents ";
            $sql = $sql . " WHERE id = '$talent_id'  ";
            $talents = DB::select($sql);
            return view('talent', ['talents' => $talents]);
        }
    
        public function infomytalent(Request $request)
        {
            $dataForm = $request->all();
            $mytalent_id = $dataForm['mytalent_id'];
            $sql = "Select * from talents ";
            $sql = $sql . " WHERE id = '$mytalent_id'  ";
            $talents = DB::select($sql);
            return view('talent', ['talents' => $talents]);
        }
    
        public function delmytalent(Request $request)
        {
            $dataForm = $request->all();
            $mytalent_id = $dataForm['mytalent_id'];
            $sql = "Delete from char_weapons ";
            $sql = $sql . " WHERE talent_id = '$mytalent_id'  ";
            $talents = DB::delete($sql);
            return redirect()->back();
        }
    
        public function addtalent(Request $request)
        {
            $char_id = $request->input('char_id');
            $dataForm = $request->all();
            $talent_id = $dataForm['talent_id'];
                $talents = DB::table('char_talents')->insert([
                    'char_id' => $char_id,
                    'talent_id' => $talent_id
                ]);
            
            if ($talents)
                return redirect('chars');
            else redirect('chars');
        }
        // FIM DAS FUNCOES DO TALENTO

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
