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
        return view('weapon_info', ['chars' => $chars, 'weapons'=>$weapons]);
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

    public function loadweapons(Request $request)
    {
        $dataForm = $request->all();
        $char_id = $dataForm['char_id'];
        $sql = "Select weapons.id, weapons.name from char_weapons, weapons ";
        $sql = $sql . " WHERE char_weapons.weapon_id = weapons.id ";
        $sql = $sql . " and char_weapons.char_id = '$char_id' ";
        $sql = $sql . " order by weapons.name ";
        $weapons = DB::select($sql);
        return view('funcao_ajax', ['weapons'=>$weapons]);
    }
    public function insert()
    {


        return view('forge', compact('users', 'chars'));
    }
}
