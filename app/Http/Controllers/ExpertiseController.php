<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Expertise;
use App\Models\Char;

class ExpertiseController extends Controller
{
    public function __construct()
    {
        $this->objExp = new Expertise();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exp = Expertise::all();
        return view('forge', compact('exp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teste');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cad = Expertise::create([
            //bd                html
            'abrirT' => $request->abrirT,
            'abrirG' => $request->abrirG,
            'abrirO' => $request->abrirO,
            'abrirK' => $request->abrirK,
            'acrobT' => $request->acrobT,
            'acrobG' => $request->acrobG,
            'acrobO' => $request->acrobO,
            'acrobK' => $request->acrobK,
            'adesT' => $request->adesT,
            'adesG' => $request->adesG,
            'adesO' => $request->adesO,
            'adesK' => $request->adesK,
            'arteT' => $request->arteT,
            'arteG' => $request->arteG,
            'arteO' => $request->arteO,
            'arteK' => $request->arteK,
            'atuaT' => $request->atuaT,
            'atuaG' => $request->atuaG,
            'atuaO' => $request->atuaO,
            'atuaK' => $request->atuaK,
            'atuaT1' => $request->atuaT1,
            'atuaG1' => $request->atuaG1,
            'atuaO1' => $request->atuaO1,
            'atuaK1' => $request->atuaK1,
            'atuaT2' => $request->atuaT2,
            'atuaG2' => $request->atuaG2,
            'atuaO2' => $request->atuaO2,
            'atuaK2' => $request->atuaK2,
            'avaliaT' => $request->avaliaT,
            'avaliaG' => $request->avaliaG,
            'avaliaO' => $request->avaliaO,
            'avaliaK' => $request->avaliaK,
            'blefaT' => $request->blefaT,
            'blefaG' => $request->blefaG,
            'blefaO' => $request->blefaO,
            'blefaK' => $request->blefaK,
            'cavalgaT' => $request->cavalgaT,
            'cavalgaG' => $request->cavalgaG,
            'cavalgaO' => $request->cavalgaO,
            'cavalgaK' => $request->cavalgaK,
            'concentraT' => $request->concentraT,
            'concentraG' => $request->concentraG,
            'concentraO' => $request->concentraO,
            'concentraK' => $request->concentraK,
            'conheceT' => $request->conheceT,
            'conheceG' => $request->conheceG,
            'conheceO' => $request->conheceO,
            'conheceK' => $request->conheceK,
            'conheceT1' => $request->conheceT1,
            'conheceG1' => $request->conheceG1,
            'conheceO1' => $request->conheceO1,
            'conheceK1' => $request->conheceK1,
            'conheceT2' => $request->conheceT2,
            'conheceG2' => $request->conheceG2,
            'conheceO2' => $request->conheceO2,
            'comheceK2' => $request->conheceK2,
            'curaT' => $request->curaT,
            'curaG' => $request->curaG,
            'curaO' => $request->curaO,
            'curaK' => $request->curaK,
            'decifraT' => $request->decifraT,
            'decifraG' => $request->decifraG,
            'decifraO' => $request->decifraO,
            'decifraK' => $request->decifraK,
            'diplomaT' => $request->diplomaT,
            'diplomaG' => $request->diplomaG,
            'diplomaO' => $request->diplomaO,
            'diplomaK' => $request->diplomaK,
            'disfarceT' => $request->disfarceT,
            'disfarceG' => $request->disfarceG,
            'disfarceO' => $request->disfarceO,
            'disfarceK' => $request->disfarceK,
            'equilT' => $request->equilT,
            'equilG' => $request->equilG,
            'equilO' => $request->equilO,
            'quilK' => $request->equilK,
            'escalaT' => $request->escalaT,
            'escalaG' => $request->escalaG,
            'escalaO' => $request->escalaO,
            'escalaK' => $request->escalaK,
            'escondeT' => $request->escondeT,
            'escondeG' => $request->escondeG,
            'escondeO' => $request->escondeO,
            'escondeK' => $request->escondeK,
            'fasificaT' => $request->falsificaT,
            'falsificaG' => $request->falsificaG,
            'falsificaO' => $request->falsificaO,
            'falsificaK' => $request->falsificaK,
            'furtivoT' => $request->furtivoT,
            'furtivoG' => $request->furtivoG,
            'furtivoO' => $request->furtivoO,
            'furtivoK' => $request->furtivoK,
            'idenT' => $request->idenT,
            'idenG' => $request->idenG,
            'idenO' => $request->idenO,
            'idenK' => $request->idenK,
            'intimidaT' => $request->intimidaT,
            'intimidaG' => $request->intimidaG,
            'intimidaO' => $request->intimidaO,
            'intimidaK' => $request->intimidaK,
            'nadaT' => $request->nadaT,
            'nadaG' => $request->nagaG,
            'nadaO' => $request->nadaO,
            'nadaK' => $request->nadaK,
            'observaT' => $request->observaT,
            'observaG' => $request->observaG,
            'observaO' => $request->observaO,
            'observaK' => $request->observaK,
            'obterT' => $request->obterT,
            'obterG' => $request->obterG,
            'obterO' => $request->obterO,
            'obterK' => $request->obterK,
            'oficioT' => $request->oficioT,
            'oficioG' => $request->oficioG,
            'oficioO' => $request->oficioO,
            'oficioK' => $request->oficioK,
            'operarT' => $request->operarT,
            'operarG' => $request->operarG,
            'operarO' => $request->operarO,
            'operarK' => $request->operarK,
            'ouvirT' => $request->ouvirT,
            'ouvirG' => $request->ouvirG,
            'ouvirO' => $request->ouvirO,
            'ouvirK' => $request->ouvirK,
            'procuraT' => $request->procuraT,
            'procuraG' => $request->procuraG,
            'procuraO' => $request->procuraO,
            'procuraK' => $request->procuraK,
            'profissaoT' => $request->profissaoT,
            'profissaoG' => $request->profissaoG,
            'profissaoO' => $request->profissaoO,
            'profissaoK' => $request->profissaoK,
            'prestT' => $request->prestT,
            'prestG' => $request->prestG,
            'prestO' => $request->prestO,
            'prestK' => $request->prestK,
            'saltarT' => $request->saltarT,
            'saltarG' => $request->saltarG,
            'saltarO' => $request->saltarO,
            'saltarK' => $request->saltarK,
            'sentirT' => $request->sentirT,
            'sentirG' => $request->sentirG,
            'sentirO' => $request->sentirO,
            'sentirK' => $request->sentirK,
            'sobreT' => $request->prestT,
            'sobreG' => $request->sobreG,
            'sobreO' => $request->sobreO,
            'sobreK' => $request->sobreK,
            'usacordaT' => $request->usacordaT,
            'usacordaG' => $request->usacordaG,
            'usacordaO' => $request->usacordaO,
            'usacordaK' => $request->usacordaK,
            'usarmagicoT' => $request->usarmagicoT,
            'usarmagicoG' => $request->usarmagicoG,
            'usarmagicoO' => $request->usarmagicoO,
            'usarmagicoK' => $request->usarmagicoK,
            'otherT' => $request->otherT,
            'otherG' => $request->otherG,
            'otherO' => $request->otherO,
            'otherK' => $request->otherK,
            'otherT1' => $request->otherT1,
            'otherG1' => $request->otherG1,
            'otherO1' => $request->otherO1,
            'otherK1' => $request->otherK1,
            'otherT2' => $request->otherT2,
            'otherG2' => $request->otherG2,
            'otherO2' => $request->otherO2,
            'otherK2' => $request->otherK2


        ]);
        if ($cad)

            return view('forge');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('equips');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expertise = Expertise::find($id);
        
        return view('teste', compact('expertise'));
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
        $edit = Expertise::where(['id' => $id])->update([
            //bd                html
            'abrirT' => $request->abrirT,
            'abrirG' => $request->abrirG,
            'abrirO' => $request->abrirO,
            'abrirK' => $request->abrirK,
            'acrobT' => $request->acrobT,
            'acrobG' => $request->acrobG,
            'acrobO' => $request->acrobO,
            'acrobK' => $request->acrobK,
            'adesT' => $request->adesT,
            'adesG' => $request->adesG,
            'adesO' => $request->adesO,
            'adesK' => $request->adesK,
            'arteT' => $request->arteT,
            'arteG' => $request->arteG,
            'arteO' => $request->arteO,
            'arteK' => $request->arteK,
            'atuaT' => $request->atuaT,
            'atuaG' => $request->atuaG,
            'atuaO' => $request->atuaO,
            'atuaK' => $request->atuaK,
            'atuaT1' => $request->atuaT1,
            'atuaG1' => $request->atuaG1,
            'atuaO1' => $request->atuaO1,
            'atuaK1' => $request->atuaK1,
            'atuaT2' => $request->atuaT2,
            'atuaG2' => $request->atuaG2,
            'atuaO2' => $request->atuaO2,
            'atuaK2' => $request->atuaK2,
            'avaliaT' => $request->avaliaT,
            'avaliaG' => $request->avaliaG,
            'avaliaO' => $request->avaliaO,
            'avaliaK' => $request->avaliaK,
            'blefaT' => $request->blefaT,
            'blefaG' => $request->blefaG,
            'blefaO' => $request->blefaO,
            'blefaK' => $request->blefaK,
            'cavalgaT' => $request->cavalgaT,
            'cavalgaG' => $request->cavalgaG,
            'cavalgaO' => $request->cavalgaO,
            'cavalgaK' => $request->cavalgaK,
            'concentraT' => $request->concentraT,
            'concentraG' => $request->concentraG,
            'concentraO' => $request->concentraO,
            'concentraK' => $request->concentraK,
            'conheceT' => $request->conheceT,
            'conheceG' => $request->conheceG,
            'conheceO' => $request->conheceO,
            'conheceK' => $request->conheceK,
            'conheceT1' => $request->conheceT1,
            'conheceG1' => $request->conheceG1,
            'conheceO1' => $request->conheceO1,
            'conheceK1' => $request->conheceK1,
            'conheceT2' => $request->conheceT2,
            'conheceG2' => $request->conheceG2,
            'conheceO2' => $request->conheceO2,
            'comheceK2' => $request->conheceK2,
            'curaT' => $request->curaT,
            'curaG' => $request->curaG,
            'curaO' => $request->curaO,
            'curaK' => $request->curaK,
            'decifraT' => $request->decifraT,
            'decifraG' => $request->decifraG,
            'decifraO' => $request->decifraO,
            'decifraK' => $request->decifraK,
            'diplomaT' => $request->diplomaT,
            'diplomaG' => $request->diplomaG,
            'diplomaO' => $request->diplomaO,
            'diplomaK' => $request->diplomaK,
            'disfarceT' => $request->disfarceT,
            'disfarceG' => $request->disfarceG,
            'disfarceO' => $request->disfarceO,
            'disfarceK' => $request->disfarceK,
            'equilT' => $request->equilT,
            'equilG' => $request->equilG,
            'equilO' => $request->equilO,
            'quilK' => $request->equilK,
            'escalaT' => $request->escalaT,
            'escalaG' => $request->escalaG,
            'escalaO' => $request->escalaO,
            'escalaK' => $request->escalaK,
            'escondeT' => $request->escondeT,
            'escondeG' => $request->escondeG,
            'escondeO' => $request->escondeO,
            'escondeK' => $request->escondeK,
            'fasificaT' => $request->falsificaT,
            'falsificaG' => $request->falsificaG,
            'falsificaO' => $request->falsificaO,
            'falsificaK' => $request->falsificaK,
            'furtivoT' => $request->furtivoT,
            'furtivoG' => $request->furtivoG,
            'furtivoO' => $request->furtivoO,
            'furtivoK' => $request->furtivoK,
            'idenT' => $request->idenT,
            'idenG' => $request->idenG,
            'idenO' => $request->idenO,
            'idenK' => $request->idenK,
            'intimidaT' => $request->intimidaT,
            'intimidaG' => $request->intimidaG,
            'intimidaO' => $request->intimidaO,
            'intimidaK' => $request->intimidaK,
            'nadaT' => $request->nadaT,
            'nadaG' => $request->nagaG,
            'nadaO' => $request->nadaO,
            'nadaK' => $request->nadaK,
            'observaT' => $request->observaT,
            'observaG' => $request->observaG,
            'observaO' => $request->observaO,
            'observaK' => $request->observaK,
            'obterT' => $request->obterT,
            'obterG' => $request->obterG,
            'obterO' => $request->obterO,
            'obterK' => $request->obterK,
            'oficioT' => $request->oficioT,
            'oficioG' => $request->oficioG,
            'oficioO' => $request->oficioO,
            'oficioK' => $request->oficioK,
            'operarT' => $request->operarT,
            'operarG' => $request->operarG,
            'operarO' => $request->operarO,
            'operarK' => $request->operarK,
            'ouvirT' => $request->ouvirT,
            'ouvirG' => $request->ouvirG,
            'ouvirO' => $request->ouvirO,
            'ouvirK' => $request->ouvirK,
            'procuraT' => $request->procuraT,
            'procuraG' => $request->procuraG,
            'procuraO' => $request->procuraO,
            'procuraK' => $request->procuraK,
            'profissaoT' => $request->profissaoT,
            'profissaoG' => $request->profissaoG,
            'profissaoO' => $request->profissaoO,
            'profissaoK' => $request->profissaoK,
            'prestT' => $request->prestT,
            'prestG' => $request->prestG,
            'prestO' => $request->prestO,
            'prestK' => $request->prestK,
            'saltarT' => $request->saltarT,
            'saltarG' => $request->saltarG,
            'saltarO' => $request->saltarO,
            'saltarK' => $request->saltarK,
            'sentirT' => $request->sentirT,
            'sentirG' => $request->sentirG,
            'sentirO' => $request->sentirO,
            'sentirK' => $request->sentirK,
            'sobreT' => $request->prestT,
            'sobreG' => $request->sobreG,
            'sobreO' => $request->sobreO,
            'sobreK' => $request->sobreK,
            'usacordaT' => $request->usacordaT,
            'usacordaG' => $request->usacordaG,
            'usacordaO' => $request->usacordaO,
            'usacordaK' => $request->usacordaK,
            'usarmagicoT' => $request->usarmagicoT,
            'usarmagicoG' => $request->usarmagicoG,
            'usarmagicoO' => $request->usarmagicoO,
            'usarmagicoK' => $request->usarmagicoK,
            'otherT' => $request->otherT,
            'otherG' => $request->otherG,
            'otherO' => $request->otherO,
            'otherK' => $request->otherK,
            'otherT1' => $request->otherT1,
            'otherG1' => $request->otherG1,
            'otherO1' => $request->otherO1,
            'otherK1' => $request->otherK1,
            'otherT2' => $request->otherT2,
            'otherG2' => $request->otherG2,
            'otherO2' => $request->otherO2,
            'otherK2' => $request->otherK2


        ]);
        if ($edit)

            return view('teste');
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


    public function insert(Request $request)
    {
        $name = $request->name;
        $value = $request->value;
        $habmod = $request->habmod;
        $graduation = $request->graduation;
        $other = $request->other;
        $teste = DB::insert('insert into expertises (name, value, habmod, graduation, other)
         values (?, ?, ?, ?, ?)', [$name, $value, $habmod, $graduation, $other]);
        return view("forge", ['teste' => $teste]);
    }
}
