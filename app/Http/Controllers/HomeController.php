<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Client;
use App\Model\Shedule;
use App\Model\Shedule2;
use Session;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Recuperar e deleta a sessão
        session()->pull('client');

        $client  = count(Client::all());
        $inativo = count(Client::inativos());
        $agenda  = count(Shedule::Sheduleday());
        $agenda2  = count(Shedule2::Sheduleday2());
        $birthday = count(client::birthday());
        return view('home.index', compact('client', 'inativo', 'agenda', 'agenda2', 'birthday'));
    }

    // cria uma sessão de cliente
    public function addSession($id)
    {
        $user = Client::find($id);
        Session::put('client', $user);
        return redirect()->route('cart');
    }

    public function desconect()
    {
        // Recuperar e deleta a sessão
        session()->pull('client');
        return redirect()->route('cart');
    }


    // clientes inativo
    public function inativo()
    {
        $inativo = Client::inativosPage(10);
        return view('client.inativo', compact('inativo'));
    }

    // aniversário
    public function birthday()
    {
        $birthday = client::birthday();
        return view('client.birthday', compact('birthday'));
    }

}
