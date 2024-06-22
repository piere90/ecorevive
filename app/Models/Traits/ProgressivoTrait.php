<?php

namespace App\Models\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;

trait ProgressivoTrait
{
    public function calculateProgressivo($model)
    {
        // Recupera la data attuale
        $today = Carbon::now()->toDateString();

        // Recupera l'ultimo record del giorno
        $lastRecord = $model::whereDate('created_at', $today)->orderBy('progressivo', 'desc')->first();

        // Se esiste un record per oggi, incrementa il progressivo, altrimenti inizializzalo a 1
        return $lastRecord ? $lastRecord->progressivo + 1 : 1;
    }

    public function addProgressivoToRequest(Request $request, $model)
    {
        $progressivo = $this->calculateProgressivo($model);

        // Inserisci il valore di progressivo nella richiesta
        $request->merge(['progressivo' => $progressivo]);

        return $request;
    }
}
