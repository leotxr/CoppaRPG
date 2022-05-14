<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armor;
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

class TalentController extends Controller
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
        $sql = "Delete from char_talents ";
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
}
