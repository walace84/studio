@extends('layouts.app')

@section('content')

<div class="row">
    <!-- RETURNO DAS MESSAGENS -->
    @if( session('message') )
    <div class="card-panel teal lighten-1">
        <span class="white-text center">{{session('message')}}</span>
    </div>
    @endif

    <a class="blue btn" href="{{route('desconect')}}">Voltar</a>

    <table class="highlight">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Pontos</th>
                <th>Deletar</th>
            </tr>
        </thead>

        <tbody>
            <tr>
            <td>{{$users->name}}</td>
            <td>{{$users->phone}}</td>
            <td>
            @switch($qtd)
                @case(1 <= 10)
                       {{$qtd}}
                    @break
                @case(2 <= 20)
                       {{$qtd}}
                    @break
                @case(3 <= 30)
                       {{$qtd}}
                @break
                @default
                    <i class="small material-icons">mood_bad</i> 
            @endswitch
            </td>
            <td>
                <a href="{{route('delete')}}"><i class="Tiny material-icons">delete</i></a> 
            </td>
            </tr>
        </tbody>
    </table>

   @if($qtd == 30)
    <div class="card-panel teal lighten-2">
         <h5 class="white-text center">Você é de mais ganhou seu terceiro brinde! <a class="btn-floating pulse red"><i class="material-icons">insert_emoticon</i></a> </h5> 
    </div>
   @elseif($qtd == 20) 
   <div class="card-panel teal lighten-2">
        <h5 class="white-text center">Você ganhou seu segundo brinde! <a class="btn-floating pulse red"><i class="material-icons">insert_emoticon</i></a> </h5> 
    </div>
   @elseif($qtd == 10) 
   <div class="card-panel teal lighten-2">
        <h5 class="white-text center">Você ganhou seu primeiro brinde! <a class="btn-floating pulse red"><i class="material-icons">insert_emoticon</i></a> </h5> 
    </div>
   @endif

</div>

</div> 

@endsection