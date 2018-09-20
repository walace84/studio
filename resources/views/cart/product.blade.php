@extends('layouts.app')

@section('content')

<div class="row">
<a href="{{route('cart')}}" class="btn blue">Voltar</a>

<div class="col-md-12"> 

    <table class="highlight">
    <thead>
        <tr>
            <th>Produto</th>
            <th class="hide-on-small-only">Descrição</th>
            <th>Valor</th>
            <th>Adicionar</th>
        </tr>
    </thead>
    @foreach($products as $product)
    <tbody>
        <tr>
        <td>{{$product->product}}</td>
        <td class="hide-on-small-only">{{$product->description}}</td>
        <td>{{$product->price}}</td>
        <td>
            <form method="POST" action="{{ route('addProd') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}">
                <button class="btn waves-effect waves-light" type="submit"><i class="Tiny material-icons">add</i></button>   
            </form>
        </td>
        </tr>
    </tbody>
    @endforeach
    </table>

</div>
</div> 

@endsection