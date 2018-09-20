@extends('layouts.app')

@section('content')

    <a href="{{route('report')}}" class="btn blue">Voltar</a>
    <a class="btn blue">{{ date('d/m/y') }} </a>



    <div class="col-md-12"> 
    <form action="{{route('month')}}" method="POST">
        {{ csrf_field() }}
        <div class="input-field col s10 m10">
        <input type="text" class="datepicker" name="data" required autofocus>
        </div>
        <button class="btn waves-effect waves-light" type="submit">Buscar</button>
        @if(isset($date))
        <a class="btn blue"> {{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</a>
        @endif
    </form>
    </div>

    <div class="row">

    @if( session('message') )
    <div class="card-panel teal lighten-2">
        <p class="white-text center">{{session('message')}}</p>
    </div>
    @endif
   
    @if(isset($report))

  
    <table>
    <!-- caso a consulta não tenha resultados -->
    @if(count($report) > 0)
    <thead>
        <tr>
            <th>Cód</th>
            <th>Quantidade</th>
            <th>Produto</th>
            <th class="hide-on-small-only">Valor Unit.</th>
            <th>Total</th>
        </tr>
    </thead>
   
    <tbody>

    <!-- INICIA O VALOR ZERADO -->
    @php
        $total_pedido = 0;
    @endphp
    @foreach($report as $reports)
        <tr>
        <td>{{$reports->product_id}}</td>
        <td>{{$reports->qtd}}</td>
        <td>{{$reports->product}}</td>
        <td class="hide-on-small-only">{{$reports->price}}</td>
        <td>{{$reports->total}}</td>
        </tr>  
    @php
        $total_produto = $reports->total;
        $total_pedido += $total_produto;
    @endphp
    @endforeach 
    </tbody>
    </table>
  
    <p class="btn red" style="float:right"> <span>R$ {{ number_format($total_pedido, 2, ',', '.') }}</span></p>	
    
    @else
        <div class="card-panel red">
            <p class="white-text center">NÃO EXISTE VENDA NESSE PERIODO.</p>
        </div>
    @endif
    <!-- fim do pesquisa sem resultados -->
    @else

    <div class="card-panel teal lighten-2">
        <p class="white-text center">FAÇA UMA BUSCA.</p>
    </div>

    @endif

@endsection