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

        $campaign->message = $request->input('testo');
        $campaign->queue = $request->input('coda');
        $campaign->toQueue = $request->input('toQueue');
        $campaign->dropCall = $request->boolean('abbattimento');
        $campaign->name = $request->input('nomeCampagna');
        $campaign->dateStart = $request->input('dataInizio') . " " . $request->input('startHour') . ":" . $request->input('startMinute') . ":00";
        $campaign->dateEnd = $request->input('dataFine') . " " . $request->input('endHour') . ":" . $request->input('endMinute') . ":00";
        $campaign->allCustomers = $request->boolean('allCustomer');
        $campaign->enabled = $request->boolean('enabled');

        $existentCampaign = Campaigns::where('message', $request->input('messaggio'))
            ->where('queue', $request->input('coda'))
            ->where('dropCall', $request->boolean('abbattimento'))
            ->where('name', $request->input('nomeCampagna'))
            ->where('dateStart', $request->input('dataInizio'))
            ->where('dateEnd', $request->input('dataFine'))
            ->where('allCustomers', $request->boolean('allCustomer'))
            ->where('enabled', $request->boolean('enabled'))
            ->where('toQueue', $request->input('toQueue'))
            ->get();

        if ( $existentCampaign->isNotEmpty() ) {
            return redirect()->back()->with('warning', 'Campagna uguale trovata');    
        } else {
            $queue = $request->input('coda');
            $dateStart = $request->input('dataInizio') . " " . $request->input('startHour') . ":" . $request->input('startMinute') . ":00";
            $dateEnd = $request->input('dataFine') . " " . $request->input('endHour') . ":" . $request->input('endMinute') . ":00";
            $name = $request->input('nomeCampagna');

            $overlap = Campaigns::where(function ($q) use ($queue, $dateStart, $dateEnd) {
                    $q->where(function ($q2) use ($queue, $dateStart, $dateEnd) {
                        $q2->where(function ($q3) use ($queue) {
                            $q3->where('queue', $queue)
                            ->orWhere('queue', '0');
                        })
                        ->where(function ($q4) use ($dateStart, $dateEnd) {
                            $start = $dateStart ?: '2000-01-01 00:00:00';
                            $end = $dateEnd ?: '2100-01-01 00:00:00';

                            $q4->where(function ($q5) use ($start, $end) {
                                $q5->where('dateStart', '<=', $end)
                                ->where('dateEnd', '>=', $start);
                            })
                            ->orWhere(function ($q5) {
                                $q5->whereNull('dateStart')
                                ->whereNull('dateEnd');
                            });
                        })
                        ->where('allCustomers', 1)
                        ->where('enabled', 1);
                    });
                })
                ->orWhere('name', $name)
                ->get();

            if ( $overlap->IsNotEmpty() ) {
                // Non salva
                return redirect()->back()->with('overlap', $overlap)->with('overlapFound', 'Accavallamento trovato');

            } else {
                // salva
                $campaign->save();
                return redirect()->route('campaigns.index')->with('success', 'Coda inserita');
            }
        }

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
