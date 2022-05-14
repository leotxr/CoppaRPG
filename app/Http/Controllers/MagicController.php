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

class MagicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    // FUNCOES UTILIZADAS PELO AJAX PARA MOSTRAR, INSERIR E DELETAR MAGIAS DO PERSONAGEM
    public function infomagic(Request $request)
    {
        $dataForm = $request->all();
        $magic_id = $dataForm['magic_id'];
        $sql = "Select * from magics ";
        $sql = $sql . " WHERE id = '$magic_id'  ";
        $magics = DB::select($sql);
        return view('magic', ['magics' => $magics]);
    }

    public function infomymagic(Request $request)
    {
        $dataForm = $request->all();
        $mymagic_id = $dataForm['mymagic_id'];
        $sql = "Select * from magics ";
        $sql = $sql . " WHERE id = '$mymagic_id'  ";
        $magics = DB::select($sql);
        return view('magic', ['magics' => $magics]);
    }

    public function delmymagic(Request $request)
    {
        $dataForm = $request->all();
        $mymagic_id = $dataForm['mymagic_id'];
        $sql = "Delete from char_magics ";
        $sql = $sql . " WHERE magic_id = '$mymagic_id'  ";
        $magics = DB::delete($sql);
        return redirect()->back();
    }

    public function addmagic(Request $request)
    {
        $char_id = $request->input('char_id');
        $dataForm = $request->all();
        $magic_id = $dataForm['magic_id'];
        $magics = DB::table('char_magics')->insert([
            'char_id' => $char_id,
            'magic_id' => $magic_id
        ]);

        if ($magics)
            return redirect('chars');
        else redirect('chars');
    }
    // FIM DAS FUNCOES DA MAGIA
}
