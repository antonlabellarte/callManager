<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\CustomersList;
use Illuminate\Http\Request;
use App\Imports\ContrattiImport;

class CustomersListController extends Controller
{

    public function index(){
        // $campaigns = CustomersList::paginate(10);

        // return view('campaigns.index', compact('campaigns'));
    }

    
    public function store(Request $request){
        //
    }
    
    public function import(Request $request){
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls',
        ]);

        // Usa un'istanza per poter accedere ai contatori dopo l'import
        $import = new ContrattiImport();
        Excel::import($import, $request->file('file_excel'));

        // Recupera i conteggi
        $importati = $import->countCorretti;
        $duplicati = $import->countDuplicati;

        return back()->with('success', "Importazione completata. 
            Righe importate: $importati, 
            Duplicati: $duplicati");
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
