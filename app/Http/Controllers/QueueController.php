<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Queues;

class QueueController extends Controller
{
    // Visualizza tutte le code
    public function index(){
        $queues = Queues::all();

        return view('queues.index', compact('queues'));
    }

    // Pagina di creazione coda
    public function create(){
        return view('queues.add');
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
