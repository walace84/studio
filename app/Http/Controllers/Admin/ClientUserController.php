<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Order;
use App\User;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Input;
use DB;

class ClientUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::ClientList(5);
       
        return view('client.index',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $data = $request->all();

        $data['name'] = ucwords(strtolower($data['name'])); 

        // formata a moeda
        $valueFormt = str_replace(',','.',str_replace('.','',$data['credits'])); 

        $data['credits'] = $valueFormt;

        $create = Client::create($data);

        if($create){
            return redirect()->route('home')->with('message', 'CLIENTE CADASTRADO COM SUCESSO!');
        }
        return redirect()->back()->with('error', 'ERRO AO CADASTRAR CLIENTE!')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = client::find($id);  

        $services = DB::table('reports')->select('prodname', 'created_at')->where('client_id', '=', $client->id)->orderBy('id', 'desc')->paginate(5);
        // pegar os pontos do cliente
        $pontos = DB::table('order_prods')->select('points')->where('client_id', '=', $client->id)->get();

        $qtd = $pontos->sum('points');
        
        return view('client.show', compact('client', 'qtd', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client =  Client::find($id);
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $data['name'] = ucwords(strtolower($data['name'])); 

        $cliente = Client::find($id);

        // formata a moeda
        $valueFormt = str_replace(',','.',str_replace('.','',$data['credits'])); 

        $data['credits'] = $valueFormt;

        $update = $cliente->update($data);

        if($update){
            return redirect()->route('home')->with('message', 'DADOS ATUALIZADOS COM SUCESSO!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    // barra de pesquisa
    public function search()
    {
        $search = Input::get('name');
       
        if($search != ''){
            $client = Client::where('name', 'LIKE', "%$search%")->orderByRaw('name', '=', 'ASC')->paginate(5);
            if(count($client) > 0){
                return view('client.index' ,compact('client'));
            }else{
                $client = Client::ClientList(5);
                return view('client.index' ,compact('client'));
            }
        }else{
            $client = Client::ClientList(5);
            return view('client.index', compact('client'));
        }
    }

}
