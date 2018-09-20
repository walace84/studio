@extends('layouts.app')

@section('content')

<div class="row">
    <a class="btn blue" href="{{url('/home')}}">Voltar</a> 
    <a class="btn" href="{{route('client.create')}}"><i class="medium material-icons">add_circle</i></a> 
    

    <div class="col-md-12"> 
    <form action="{{route('search')}}" method="POST">
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
                <th>editar</th>
                <th>visualizar</th>
            </tr>
        </thead>
        @foreach($client as $user)
        <tbody>
            <tr>
            <td>{{$user->name}}</td>
            <td class="hide-on-small-only">{{$user->phone}}</td>
            <td class="hide-on-small-only">{{$user->email}}</td>
            <td>
                <a href="{{route('client.edit', $user->id)}}"><i class="Tiny material-icons">edit</i></a> 
            </td>
            <td>
                <a href="{{route('client.show', $user->id)}}"><i class="Tiny material-icons">account_circle</i></a> 
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