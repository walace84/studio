@extends('layouts.app')

@section('content')

    <div class="row">

    <div class="col s12 m12 l12 center"> 
        <div class="card-panel red lighten-2 white-text">
        <h6>Dados do Cliente</h6>
        </div>
    </div>





    <div class="col s12 m12 l12"> 
    <h6>Nome: <span class="red-text">{{$client->name}}</span> - Data Nascimento:  <span class="red-text">{{ Carbon\Carbon::parse($client->data)->format('d/m/Y') }}</span></h6> 
    <h6>E-mail: <span class="red-text">{{$client->email}}</span> - Telefone:  <span class="red-text">{{$client->phone}}</span></h6>
    <h6>Empresa:  <span class="red-text">{{$client->company}}</span></h6>
    <h6>Cidade:  <span class="red-text">{{$client->city}}</span> - Bairro:  <span class="red-text">{{$client->bairro}}</span></h6>
    <h6>Créditos: <span class="red-text">R${{ number_format($client->credits, 2, ',', '.') }} </span></h6>
    <h6>Fidelidade:
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
    </h6>

    <h6>Serviços:</h6>
    <ul>
        @foreach($services as $service) 
        <li><h6>Tipo: <span class="red-text">{{$service->prodname}}</span> - data: {{ Carbon\Carbon::parse($service->created_at)->format('d/m/Y') }}</li> 
        @endforeach
    </ul>
    {{$services->links()}}

    </div>





    <div class="col s12 m12 l12"> 
        <a class="btn blue" href="{{url('admin/client')}}">Voltar</a>
    </div>

    </div> 


@endsection                    

        