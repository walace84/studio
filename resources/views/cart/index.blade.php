@extends('layouts.app')

@section('content')

<div class="row">
<a class="btn blue" href="{{route('home')}}">voltar</a>
<a class="btn  waves-effect waves-light btn" href="{{route('list')}}">Cliente</a>
<a class="btn  waves-effect waves-light btn" href="{{route('listprod')}}">Produtos</a>
<a class="btn " href="{{route('desconect')}}">Novo Pedido</a>
<a class="btn hide-on-small-only" href="{{route('points')}}">Pontos</a>

 @if( session('message') )
<div class="card-panel teal lighten-2">
    <p class="white-text center">{{session('message')}}</p>
</div>
@endif
    @if(isset($users))
    <table>
    <thead>
        <tr>
            <th class="hide-on-small-only">Cód</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Pontos</th>
            <th>Créditos</th>
            <th>Add</th>
        </tr>
    </thead>
   
    <tbody>
    <tr>
      <td class="hide-on-small-only">{{$users->id}}</td>
      <td>{{$users->name}}</td>
      <td>{{$users->phone}}</td>  
      <td class="red-text">{{$qtd}}</td>  
      <td>R$  {{ number_format($users->credits, 2, ',', '.') }}</td>  
      <td><a href="{{route('client.edit', $users->id)}}"><i class="Tiny material-icons">add</i></a> </td>
    </tr>
    </tbody>
    </table>

    @else
    <div class="card-panel teal lighten-2">
        <p class="white-text center">A TELA DE VENDAS ESTÁ VAZIA.</p>
    </div>
    @endif
   <!-- se não existir uma orderm --> 
   @if(isset($orders)) 
   @forelse($orders as $order)
   <h6 class="col l6 s12 m6 hide-on-small-only"> Pedido: {{ $order->id }} </h6>
   <h6 class="col l6 s12 m6 hide-on-small-only"> Criado em: {{ $order->created_at->format('d/m/Y H:i') }} </h6>
    <table>
    <thead>
        <tr>
            <th class="hide-on-small-only">Cód</th>
            <th>Quantidade</th>
            <th>Produto</th>
            <th class="hide-on-small-only">Valor Unit.</th>
            <th class="hide-on-small-only">Desconto</th>
            <th>Total</th>
        </tr>
    </thead>
  
    <tbody>
        <!-- INICIA O VALOR ZERADO -->
        @php
            $total_pedido = 0;
        @endphp
        @foreach($order->TableOrderprod as $prodOrders)
        <tr>
            <td class="hide-on-small-only">{{$prodOrders->product_id}}</td>
            <td>
            <a  href="#" class="col l1 m1 s1" onclick="carrinhoRemoverProduto( {{ $order->id }}, {{ $prodOrders->product_id }},1 )"> <i class="tiny material-icons">remove_circle</i></a>
            <span class="col l2 m2 s2" align="center"> {{$prodOrders->qtd}}</span>
            <a href="#" class="col l1 m1 s1" onclick="carrinhoAdicionarProduto({{ $prodOrders->product_id }})"><i class="tiny material-icons">add_circle</i></a>
            </td>
            <td>{{$prodOrders->Tableprod->product}}</td>
            <td class="hide-on-small-only">R$ {{ number_format($prodOrders->Tableprod->price, 2, ',', '.') }}</td>
            <td class="hide-on-small-only">R$ {{ number_format($prodOrders->discount, 2, ',', '.') }}</td>
        <!-- FAZ A SOMA TOTAL DO PEDIDO COM OS PREÇOS -->
        @php
            $total_produto = $prodOrders->price - $prodOrders->discount;
            $total_pedido += $total_produto;
        @endphp
            <td>R$ {{ number_format($total_produto, 2, ',', '.') }}</td>
        </tr>   
        @endforeach
    </tbody>
    </table>
    <!-- DESCONTOS -->
    <div class="row">
        <form method="POST" action="{{route('discount', $order->id)}}">
            {{ csrf_field() }}
            <div class="input-field col s12 m12 l12">
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="tel"  name="discount"/>
            <label for="discount">Desconto</label>
            </div>
            <button type="submit" class="btn blue col s12 m4 l4" style="float:right">
                desconto
            </button>  
        </form>
    </div>

    <p class="btn red col s12 m2 l2" style="float:right"> <span>R$ {{ number_format($total_pedido, 2, ',', '.') }}</span></p>	
    <form method="POST" action="{{route('closeOrder')}}">
        {{ csrf_field() }}
        <input type="hidden" name="order_id" value="{{$order->id}}">
        <button type="submit" class="btn blue col s12 m4 l4" style="float:right">
            Concluir venda
        </button>   
    </form>
    @empty
    <div class="card-panel teal lighten-2">
        <p class="white-text center">NÃO HÁ NUNHUM ITEM NO CARRINHO.</p>
    </div>
    @endforelse

<form id="form-remover-produto" method="POST" action="{{ route('remove') }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="order">
    <input type="hidden" name="product_id">
    <input type="hidden" name="item">
</form>

<form id="form-adicionar-produto" method="POST" action="{{ route('addProd') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id">
</form>

@endif
<!-- fim do if -->

<!-- javascript -->
@push('scripts')
    <script type="text/javascript" src="{{url('js/style.js')}}"></script>
@endpush

@endsection