<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;

class TarefasExport implements FromCollection
{
    public function collection()
    {
        return Tarefa::all();
    }
}
