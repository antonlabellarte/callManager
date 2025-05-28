<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rules;
use App\Models\Queues;

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
        $servicesPrincipali = Queues::where('tipologia', 'principale')->get();

        // Servizio dove tipologia = partizione
        $servicesPartizionati = Queues::where('tipologia', 'secondaria')->get();

        return view('rules.add', compact('servicesPrincipali', 'servicesPartizionati'));
    }
    
    public function store(Request $request){

        $servizio = $request->input('service');
        $flag = $request->input('flag');

        $data_iniziale = $request->input('startDate');
        $data_finale = $request->input('endDate');

        // Composizione ora iniziale
        $oreOraIniziale = $request->input('startHour');
        $minutiOraIniziale = $request->input('startMinute');
        
        $ora_iniziale = $oreOraIniziale . ":" . $minutiOraIniziale . ':00';

        // Composizione ora finale
        $oreOraFinale = $request->input('endHour');
        $minutiOraFinale = $request->input('endMinute');

        $ora_finale = $oreOraFinale . ":" . $minutiOraFinale . ':00';
        
        $coda_uno = $request->input('firstQueuePair');
        $partizione_uno = $request->input('secondPartition');
        $coda_due = $request->input('secondQueuePair');
        $partizione_due = $request->input('secondPartition');
        $coda_tre = $request->input('thirdQueuePair');
        $partizione_tre = $request->input('thirdPartition');

        // Se il flag corrisponde ad ALL, SABATO o DOMENICA non avviene il controllo con le date
        if ( $flag === "ALL" || $flag === "SABATO" || $flag === "DOMENICA") {

            // Query che verifica la presenza di accavvalamenti
            $previousRule = Rules::where('servizio', $servizio)
            ->where('flag', 'like', $flag . '%')
            ->where(function ($query) use ($ora_iniziale, $ora_finale) {
                $query->where('ora_finale', '>=', $ora_iniziale)->where('ora_finale', '<=', $ora_finale);
            })->get();

            
            // Se ha trovato una riga con accavallemento di date, restituisce errore
            if($previousRule->isNotEmpty()) {
                return redirect()->back()->with('found', 'Hours interval found');
            } else {
                //Se non ha trovato righe con accavallamento di date, inserisce la regola
                $rule = new Rules();
                
                $rule->servizio = $servizio;
                // $rule->data_iniziale = $request->input('startDate');
                // $rule->data_finale = $request->input('endDate');
                $rule->flag = $flag;
                $rule->ora_iniziale = $ora_iniziale;
                $rule->ora_finale = $ora_finale;
                $rule->coda_uno = $coda_uno;
                $rule->partizione_uno = $partizione_uno;
                $rule->coda_due = $coda_due;
                $rule->partizione_due = $partizione_due;
                $rule->coda_tre = $coda_tre;
                $rule->partizione_tre = $partizione_tre;
                $rule->save();
                return redirect()->back()->with('succes', 'Rule created');
            }
        } elseif ( $flag === "GIORNO" ) {           

            $dataOraInizio = $data_iniziale . $ora_iniziale;
            $dataOraFine = $data_finale . $ora_finale;

            $previousRule = Rules::where('servizio', $servizio)
            ->where('flag', 'like', $flag . '%')
            ->where(function ($query) use ($dataOraInizio, $dataOraFine) {
                $query->where(function ($q) use ($dataOraInizio) {
                    $q->whereRaw('? >= (CAST(data_iniziale AS DATETIME) + CAST(ora_iniziale AS DATETIME))', [$dataOraInizio])
                    ->whereRaw('? < (CAST(data_finale AS DATETIME) + CAST(ora_finale AS DATETIME))', [$dataOraInizio]);
                })->orWhere(function ($q) use ($dataOraFine) {
                    $q->whereRaw('? > (CAST(data_iniziale AS DATETIME) + CAST(ora_iniziale AS DATETIME))', [$dataOraFine])
                    ->whereRaw('? <= (CAST(data_finale AS DATETIME) + CAST(ora_finale AS DATETIME))', [$dataOraFine]);
                });
            })
            ->get();


            // Se ha trovato una riga con accavallemento di date, restituisce errore
            if($previousRule->isNotEmpty()) {
                return redirect()->back()->with('found', 'Hours interval found');
            } else {
                // Se non ha trovato righe con accavallamento di date e orari, inserisce la regola
                $rule = new Rules();

                $rule->servizio = $servizio;
                $rule->data_iniziale = $request->input('startDate');
                $rule->data_finale = $request->input('endDate');
                $rule->flag = $flag;
                $rule->ora_iniziale = $ora_iniziale;
                $rule->ora_finale = $ora_finale;
                $rule->coda_uno = $coda_uno;
                $rule->partizione_uno = $partizione_uno;
                $rule->coda_due = $coda_due;
                $rule->partizione_due = $partizione_due;
                $rule->coda_tre = $coda_tre;
                $rule->partizione_tre = $partizione_tre;
                $rule->save();
                return redirect()->back()->with('succes', 'Rule created');
            }
            // return redirect()->back()->with('notImplementedYet', 'Feature not implemented yet');
        }
    }

    
    public function edit(string $id){
        //
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