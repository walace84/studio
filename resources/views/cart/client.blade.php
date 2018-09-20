@extends('layouts.app')

@section('content')

<div class="row">



    <div class="col-md-12"> 
    <form action="{{route('busca')}}" method="POST">
    {{ csrf_field() }}
    <div class="input-field">
        <input id="search" type="search" name="name" autofocus placeholder="search">
        <label class="label-icon" for="search"></label>

    </div>
    </form>

     <!-- SE NAÕ EXISTIR RESULTADOS NO CAMPO DE PESQUISA MOSTRE ESSE FORM -->
    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th class="hide-on-small-only">E-mail</th>
                <th>Add</th>
            </tr>
        </thead>
        @foreach($client as $user)
        <tbody>
            <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td class="hide-on-small-only">{{$user->email}}</td>
            <td>
                <a href="{{route('UserSession', $user->id)}}"><i class="Tiny material-icons">add</i></a> 
            </td>
            </tr>
        </tbody>
        @endforeach
    </table>

</div>

</div> 

@endsection