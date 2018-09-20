@extends('layouts.app')

@section('content')

    <a href="{{route('home')}}" class="btn blue">Voltar</a>
    <a href="{{route('listclient')}}" class="btn"><i class="small material-icons">add_circle</i></a>
    <a href="#" class="btn">{{date('d/m/Y')}}</a>
    
    <div class="col-md-12"> 
    <form action="{{route('shedules')}}" method="POST">
      {{ csrf_field() }}
      <div class="input-field col s10 m10">
      <input type="text" class="datepicker"  name="data"  autofocus>
      </div>
      <button class="btn waves-effect waves-light" type="submit">Buscar</button>
      <a href="#" class="btn red">{{count($data)}}</a>
      @if(isset($date))
        <a href="#" class="btn red">{{$date}}</a>
      @endif

    </form>
    </div>
 
    @if(count($data) > 0)
    <table>
      <thead>
        <tr>
            <th>Horario</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data</th>
            <th>Edit</th>
            <th>Cancelar</th>
        </tr>
      </thead>

      <tbody>
      @foreach($data as $client)
        <tr style="color:{{$client->color}}">
          <td>{{$client->hora}}</td>
          <td>{{$client->name}}</td>
          <td>{{$client->phone}}</td>
          <td>{{ Carbon\Carbon::parse($client->date)->format('d/m/Y') }}</td>
          <td>
            <a href="{{route('edit', $client->id)}}"><i class="small material-icons">edit</i></a>
          </td>
          <td>
            <a href="{{route('deleta', $client->id)}}"><i class="small material-icons">delete_forever</i></a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    @else

    <div class="card-panel teal lighten-2">
        <p class="white-text center">NÃO TEMOS CLIENTES AGENDADO PARA ESSE DIA.</p>
    </div>

    @endif

    <!-- javascript -->
    @push('scripts')
        <script type="text/javascript" src="{{url('js/style.js')}}"></script>
    @endpush

@endsection

