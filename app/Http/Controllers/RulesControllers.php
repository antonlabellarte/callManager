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

    public function filter(Request $request){
        $rulesService = $request->input('service');
        $rulesFlag = $request->input('flag');
        $rulesDateStart = $request->input('dateStart');
        $rulesDateEnd = $request->input('dateEnd');
        $rulesStartTime = $request->input('startTime');
        $rulesEndTime = $request->input('endTime');

        // Query particolare per far sì che accetti valori vuoti
        $query = Rules::query();

        if (!empty($rulesService)) {
            $query->where('servizioPartizionato', 'like', $rulesService . '%');
        }

        if (!empty($rulesFlag)) {
            $query->where('dataFlag', $rulesFlag);
        }

        if (!empty($rulesDateStart)) {
            $query->whereDate('dataInizio', $rulesDateStart);
        }

        if (!empty($rulesDateEnd)) {
            $query->whereDate('dataFine', $rulesDateEnd);
        }

        if (!empty($rulesStartTime)) {
            $query->whereTime('oraInizio', $rulesStartTime);
        }

        if (!empty($rulesEndTime)) {
            $query->whereTime('oraFine', $rulesEndTime);
        }

        $rules = $query->get();

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

        $servizioPartizionato = $request->input('service');
        $rule->servizioPartizionato = $servizioPartizionato;

        $rule->dataInizio = $request->input('startDate'); $dataInizio = $request->input('startDate');
        $rule->dataFine = $request->input('endDate'); $dataFine = $request->input('endDate');
        $rule->dataFlag = $request->input('flag'); $dataFlag = $request->input('flag');
        $rule->oraInizio = $request->input('startTime') . ":00"; $oraInizio = $request->input('startTime') . ":00";
        $rule->oraFine = $request->input('endTime') . ":00"; $oraFine = $request->input('endTime') . ":00";
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
                return redirect()->back()->with('sameRuleNoDates', $sameRuleNoDates)->with('sameRuleFoundNoDates', 'Attenzione: non puoi inserire una regola uguale');
            } elseif ($justTimeOverlap->isNotEmpty()) {
                // Trovato accavallamento
                return redirect()->back()->with('justTimeOverlap', $justTimeOverlap)->with('overlapFoundNoDates', 'Attenzione: trovato accavallamento');
            } else {
                // Salva
                $rule->save();
                return redirect()->back()->with('success', 'Regola inserita correttamente');
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
                return view('rules.index')->with('success', 'Regola inserita correttamente');
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
        $rule = Rules::find($id);

        $servizioPartizionato = $request->input('service');
        $rule->servizioPartizionato = $servizioPartizionato;

        $rule->dataInizio = $request->input('startDate'); $dataInizio = $request->input('startDate');
        $rule->dataFine = $request->input('endDate'); $dataFine = $request->input('endDate');
        $rule->dataFlag = $request->input('flag'); $dataFlag = $request->input('flag');
        $rule->oraInizio = $request->input('startTime') . ":00"; $oraInizio = $request->input('startTime') . ":00";
        $rule->oraFine = $request->input('endTime') . ":00"; $oraFine = $request->input('endTime') . ":00";

        $dataOraInizio = $dataInizio . $oraInizio;
        $dataOraFine = $dataFine . $oraFine;

        $rule->servizioUno = $request->input('firstQueuePair'); $servizioUno = $request->input('firstQueuePair');
        $rule->percentualeUno = $request->input('firstPartition'); $percentualeUno = $request->input('firstPartition');
        $rule->servizioDue = $request->input('secondQueuePair');  $servizioDue = $request->input('secondQueuePair');
        $rule->percentualeDue = $request->input('secondPartition'); $percentualeDue = $request->input('secondPartition');
        $rule->servizioTre = $request->input('thirdQueuePair'); $servizioTre = $request->input('thirdQueuePair');
        $rule->percentualeTre = $request->input('thirdPartition'); $percentualeTre = $request->input('thirdPartition');

        // Controllo senza date
        if( $request->input('flag') == "ALL" || $request->input('flag') == "SABATO" || $request->input('flag') == "DOMENICA" ) {
            
            // Controlla accavallamenti
            $overlapWithoutDates = Rules::where('ServizioPartizionato', $servizioPartizionato)
                ->where('DataFlag', $dataFlag)
                ->whereRaw('? < OraFine', [$oraInizio])
                ->whereRaw('? > OraInizio', [$oraFine])
                ->where('ID', '!=', (int) $id)
                ->get();

            // Se trova accavallamentei
            if ($overlapWithoutDates->IsNotEmpty() ) {
                return back()->with('found', 'Accavallamento trovato');
            } else {
                $rule->update($request->all());
                return back()->with('success', 'Regola modificata');
            }
        } elseif ($request->input('flag') == 'GIORNO') {
            // Controllo accavallamenti
            $overlapWithDates = Rules::where('ServizioPartizionato', $servizioPartizionato)
                ->where('DataFlag', 'GIORNO')
                ->whereRaw(
                    '? < (CAST(DataFine AS DATETIME) + CAST(OraFine AS DATETIME)) 
                    AND ? > (CAST(DataInizio AS DATETIME) + CAST(OraInizio AS DATETIME))',
                    [$dataOraInizio, $dataOraFine]
                )
                ->where('ID', '!=', (int) $id)
                ->get();

            if ($overlapWithDates->IsNotEmpty()) {
                return back()->with('found', 'Attenzione: sono stati trovati degli accavallamenti');
            } else {
                $rule->update($request->all());
                return back()->with('success', 'Regola modificata correttamente');
            }
        }
    }

    
    public function destroy(string $id){
        $rule = Rules::find($id);       
        $rule->delete();        
        return back()->with('erased', 'Regola eliminata');
    }
}