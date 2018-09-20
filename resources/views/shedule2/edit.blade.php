@extends('layouts.app')


@section('content')

 <div class="row">
 
 <h6>Agendar Cliente</h6>
 <form class="col s12" action="{{route('update2', $data->id)}}" method="POST">
 <!-- RETURNO DAS MESSAGENS -->
 @if( session('message') )
 <div class="card-panel teal lighten-1">
     <span class="white-text center">{{session('message')}}</span>
 </div>
 @endif

 @if( session('errors') )
 <div class="card-panel red">
     <span class="white-text center">{{session('errors')}}</span>
 </div>
 @endif
 
 {{csrf_field()}}
 <div class="row">
     <div class="input-field col s6">
        <input type="text" class="validate" name="name" value="{{ $data->name}}" readonly>
        <label for="name">Nome</label>
     </div>
     <div class="input-field col s6">
        <input  id="phone" type="tel" name="phone"  value="{{ $data->phone}}" readonly/>
        <label for="phone">Telefone</label>
     </div>
 </div>

 <div class="row">
    <div class="input-field col s6 m6">
        <input type="text" class="datepicker" name="date" value="{{ Carbon\Carbon::parse($data->date)->format('d-m-Y') }}">
    </div>
    <div class="input-field col s6 m6">
        <input class="timepicker" type="time" name="hora" value="{{$data->hora}}">
    </div>
 </div>

   <div class="input-field col s12">
    <select name="color">
      <option value="#000">confirmado</option>
      <option value="#e65100">retorno</option>
    </select>
    <label>Confirma agenda</label>
  </div>


 <a class="btn blue" href="{{url('sheduletwo')}}">Voltar</a>
     
 
 <button class="btn waves-effect waves-light" type="submit">Reagendar</button>
</form>

</div>

<!-- javascript -->
@push('scripts')
    <script type="text/javascript" src="{{url('js/style.js')}}"></script>
@endpush

@endsection