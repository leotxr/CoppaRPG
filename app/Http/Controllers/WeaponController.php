<?php

namespace App\Http\Controllers;


use App\Models\Char;
use Illuminate\Support\Facades\Auth;
use App\Models\Weapon;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class WeaponController extends Controller
{
    public function __construct(Char $char, Weapon $weapon)
    {
        $this->char = $char;
        $this->weapon = $weapon;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chars = $this->char
            ->orderBy('name', 'asc')->get();
        $weapons = $this->weapon
            ->Where('id', '=', 0)
            ->orderBy('name', 'asc')->get();
        return view('weapon_info', ['chars' => $chars, 'weapons' => $weapons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function mostrarChars()
    {
        $weapon = Weapon::find(1);
        echo 'Arma ' . $weapon->name . 'pertence a <br>';

        foreach ($weapon->chars as $char) {
            echo $char->name;
        }
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
}
