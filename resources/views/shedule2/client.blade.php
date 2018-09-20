@extends('layouts.app')

@section('content')

<div class="row">
    <a class="btn blue" href="{{url('/sheduletwo')}}">Voltar</a> 
   

    <div class="col-md-12"> 
    <form action="{{route('searchclient')}}" method="POST">
    {{ csrf_field() }}
    <div class="input-field">
        <input id="search" type="search" name="name" autofocus placeholder="search">
        <label class="label-icon" for="search"></label>

    </div>
    </form>

    @if(count($client) > 0)
     <!-- SE NAÕ EXISTIR RESULTADOS NO CAMPO DE PESQUISA MOSTRE ESSE FORM -->
    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="hide-on-small-only">Telefone</th>
                <th class="hide-on-small-only">E-mail</th>
                <th>Agendar</th>
            </tr>
        </thead>
        @foreach($client as $user)
        <tbody>
            <tr>
            <td>{{$user->name}}</td>
            <td class="hide-on-small-only">{{$user->phone}}</td>
            <td class="hide-on-small-only">{{$user->email}}</td>

            <td>
                <!--agenda-->
                <a href="{{route('show2', $user->id)}}"><i class="Tiny material-icons">date_range</i></a> 
            </td>
           
            </tr>
        </tbody>
        @endforeach
    </table>
    @else
        <div class="card-panel teal lighten-1 white-text center">
            <h6>AINDA NÃO TEMOS CLIENTES CADASTRADOS</h6>
        </div>
    @endif

</div>

</div> 

@endsection