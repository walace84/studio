@extends('layouts.app')

@section('content')



  <div class="row">
        <h6>Cadastro de Produtos</h6>
        <form class="col s12" action="{{route('product.update', $product->id)}}" method="POST">
        {!! method_field('PUT') !!} <!-- o metodo UPDATE só recebe campo do tipo PUT -->
        <!-- RETURNO DAS MESSAGENS -->
        @if( session('message') )
        <div class="card-panel teal lighten-1">
            <span class="white-text center">{{session('message')}}</span>
        </div>
        @endif

        @if(isset($errors) && count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="card-panel orange darken-4">
            <span class="white-text center">{{$error}}</span>
            </div>
            @endforeach
        @endif
        
        {{csrf_field()}}
        <div class="row">
            <div class="input-field col s12 m6 l6">
            <input placeholder="nome"  type="text" class="validate" name="product" required value="{{$product->product}}" autofocus>
            <label for="name">Produto</label>
            </div>
            <div class="input-field col s12 m6 l6">
            <input placeholder="descrição" type="text" class="validate" name="description" required  value="{{$product->description}}">
            <label for="description">Descrição</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l6">
            <input placeholder="Fornecedor"  type="text" class="validate" name="provider"  value="{{$product->provider}}" autofocus>
            <label for="provider">Fornecedor</label>
            </div>
            <div class="input-field col s12 m6 l6">
            <input  id="phone" type="tel"  maxlength="15" name="phone"  value="{{$product->phone}}"  pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" />
            <label for="phone">Telefone</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l6">
            <input type="tel" required="required" maxlength="15" name="price" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$"  value="{{ number_format($product->price, 2, ',', '.') }}" />
            <label for="price">Preço</label>
            </div>

            <div class="input-field col s12 m6 l6">
                <select name="points" required>
                <option value="" disabled selected>Escolha a pontuação</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select>
                <label>Pontuação dos produtos</label>
            </div>
        </div>

     

        <a class="btn blue" href="{{url('admin/product')}}">Voltar</a>


        <button class="btn waves-effect waves-light" type="submit">Atualizar
        </button>
    </form>
  </div>

@endsection