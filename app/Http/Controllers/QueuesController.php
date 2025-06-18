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
        $queue->skillGroup = $request->input('skillGroup');

        // Salvataggio
        $queue->save();

        //return redirect()->route('orders.create')->with('success', 'Part update successfully');
        return redirect()->route('queues.index')->with('success', 'Coda inserita');
    }

    // Pagina di modifica coda
    public function edit(string $id) {
        $queue = Queues::find($id);
        return view('queues.edit', compact('queue'));
    }

    // Aggiornamento coda
    public function update(Request $request, string $id){
        $queue = Queues::find($id);
                
        $queue->servizio = $request->input('service');
        $queue->coda = $request->input('queue');
        $queue->tipologia = $request->input('type');
        $queue->skillGroup = $request->input('skillGroup');
        
        $queue->update($request->all());

        return back()->with('updated', 'aggiornato');
    }



    // Eliminazione coda
    public function destroy(string $id){
        $queue = Queues::find($id);
        $queue->delete();
        
        return redirect()->route('queues.index')->with('queueDeleted', 'Ordine eliminato');
    }
}
