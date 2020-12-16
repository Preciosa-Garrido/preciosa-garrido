<?php

namespace App\Http\Controllers\Admin;

use App\Models\Parceiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParceiroPageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.parceiros.index', ['parceiros' => Parceiro::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.parceiros.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'parceiro' => ['required', 'string', 'unique:parceiros'],
            'site' => ['url', 'required', 'string', 'unique:parceiros'],
            'logo' => ['required']
        ]);

        $parceiro = $request->all();

        if($request->hasFile('logo') && $request->file('logo')->isValid()):
            $name = 'parceiro_'.time();

            $extensao = $request->logo->extension();

            $nomeArquivo = "{$name}.{$extensao}";

            $parceiro['logo'] = $nomeArquivo;

            $request->logo->storeAs('public/parceiros', $nomeArquivo);
        endif;

        if(Parceiro::create($parceiro))
            return redirect()->back()->with('mensagem', 'Parceiro cadastrado com sucesso');

        return redirect()->back()->with('mensagem', 'Erro ao cadastrar parceiro');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.parceiros.show', ['parceiro' => Parceiro::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.parceiros.edit', ['parceiro' => Parceiro::find($id)]);
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
        $partner = Parceiro::find($id);
        $parceiro = $request->all();
        
        if ($partner->parceiro == $parceiro['parceiro']) {
            $this->validate($request, [
                'parceiro' => ['required', 'string'],
                'site' => ['url', 'required', 'string'],
                'logo' => ['required']
            ]);
        } else {
            $this->validate($request, [
                'parceiro' => ['required', 'string', 'unique:parceiros'],
                'site' => ['url', 'required', 'string', 'unique:parceiros'],
                'logo' => ['required']
            ]);
        }

        if($request->hasFile('logo') && $request->file('logo')->isValid()):
            $name = 'parceiro_'.time();

            $extensao = $request->logo->extension();

            $nomeArquivo = "{$name}.{$extensao}";

            $parceiro['logo'] = $nomeArquivo;

            $request->logo->storeAs('public/parceiros', $nomeArquivo);
        endif;

        if($partner->fill($parceiro)->update())
            return redirect()->back()->with('mensagem', 'Parceiro actualizado com sucesso');

        return redirect()->back()->with('mensagem', 'Erro ao actualizar parceiro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Parceiro::destroy($id))
            return redirect()->route('parceiros.consultar')->with('mensagem', 'Parceiro removido');

        return redirect()->back()->with('mensagem', 'Erro ao remover parceiro');
    }
}
