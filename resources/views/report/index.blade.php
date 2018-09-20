@extends('layouts.app')

@section('content')

<a href="{{route('home')}}" class="btn blue">Voltar</a>
<a href="{{route('monthly')}}" class="waves-effect waves-light btn">Mensal</a>
<a class="btn blue"> {{ date('d/m/Y') }} </a>

    <div class="col-md-12"> 
        <form action="{{route('daily')}}" method="POST">
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

   @if(isset($daily))
   <table>
    
    <thead>
        <tr>
            <th class="hide-on-small-only">Cód</th>
            <th >Quantidade</th>
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
        <tr>
        <td class="hide-on-small-only">{{$daily->product_id}}</td>
        <td>{{$daily->qtd}}</td>
        <td>{{$daily->product}}</td>
        <td class="hide-on-small-only">{{$daily->price}}</td>
        <td>{{$daily->total}}</td>
        </tr>  
    @php
        $total_produto = $daily->total;
        $total_pedido += $total_produto;
    @endphp
    </tbody>
    </table>
    <p class="btn red" style="float:right"> <span>R$ {{ number_format($total_pedido, 2, ',', '.') }}</span></p>	 
   @else

    <div class="card-panel teal lighten-2">
         <p class="white-text center">AINDA NÃO TEMOS VENDA.</p>
    </div>

   @endif

@endsection



