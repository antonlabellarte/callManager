<?php

namespace App\Http\Controllers;

use App\Models\Campaigns;
use App\Models\Services;
use App\Models\CustomersList;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    public function index(){
        // $campaigns = CustomersList::paginate(10);
        $campaigns = Campaigns::all();

        return view('campaigns.index', compact('campaigns'));

        // return view('campaigns.index', compact('campaigns'));
    }

    public function create(){
        $queues = Services::orderBy('queue', 'asc')->get();

        return view('campaigns.add', compact('queues'));
    }

    
    public function store(Request $request){
        $campaign = new Campaigns();

        $campaign->testo = $request->input('testo');
        $campaign->coda = $request->input('coda');
        $campaign->toQueue = $request->input('toQueue');
        $campaign->forzaCoda = $request->input('forzaCoda');
        $campaign->abbattimento = $request->boolean('abbattimento');
        $campaign->nomeCampagna = $request->input('nomeCampagna');
        $campaign->dataInizio = $request->input('dataInizio');
        $campaign->dataFine = $request->input('dataFine');
        $campaign->allCustomer = $request->boolean('allCustomer');
        $campaign->enabled = $request->boolean('enabled');

        
        $existentCampaign = Campaign::where('message', $messagge)
            ->where('coda', $request->input('coda'))
            ->where('abbattimento', $request->boolean('abbattimento'))
            ->where('nomeCampagna', $request->input('nomeCampagna'))
            ->where('dataInizio', $request->input('dataInizio'))
            ->where('dataFine', $request->input('dataFine'))
            ->where('allCustomer', $request->boolean('allCustomer'))
            ->where('enabled', $request->boolean('enabled'))
            ->where('toQueue', $request->input('toQueue'))
            ->get();

        if ( $existentCampaing->isNotEmpty() ) {
            return redirect()->back()->with('warning', 'Campagna uguale trovata');    
        } else {
            $campaigns = Campaign::where(function ($query) use ($queue, $dateStart, $dateEnd) {
                    $query->where(function ($q) use ($queue, $dateStart, $dateEnd) {
                        $q->where(function ($subQ) use ($queue) {
                            $subQ->where('queue', $queue)
                                ->orWhere('queue', '0');
                        })
                        ->where(function ($subQ) use ($dateStart, $dateEnd) {
                            $start = $dateStart ?? '2000-01-01 00:00:00';
                            $end = $dateEnd ?? '2100-01-01 00:00:00';
                            
                            $subQ->where(function ($q2) use ($start, $end) {
                                $q2->where('dateStart', '<=', $end)
                                ->where('dateEnd', '>=', $start);
                            })
                            ->orWhere(function ($q2) {
                                $q2->whereNull('dateStart')
                                ->whereNull('dateEnd');
                            });
                        })
                        ->where('allCustomers', 1)
                        ->where('enabled', 1);
                    });
                })
                ->orWhere('name', $campaignName)
                ->get();
        }

        $campaign->save();
        return redirect()->route('campaigns.index')->with('success', 'Coda inserita');
    }

    
    public function edit(string $id){
        $rule = Campaigns::find($id);

        $queues = Services::all();

        return view('campaigns.edit', compact('rule', 'queues'));
    }

    
    public function update(Request $request, string $id){
        //
    }

    
    public function destroy(string $id){
        $campaignrule = Campaigns::find($id);
        $campaignrule->delete();
        
        return back()->with('erased', 'Campaign rule deleted');
    }

    public function details(string $id)
    {
        $rule = Campaigns::find($id);

        // Recupera tutte le liste collegate a questa regola
        $listsPerRule = CustomersList::where('regoleid', $id)->get();

        // Passa sia la regola che le liste alla view
        return view('campaigns.details', compact('rule', 'listsPerRule'));
}

}
