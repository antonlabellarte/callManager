<?php

namespace App\Http\Controllers;

use App\Models\Campaigns;
use App\Models\Services;
use App\Models\CustomersList;
use Illuminate\Http\Request;
use App\Imports\ContrattiImport;
use Maatwebsite\Excel\Facades\Excel;

class CampaignsController extends Controller
{
    public function index(){
        // $campaigns = CustomersList::paginate(10);
        $campaigns = Campaigns::all();

        return view('campaigns.index', compact('campaigns'));

        // return view('campaigns.index', compact('campaigns'));
    }

    public function filter(Request $request){
        $campaignsName = $request->input('name');
        $campaignsQueue = $request->input('queue');
        $campaignsMessage = str_replace("'", "`", $request->input('message'));

        $campaignsDateStart = $request->input('dateStart') . " " . $request->input('startTime');
        $campaignsDateEnd = $request->input('dateEnd') . " " . $request->input('endTime');

        $campaignsAllCustomer = $request->has('allCustomers') ? 1 : 0;
        $campaignsDropCall = $request->has('dropCall') ? 1 : 0;
        $campaignsEnabled = $request->has('enabled') ? 1 : 0;

        // Query particolare per far sì che accetti valori vuoti
        $query = Campaigns::query();

        if (!empty($campaignsName)) {
            $query->where('name', 'like', $campaignsName . '%');
        }

        if (!empty($campaignsQueue)) {
            $query->where('queue', 'like', $campaignsQueue . '%');
        }

        if (!empty($campaignsMessage)) {
            $query->where('message', 'like', '%' . $campaignsMessage . '%');
        }


        // Date time
        if (!empty($campaignsDateStart)) {
            $query->where('dateStart', $campaignsDateStart);
        }

        if (!empty($campaignsDateEnd)) {
            $query->where('dateEnd', $campaignsDateEnd);
        }

        $query->where('allCustomers', '=', $campaignsAllCustomer);
        $query->where('dropCall', '=', $campaignsDropCall);
        $query->where('enabled', '=', $campaignsEnabled);


        $campaigns = $query->get();

        return view('campaigns.index', compact('campaigns'));



    }

    public function create(){
        $queues = Services::orderBy('queue', 'asc')->get();

        return view('campaigns.add', compact('queues'));
    }

    
    public function store(Request $request){
        $campaign = new Campaigns();

        $campaign->message = str_replace("'", "`", $request->input('testo'));
        $campaign->queue = $request->input('queue');
        $campaign->toQueue = $request->input('forzaCoda');
        $campaign->dropCall = $request->boolean('abbattimento');
        $campaign->name = $request->input('nomeCampagna');
        $campaign->dateStart = $request->input('dataInizio') . " " . $request->input('startTime') . ":00"; $dataInizio = $request->input('dataInizio') . " " . $request->input('startTime') . ":00";
        $campaign->dateEnd = $request->input('dataFine') . " " . $request->input('endTime') . ":00"; $dataFine = $request->input('dataFine') . " " . $request->input('endTime') . ":00";
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
            return redirect()->back()->with('warning', 'Non puoi inserire una campagna uguale');    
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
                return redirect()->back()->with('overlap', $overlap)->with('overlapFound', 'ATTENZIONE! Esistono le seguenti campagne in conflitto con la modifica/inserimento corrente. Verificare.');

            } else {
                // salva
                $campaign->save();
                return redirect()->route('campaigns.index')->with('success', 'Coda inserita');
            }
        }

    }

    
    public function edit(string $id){
        $campaigns = Campaigns::find($id);

        $queues = Services::all();
        

        return view('campaigns.edit', compact('campaigns', 'queues'));
    }

    
    public function update(Request $request, string $id){
        $campaign = Campaigns::find($id);

        $campaign->message = str_replace("'", "`", $request->input('testo')); $messaggio = str_replace("'", "`", $request->input('testo'));
        $campaign->queue = $request->input('coda'); $coda = $request->input('coda');
        $campaign->toQueue = $request->input('toQueue'); $forzaCoda = $request->input('toQueue');
        $campaign->dropCall = $request->boolean('abbattimento'); $dropCall = $request->boolean('abbattimento');
        $campaign->name = $request->input('nomeCampagna'); $nomeCampagna = $request->input('nomeCampagna');
        $campaign->dateStart = $request->input('dataInizio') . " " . $request->input('startTime') . ":00"; $dataInizio = $request->input('dataInizio') . " " . $request->input('startTime') . ":00";
        $campaign->dateEnd = $request->input('dataFine') . " " . $request->input('endTime') . ":00"; $dataFine = $request->input('dataFine') . " " . $request->input('endTime') . ":00";
        $campaign->allCustomers = $request->boolean('allCustomer'); $allCustomers = $request->boolean('allCustomer');
        $campaign->enabled = $request->boolean('enabled'); $enabled = $request->boolean('enabled');

        $overlap = Campaigns::where(function ($query) use ($coda, $dataInizio, $dataFine) {
                $query->where(function ($q) use ($coda, $dataInizio, $dataFine) {
                    $q->where(function ($q2) use ($coda) {
                        $q2->where('queue', $coda)
                        ->orWhere('queue', '0')
                        ->orWhereRaw('? <> ""', [$coda]); // check if $queue is non-empty
                    });

                    $dataInizio = $dataInizio ?: '2100-01-01 00:00:00';
                    $dataFine   = $dataFine ?: '2000-01-01 00:00:00';

                    $q->where(function ($q3) use ($dataInizio, $dataFine) {
                        $q3->where('dateStart', '<=', $dataInizio)
                        ->where('dateEnd', '>=', $dataFine);
                    })->orWhere(function ($q4) {
                        $q4->whereNull('dateStart')
                        ->whereNull('dateEnd');
                    });

                    $q->where('allCustomers', 1)
                    ->where('enabled', 1);
                });
            })
            ->orWhere(function ($query) use ($nomeCampagna, $id) {
                $query->where('name', $nomeCampagna)
                    ->where('campaignID', '<>', $id);
            })
            ->whereRaw('? = 1', [$enabled])
            ->get();

        if ( $overlap->isNotEmpty() ) {
            return redirect()->back()->with('overlap', $overlap)->with('overlapFound', 'ATTENZIONE! Esistono le seguenti campagne in conflitto con la modifica/inserimento corrente. Verificare.');
        } else {
            
            // Se allCustomers viene impostato su 1 elimina tutte le liste
            if ( $allCustomers == 1 ) {
                $listToDeleteIfAllCustomers = CustomersList::where('campaignID', $id);
                $listToDeleteIfAllCustomers->delete();
            }

            $campaign->save();
            return redirect()->route('campaigns.index')->with('successUpdate', 'Coda aggiornata');

        }
    }

    
    public function destroy(string $id){
        $campaignrule = Campaigns::find($id);
        $campaignrule->delete();
        
        return back()->with('erased', 'Campaign rule deleted');
    }

    public function details(string $id)
    {
        $campaign = Campaigns::find($id);

        // Recupera tutte le liste collegate a questa regola
        $listsPerCampaign = CustomersList::where('campaignID', $id)->get();

        // Passa sia la regola che le liste alla view
        return view('campaigns.detail', compact('campaign', 'listsPerCampaign'));
    }

    public function searchCustomersList(Request $request, string $id) {
        $campaign = Campaigns::find($id);

        $customerID = $request->input('customerID');
        
        // Recupera tutte le liste collegate a questa regola
        $listsPerCampaign = CustomersList::where('campaignID', $id)
            ->where('customerID', 'like', $customerID . '%')
            ->get();


        // Passa sia la regola che le liste alla view
        return view('campaigns.detail', compact('campaign', 'listsPerCampaign'))->with('search', 'Campaign red');
    }

    public function deleteAllListsPerCampaign(string $id) {
        $campaignList = CustomersList::where('campaignID', $id);
        $campaignList->delete();
        
        return back()->with('erased', 'Campaign rule deleted');
    }

    public function importListPage(string $id) {        
        $campaigns = Campaigns::find($id);
        return view('campaigns.import', compact('campaigns'));
    }
}
