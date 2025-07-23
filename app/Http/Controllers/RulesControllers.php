<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rules;
use App\Models\Services;

class RulesControllers extends Controller
{

    // Visualizza tutte le regole
    public function index(){
        $rules = Rules::all();

        return view('rules.index', compact('rules'));
    }

    // Pagina di creazione regola
    public function create(){

        // Servizio dove tipologia = principale
        $servicesPrincipali = Services::where('typology', 'principale')->get();

        // Servizio dove typology = partizione
        $servicesPartizionati = Services::where('typology', 'secondaria')->get();

        return view('rules.add', compact('servicesPrincipali', 'servicesPartizionati'));
    }
    
    public function store(Request $request){
        $rule = new Rules();

        $rule->servizioPartizionato = $request->input('service'); $servizioPartizionato = $request->input('service');
        $rule->dataInizio = $request->input('startDate'); $dataInizio = $request->input('startDate');
        $rule->dataFine = $request->input('endDate'); $dataFine = $request->input('endDate');
        $rule->dataFlag = $request->input('flag'); $dataFlag = $request->input('flag');
        $rule->oraInizio = $request->input('startHour') . ":" . $request->input('startMinute') . ":00"; $oraInizio = $request->input('startHour') . ":" . $request->input('startMinute') . ":00";
        $rule->oraFine = $request->input('endHour') . ":" . $request->input('endMinute') . ":00"; $oraFine = $request->input('endHour') . ":" . $request->input('endMinute') . ":00";
        $rule->servizioUno = $request->input('firstQueuePair'); $servizioUno = $request->input('firstQueuePair');
        $rule->percentualeUno = $request->input('firstPartition'); $percentualeUno = $request->input('firstPartition');
        $rule->servizioDue = $request->input('secondQueuePair');  $servizioDue = $request->input('secondQueuePair');
        $rule->percentualeDue = $request->input('secondPartition'); $percentualeDue = $request->input('secondPartition');
        $rule->servizioTre = $request->input('thirdQueuePair'); $servizioTre = $request->input('thirdQueuePair');
        $rule->percentualeTre = $request->input('thirdPartition'); $percentualeTre = $request->input('thirdPartition');

        // Inserimento e controllo senza date
        if( $request->input('flag') == "ALL" || $request->input('flag') == "SABATO" || $request->input('flag') == "DOMENICA" ) {
            
            // Controlla la sovrapposizione solo tra gli orari
            $justTimeOverlap = Rules::where('servizioPartizionato', $servizioPartizionato)
                ->where('dataFlag', $dataFlag)
                ->where('oraFine', '>', $oraInizio)
                ->where('oraInizio', '<', $oraFine)
            ->get();

            $sameRuleNoDates = Rules::where('servizioPartizionato', $servizioPartizionato)
                ->where('dataFlag', $dataFlag)
                ->where('oraInizio', $oraInizio)
                ->where('oraFine', $oraFine)
                ->where('servizioUno', $servizioUno)
                ->where('percentualeUno', $percentualeUno)
                ->where(function($query) use ($servizioDue) {
                    $query->whereNull('servizioDue')
                        ->orWhere('servizioDue', $servizioDue);
                })
                ->where(function($query) use ($percentualeDue) {
                    $query->whereNull('percentualeDue')
                        ->orWhere('percentualeDue', $percentualeDue);
                })
                ->where(function($query) use ($servizioTre) {
                    $query->whereNull('servizioTre')
                        ->orWhere('servizioTre', $servizioTre);
                })
                ->where(function($query) use ($percentualeTre) {
                    $query->whereNull('percentualeTre')
                        ->orWhere('percentualeTre', $percentualeTre);
                })
            ->get();
            
            if ($sameRuleNoDates->isNotEmpty()) {
                // Trovata regola uguale
                return redirect()->back()->with('sameRuleFoundNoDates', 'Trovata regola uguale');
            } elseif ($justTimeOverlap->isNotEmpty()) {
                // Trovato accavallamento
                return redirect()->back()->with('overlapFoundNoDates', 'Trovato accavallamento');
            } else {
                // Salva
                $rule->save();
                return redirect()->back();
            }



        } elseif ($request->input('flag') == 'GIORNO') {

            $overlapWithDates = Rules::where('servizioPartizionato', $servizioPartizionato)
            ->where('dataFlag', 'GIORNO')
            ->whereRaw('? < STR_TO_DATE(CONCAT(dataFine, " ", oraFine), "%Y-%m-%d %H:%i:%s")', [$dataInizio . " " . $oraInizio])
            ->whereRaw('? > STR_TO_DATE(CONCAT(dataInizio, " ", oraInizio), "%Y-%m-%d %H:%i:%s")', [$dataFine . " " . $oraFine])
            ->get();

            //$sameRuleWithDates = 

            if($overlapWithDates->IsNotEmpty()){
                // Trovato accavallamento
                return redirect()->back()->with('overlapFoundWithDates', 'Trovato accavallamento');
            } else {
                $rule->save();
                return redirect()->back();
            }

        }        
    }

    
    public function edit(string $id){
        $rule = Rules::find($id);

        // Servizio dove tipologia = principale
        $servicesPrincipali = Services::where('typology', 'principale')->get();

        // Servizio dove typology = partizione
        $servicesPartizionati = Services::where('typology', 'secondaria')->get();

        return view('rules.edit', compact('rule', 'servicesPrincipali', 'servicesPartizionati' ));
    }

    
    public function update(Request $request, string $id){
        //
    }

    
    public function destroy(string $id){
        $rule = Rules::find($id);       
        $rule->delete();        
        return back()->with('erased', 'Rule deleted');
    }
}