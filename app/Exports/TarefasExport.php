<?php

namespace App\Exports;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class TarefasExport implements FromCollection
{
    public function collection()
    {
        /* v1: Retorna todas */
        // return Tarefa::all(); 

        /* ####################################### */
        /* v2: Retorna as do usuário */

        // tarefas_usuario = auth()->user()->tarefas()->get()); // Funciona, Intelephense declara erro
        $tarefas_usuario = auth()->user()->tarefas; // Funcionou sem erro.
        return $tarefas_usuario;
    }
}
