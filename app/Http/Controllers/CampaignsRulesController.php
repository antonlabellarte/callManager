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
        //
    }

    
    public function update(Request $request, string $id){
        //
    }

    
    public function destroy(string $id){
        //
    }
}
