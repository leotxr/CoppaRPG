<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
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

     public function skillbylevel(Request $request)
     {
         $dataForm = $request->all();
         $class_id = $dataForm['class_id'];
         $level = $request->input('level');
         $sql = "Select * from skills ";
         $sql = $sql . " WHERE class_id = '$class_id'  AND level <= '$level'";
         $sql = $sql . "ORDER BY level";
         $skills = DB::select($sql);
         return view('skillbylevel', ['skills' => $skills]);
     }
 
     public function infoskill(Request $request)
     {
         $dataForm = $request->all();
         $skill_id = $dataForm['skill_id'];
         $sql = "Select * from skills ";
         $sql = $sql . " WHERE id = '$skill_id'  ";
         $skills = DB::select($sql);
         return view('skill', ['skills' => $skills]);
     }
 
     public function infomyskill(Request $request)
     {
         $dataForm = $request->all();
         $myskill_id = $dataForm['myskill_id'];
         $sql = "Select * from skills ";
         $sql = $sql . " WHERE id = '$myskill_id'  ";
         $skills = DB::select($sql);
         return view('skill', ['skills' => $skills]);
     }
 
     public function delmyskill(Request $request)
     {
         $dataForm = $request->all();
         $myskill_id = $dataForm['myskill_id'];
         $sql = "Delete from char_skills ";
         $sql = $sql . " WHERE skill_id = '$myskill_id'  ";
         $skills = DB::delete($sql);
         return redirect()->back();
     }
 
     public function addskill(Request $request)
     {
         $char_id = $request->input('char_id');
         $dataForm = $request->all();
         $skill_id = $dataForm['skill_id'];
         $skills = DB::table('char_skills')->insert([
             'char_id' => $char_id,
             'skill_id' => $skill_id
         ]);
 
         if ($skills)
             return redirect('chars');
         else redirect('chars');
     }
     // FIM DAS FUNCOES DA MAGIA
}
