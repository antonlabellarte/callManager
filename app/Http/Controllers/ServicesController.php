<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;
use App\Models\Rules;
use App\Models\Campaigns;

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
        $service->typology = $request->input('typology');
        $service->skillGroup = $request->input('skillGroup');
        
        // Query servizio esistente
        $existentService = Services::where('name', $request->input('service'))->get();

        // Query coda esistente
        $existentQueue = Services::where('queue', $request->input('queue'))->get();

        // Se non sono vuote
        if( $existentQueue->isNotEmpty() || $existentService->isNotEmpty()) {
            return redirect()->back()->with('warning', 'trovate');
        } else {
            // Salvataggio
            $service->save();
            
            //return redirect()->route('orders.create')->with('success', 'Part update successfully');
            return redirect()->route('services.index')->with('success', 'Coda inserita');
        }
        
    }

    // Pagina di modifica coda
    public function edit(string $id) {
        $service = Services::find($id);
        return view('services.edit', compact('service'));
    }

    // Aggiornamento coda
    public function update(Request $request, string $id){
        $service = Services::find($id);
                
        $service->name = $request->input('service');
        $service->queue = $request->input('queue');
        $service->typology = $request->input('typology');
        $service->skillGroup = $request->input('skillGroup');

        $existentRule = Rules::where('ServizioPartizionato', $request->input('service'))
            ->orWhere('Servizio1',  $request->input('service'))
            ->orWhere('Servizio2',  $request->input('service'))
            ->orWhere('Servizio3',  $request->input('service'))
            ->get();

        // Se non esistono regole
        if($existentRule->isNotEmpty()) {
            return back()->with('warning', '');    
            
            // Se esistono regole
        } else {
            $existentCampaign = Campaigns::where('name', $request->input('service'));

            if($existentCampaign->isNotEmpty()){

            }
        }
        
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
