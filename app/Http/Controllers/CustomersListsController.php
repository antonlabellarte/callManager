<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomersList;
use App\Imports\ContrattiImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomersListsController extends Controller
{

    public function index(){
        //
    }

    
    public function store(Request $request){
        //
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new ContrattiImport, $request->file('file'));

        return redirect()->back()->with('success', 'Importazione completata!');
    }


    public function edit(string $id){
        //
    }

    
    public function update(Request $request, string $id){
        //
    }

    
    public function destroy(string $id){
        // $campaignlist = CustomersList::find($id);
        // $campaignlist->delete();
        
        // return back()->with('erased', 'Campaign list deleted');
    }
}
