@extends('layouts.app')

@section('content')

<div class="row">



<div class="col-md-12"> 

    <table class="highlight">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descricao</th>
            <th>Pontuação</th>
            <th class="hide-on-small-only">Valor</th>
            <th class="hide-on-small-only">Fornecedor</th>
            <th class="hide-on-small-only">Telefone</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td>{{$product->product}}</td>
        <td>{{$product->description}}</td>
        <td>{{$product->points}}</td>
        <td class="hide-on-small-only">{{$product->price}}</td>
        <td class="hide-on-small-only">{{$product->provider}}</td>
        <td class="hide-on-small-only">{{$product->phone}}</td>
        <td>
           <form class="form" method="POST" action="{{route('product.destroy', $product->id)}}">
                {!! method_field('DELETE') !!}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger"><i class="small material-icons">delete</i></button>
            </form>	
        </td>
        </tr>
    </tbody>
    
    </table>

</div>
<a class="btn blue" href="{{url('admin/product')}}">Voltar</a>

</div> 


@endsection