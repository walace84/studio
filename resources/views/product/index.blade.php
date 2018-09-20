@extends('layouts.app')

@section('content')

<div class="row">
<a href="{{route('home')}}" class="btn blue">Voltar</a>
<a class="btn" href="{{route('product.create')}}"><i class="medium material-icons">add_circle</i></a> 

<div class="col-md-12"> 
    @if(count($products) > 0)
    <table class="highlight">
    <thead>
        <tr>
            <th>Produto</th>
            <th class="hide-on-small-only">Descrição</th>
            <th>Valor</th>
            <th>edit</th>
            <th>visu</th>
        </tr>
    </thead>
    @foreach($products as $product)
    <tbody>
        <tr>
        <td>{{$product->product}}</td>
        <td class="hide-on-small-only">{{$product->description}}</td>
        <td>{{ number_format($product->price, 2, ',', '.') }}</td>
        <td>
          <a  href="{{route('product.edit', $product->id)}}"><i class="small material-icons">edit</i></a>
        </td>
        <td>
          <a  href="{{route('product.show', $product->id)}}"><i class="small material-icons">remove_red_eye</i></a>
        </td>
        </tr>
    </tbody>
    @endforeach
    </table>
    @else
    <div class="card-panel  teal lighten-2 white-text center">
        <h6>NÃO TEMOS PRODUTOS CADASTRADOS</h6>
    </div>
    @endif
</div>
</div> 

@endsection