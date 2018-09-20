<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Shedule;
use Illuminate\Support\Facades\Input;
use DB;

class ShedulesController extends Controller
{
    // lista os clientes para add na sessão da agenda
    public function list()
    {
        $client = Client::all();
        return view('shedule.client',compact('client'));
    }

    // lista os agendados do dia
    public function index()
    {
        $data = Shedule::Sheduleday();
      
        return view('shedule.index', compact('data'));
    }

    // lista os clientes
    public function show($id)
    {
        $data = Client::find($id);
       
        return view('shedule.form', compact('data'));
    }

    // mostra os dados a ser editados
    public function edit($id)
    {
        $data = Shedule::find($id);
        
        return view('shedule.edit', compact('data'));
    }

    // agenda um cliente
    public function store(Request $request)
    {
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime( $data['date']));
        if($data['date'] < date('Y-m-d')){
            return redirect()->back()->with('errors', 'ESSA DATA JÁ PASSOU.');
        }
       
        $create = Shedule::create($data);
        if($create != ''){
            return redirect()->route('home')->with('message', 'CLIENTE AGENDADO COM SUCESSO.');
        }
        return redirect()->route('home')->with('errors', 'ERRO AO TENTAR AGENDAR CLIENTE.');
    }

    // atualiza os dados
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime( $data['date']));

        if($data['date'] < date('Y-m-d')){
            return redirect()->back()->with('errors', 'ESSA DATA JÁ PASSOU.');
        }
        
        $cliente = Shedule::find($id);
       
        $update = $cliente->update($data);

        if($update){
            return redirect()->route('home')->with('message', 'AGENDAMENTO ATUALIZADO COM SUCESSO!');
        }
        return redirect()->route('home')->with('errors', 'ERRO AO TENTAR REAGENDAR O CLIENTE.');
        
    }


    public function delete($id)
    {
        $agenda = Shedule::find($id);

        $delete = $agenda->delete();

        if($delete){
            return redirect()->route('home')->with('message', 'O AGENDAMENTO FOI CANCELADO COM SUCESSO!'); 
        }
        return redirect()->back()->with('error', ' ERRO AO DELETAR AGENDA!');
    }


    // barra de pesquisa
    public function search()
    {
        $date = Input::get('data');
       
        if($date != ''){
            $data = Shedule::sheduleSelect($date);
           
            if(count($data) > 0){
                return view('shedule.index' ,compact('data', 'date'));
            }else{
                $data = Shedule::sheduleSelect($date);
                return view('shedule.index' ,compact('data', 'date'));
            }
        }else{
            $data = Shedule::Sheduleday();
            return view('shedule.index', compact('data'));
        }
    }

    // barra de pesquisa
    public function searchClient()
    {
        $search = Input::get('name');
        
        if($search != ''){
            $client = Client::where('name', 'LIKE', "%$search%")->paginate(10);
            if(count($client) > 0){
                return view('shedule.client', compact('client'));
            }else{
                $client = Client::paginate(10);
                return view('shedule.client', compact('client'));
            }
        }else{
            $client = Client::paginate(10);
            return view('shedule.client', compact('client'));
        }
    }

}
