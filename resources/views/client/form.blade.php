@extends('layouts.app')


@section('content')

 <div class="row">
 
 <h6>Cadastro de Usuário</h6>
 <form class="col s12" action="{{route('client.store')}}" method="POST">
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
     <input placeholder="nome"  type="text" class="validate" name="name" required value="{{ old('name')}}" autofocus>
     <label for="name">Nome</label>
     </div>
     <div class="input-field col s12 m6 l6">
        <input type="date"  name="data" required  value="{{ old('data')}}">
    </div>
 </div>

 <div class="row">
     <div class="input-field col s12 m6 l6">
     <input placeholder="E-mail" type="text" class="validate" name="email" required  value="{{ old('email')}}">
     <label for="email">E-mail</label>
     </div>
     <div class="input-field col s12 m6 l6">
     <input  id="phone" type="tel" required="required" maxlength="15" name="phone"  value="{{ old('phone')}}"  pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" />
     <label for="phone">Telefone</label>
     </div>
 </div>

 <div class="row">
     <div class="input-field col s12 m6 l6">
     <input placeholder="Empresa/Profissão"  type="text" class="validate" name="company" required value="{{ old('company')}}">
     <label for="company">Empresa/Profissão</label>
     </div>
     <div class="input-field col s12 m6 l6">
     <input placeholder="bairro"  type="text" class="validate" name="bairro" required value="{{ old('bairro')}}">
     <label for=bairro"">Bairro</label>
     </div>
 </div>

  <div class="row">
     <div class="input-field col s12 m6 l6">
     <input placeholder="Cidade"  type="text" class="validate" name="city" required value="{{ old('city')}}">
     <label for=city"">Cidade</label>
     </div>

    <div class="input-field col s12 m6 l6">
    <input type="tel" required="required" maxlength="15" name="credits" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" value="{{ old('credits')}}" />
    <label for="credits">Créditos</label>
    </div>
 </div>
 

 <a class="btn blue" href="{{url('admin/client')}}">Voltar</a>
     
 
 <button class="btn waves-effect waves-light" type="submit">Cadastrar
 </button>
</form>

</div>

<!-- javascript -->
@push('scripts')
    <script type="text/javascript" src="{{url('js/style.js')}}"></script>
@endpush

@endsection