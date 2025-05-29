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

    
    public function edit(string $id){
        $queue = Queues::find($id);

        return view('queues.edit', compact('queue'));
    }

    
    public function update(Request $request, string $id){
        $queue = Queues::find($id);
        
        $queue->servizio = $request->input('service');
        $queue->coda = $request->input('queue');
        $queue->tipologia = $request->input('type');

        $queue->update($request->all());
        
        return redirect()->route('queues.edit', $queue->id)->with('queueUpdated', 'Coda modificata e aggiornata');
        return back()->with('queueUpdated', 'Coda modificata e aggiornata');
    }

    
    public function destroy(string $id){
        $queue = Queues::find($id);
        $queue->delete();
        
        return redirect()->route('orders.index')->with('queueDeleted', 'Ordine eliminato');
    }
}
