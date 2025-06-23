<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;

class ServicesController extends Controller
{
    // Visualizza tutte le code
    public function index(){
        $services = Services::all();

        return view('services.index', compact('services'));
    }

    // Pagina di creazione coda
    public function create(){
        return view('services.add');
    }
    
    // Inserimento coda
    public function store(Request $request){
        $service = new Services();
        
        $service->name = $request->input('service');
        $service->queue = $request->input('queue');
        $service->typology = $request->input('type');
        $service->skillGroup = $request->input('skillGroup');

        // Salvataggio
        $service->save();

        //return redirect()->route('orders.create')->with('success', 'Part update successfully');
        return redirect()->route('services.index')->with('success', 'Coda inserita');
    }

    // Pagina di modifica coda
    public function edit(string $id) {
        $service = Services::find($id);
        return view('services.edit', compact('queue'));
    }

    // Aggiornamento coda
    public function update(Request $request, string $id){
        $service = Services::find($id);
                
        $service->name = $request->input('service');
        $service->queue = $request->input('queue');
        $service->typology = $request->input('type');
        $service->skillGroup = $request->input('skillGroup');
        
        $service->update($request->all());

        return back()->with('updated', 'aggiornato');
    }



    // Eliminazione coda
    public function destroy(string $id){
        $service = Services::find($id);
        $service->delete();
        
        return redirect()->route('services.index')->with('serviceDeleted', 'Ordine eliminato');
    }
}
