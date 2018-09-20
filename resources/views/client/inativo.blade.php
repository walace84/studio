@extends('layouts.app')

@section('content')

<div class="row">
    <a class="btn blue" href="{{url('/home')}}">Voltar</a> 

     <!-- SE NAÕ EXISTIR RESULTADOS NO CAMPO DE PESQUISA MOSTRE ESSE FORM -->
     @if(count($inativo))
    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th class="hide-on-small-only">E-mail</th>
                <th>Data</th>
                <th>Servico</th>
            </tr>
        </thead>
        @foreach($inativo as $user)
        <tbody>
            <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td class="hide-on-small-only">{{$user->email}}</td>
            <td>{{ Carbon\Carbon::parse($user->updated_at)->format('d/m/Y') }}</td>
            <td><a href="{{route('client.show', $user->id)}}"><i class="Tiny material-icons">account_circle</i></a></td>
            </tr>
        </tbody>
        @endforeach
    </table>
    @else
    <div class="card-panel teal lighten-2">
        <p class="white-text center">NÃO TEMOS CLIENTES INATIVOS.</p>
    </div>
    @endif

</div>
{!! $inativo->render() !!}
</div> 

@endsection