<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Queues;

class QueuesController extends Controller
{
    // Visualizza tutte le code
    public function index(){
        $queues = Queues::all();

        return view('queues.index', compact('queues'));
    }

    // Pagina di creazione coda
    public function create(){
        return view('queues.add');
    }
    
    // Inserimento coda
    public function store(Request $request){
        $queue = new Queues();
        
        $queue->servizio = $request->input('service');
        $queue->coda = $request->input('queue');
        $queue->tipologia = $request->input('type');

        // Salvataggio
        $queue->save();

        //return redirect()->route('orders.create')->with('success', 'Part update successfully');
        return back()->with('success', 'Part update successfully');
    }

    // Pagina di modifica coda
    public function edit(string $servizio) {
        $queue = Queues::where('servizio', $servizio)->firstOrFail();
        return view('queues.edit', compact('queue'));
    }

    // Aggiornamento coda
    public function update(Request $request, string $servizio){
    $queue = Queues::where('servizio', $servizio)->firstOrFail();

    // Salva il valore prima della modifica
    $originalServizio = $queue->servizio;

    $queue->servizio = $request->input('service');
    $queue->coda = $request->input('queue');
    $queue->tipologia = $request->input('type');
    $queue->specializzazione = $request->input('skillGroup');

    $queue->save();

    return redirect()
        ->route('queues.edit', $queue->servizio) // ora che è aggiornato
        ->with('queueUpdated', 'Coda modificata e aggiornata');
}



    // Eliminazione coda
    public function destroy(string $id){
        $queue = Queues::find($id);
        $queue->delete();
        
        return redirect()->route('orders.index')->with('queueDeleted', 'Ordine eliminato');
    }
}
