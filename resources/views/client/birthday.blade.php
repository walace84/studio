@extends('layouts.app')

@section('content')

<div class="row">
    <a class="btn blue" href="{{url('/home')}}">Voltar</a> 
    <a class="btn blue"> {{ date('d/m/Y') }} </a>
   

    @if(count($birthday) > 0)
    <div class="card">
    <h6 class="red-text">Aniversariantes do dia</h6>
    </div>
     <!-- SE NAÕ EXISTIR RESULTADOS NO CAMPO DE PESQUISA MOSTRE ESSE FORM -->
    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th class="hide-on-small-only">E-mail</th>
                <th>Data</th>
            </tr>
        </thead>
        @foreach($birthday as $user)
        <tbody>
            <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td class="hide-on-small-only">{{$user->email}}</td>
            <td>{{ Carbon\Carbon::parse($user->data)->format('d/m/Y') }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
    @else
    <div class="card-panel teal lighten-2">
        <p class="white-text center">HOJE NÃO TEMOS ANIVERSARIANTES.</p>
    </div>
    @endif

</div>

</div> 

@endsection