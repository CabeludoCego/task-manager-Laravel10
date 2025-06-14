<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{

public function __construct(){
	$this->middleware('auth');
	// 'Faz mais sentido'.
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        // $tarefas = Tarefa::where('user_id', $user_id)->get();
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(5);

        // dd($tarefas);
        return view ('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $dados = $request->all();

        $dados = $request->all(['tarefa', 'data_limite']);
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
        // dd($tarefa->getAttributes());

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id; // Se usuário atual == criador da tarefa:
        if ($tarefa->user_id !== $user_id) {
            return view('acesso-negado');
        };
        return view('tarefa.edit', ['tarefa'=>$tarefa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $user_id = auth()->user()->id; // Se usuário atual != criador da tarefa:
        if ($tarefa->user_id !== $user_id) {
            return view('acesso-negado');
        }
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        // dd($tarefa);
        $user_id = auth()->user()->id; // Se usuário atual != criador da tarefa:
        if ($tarefa->user_id !== $user_id) {
            return view('acesso-negado');
        }
        $tarefa->delete();
        return redirect()->route('tarefa.index');
    }
    
    public function export(string $extensao) 
    {
        if ($extensao == 'xlsx' || $extensao == 'csv'){
            $filename = 'lista_de_tarefas.'.$extensao;
        } else {
            return redirect()->route('tarefa.index');
        }
        return Excel::download(new TarefasExport, $filename);
    }
}
