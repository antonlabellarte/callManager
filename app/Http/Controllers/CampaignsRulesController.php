<?php

namespace App\Http\Controllers;

use App\Models\CampaignsRules;
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
        //
    }

    
    public function edit(string $id){
        $rule = CampaignRules::find($id);

        return view('campaignsrules.edit', compact('order', 'customers', 'suppliers'));
    }

    
    public function update(Request $request, string $id){
        //
    }

    
    public function destroy(string $id){
        $campaignrule = CampaignsRules::find($id);
        $campaignrule->delete();
        
        return back()->with('erased', 'Campaign rule deleted');
    }
}
