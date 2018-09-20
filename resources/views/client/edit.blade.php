@extends('layouts.app')

@section('content')

  <div class="row">
 
        <h6>Atualizar dados de Usuário</h6>
        <form class="col s12" action="{{route('client.update', $client->id)}}" method="POST">
        {!! method_field('PUT') !!} 
        {{csrf_field()}}
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
        
       
        <div class="row">
            <div class="input-field col s12 m6 l6">
            <input placeholder="nome"  type="text" class="validate" name="name" required value="{{$client->name}}">
            <label for="name">Nome</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <input type="date"  name="data" required  value="{{ $client->data}}">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l6">
            <input placeholder="E-mail" type="text" class="validate" name="email" value="{{$client->email}}">
            <label for="email">E-mail</label>
            </div>
            <div class="input-field col s12 m6 l6">
            <input placeholder="(XX) XXXXX-XXXX" type="tel" required="required" maxlength="15" name="phone" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" value="{{$client->phone}}" />
            <label for="phone">Telefone</label>
            </div>
        </div>

         <div class="row">
            <div class="input-field col s12 m6 l6">
            <input placeholder="Empresa"  type="text" class="validate" name="company" required value="{{$client->company}}">
            <label for="company">Empresa</label>
            </div>
            <div class="input-field col s12 m6 l6">
            <input placeholder="bairro"  type="text" class="validate" name="bairro" required value="{{$client->bairro}}">
            <label for=bairro"">Bairro</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6 l6">
            <input placeholder="Cidade"  type="text" class="validate" name="city" required value="{{$client->city}}">
            <label for=city"">Cidade</label>
            </div>

            <div class="input-field col s12 m6 l6">
            <input type="tel" required="required" maxlength="15" name="credits" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$"  value="{{ number_format($client->credits, 2, ',', '.') }}" />
            <label for="credits">Créditos</label>
            </div>
        </div>

        <a class="btn blue" href="{{url('admin/client')}}">Voltar</a>
            
        
        <button class="btn waves-effect waves-light" type="submit">Atualizar
        </button>
    </form>

  </div>

@endsection