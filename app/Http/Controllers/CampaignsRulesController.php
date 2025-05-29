<?php

namespace App\Http\Controllers;

use App\Models\CampaignsRules;
use App\Models\CampaignLists;
use Illuminate\Http\Request;

class CampaignsRulesController extends Controller
{
    public function index(){
        // $campaigns = CampaignsLists::paginate(10);
        $campaignsRules = CampaignsRules::all();

        return view('campaignsrules.index', compact('campaignsRules'));

        // return view('campaigns.index', compact('campaigns'));
    }

    
    public function store(Request $request){
        $rule = new CampaignRules();
    }

    
    public function edit(string $id){
        $rule = CampaignRules::find($id);

        return view('campaignsrules.edit', compact('rule',));
    }

    
    public function update(Request $request, string $id){
        //
    }

    
    public function destroy(string $id){
        $campaignrule = CampaignsRules::find($id);
        $campaignrule->delete();
        
        return back()->with('erased', 'Campaign rule deleted');
    }

    public function details(string $id)
    {
        $rule = CampaignRules::find($id);

        // Recupera tutte le liste collegate a questa regola
        $listsPerRule = CampaignLists::where('regoleid', $id)->get();

        // Passa sia la regola che le liste alla view
        return view('campaignsrules.details', compact('rule', 'listsPerRule'));
}

}
