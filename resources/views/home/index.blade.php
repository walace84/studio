@extends('layouts.app')

@section('content')


    <div class="row">

    
        <!-- RETURNO DAS MESSAGENS -->
        @if( session('message') )
        <div class="card-panel teal lighten-1">
            <span class="white-text center">{{session('message')}}</span>
        </div>
        @endif

        <!-- validação dos dados do formulario -->
        @if(isset($errors) && count($errors) > 0)
        @foreach($errors->all() as $error)
        <div class="card-panel red">
            <p>{{$error}}</p>
        </div>
        @endforeach
        @endif


        <a href="{{route('cart')}}">			
        <div class="col s12 m6 l4">
            <div class="green card-panel white-text">
                <div class="right">
                <i class="medium material-icons withe">shopping_cart</i>
                </div>
                <div class="name">
                    Carrinho
                </div>
                <h6>vendas</h6>
            </div>
        </div>
        </a>

        <a href="{{route('report')}}">			
        <div class="col s12 m6 l4">
            <div class="red card-panel white-text">
                <div class="right">
                <i class="medium material-icons withe">dehaze</i>
                </div>
                <div class="name">
                    Relatorio
                </div>
                <h6>vendas</h6>
            </div>
        </div>
        </a>

        <a href="{{route('client.index')}}">
        <div class="col s12 m6 l4">
            <div class="orange lighten-3  card-panel white-text">
                <div class="right">
                    <i class="medium material-icons">person_add</i>
                </div>
                <div class="name">
                    Cadastro
                </div>
                <h6>Cliente</h6>
            </div>
        </div>
        </a>

        <a href="{{route('product.index')}}">
        <div class="col s12 m6 l4">
            <div class="cyan accent-4 card-panel white-text">
                <div class="right">
                    <i class="medium material-icons">business_center</i>
                </div>
                <div class="name">
                    Cadastrar
                </div>
                <h6>Produtos</h6>
            </div>
        </div>
        </a>

        <a href="#">
        <div class="col s12 m6 l4">
            <div class="blue lighten-2 card-panel white-text">
                <div class="right">
                <i class="medium material-icons">beenhere</i>
                </div>
                <div class="name">
                   Total
                </div>
                <h6>{{$client}}</h6>
            </div>
        </div>    
        </a>

        <a href="{{route('inativo')}}">
        <div class="col s12 m6 l4">
            <div class="red lighten-1  card-panel white-text">
                <div class="right">
                    <i class="medium material-icons">do_not_disturb_alt</i>
                </div>
                <div class="name">
                    Inativo
                </div>
                <h6>{{$inativo}}</h6>
            </div>
        </div>
        </a>

        <a href="{{route('shedule')}}">
        <div class="col s12 m6 l4">
            <div class="blue  card-panel white-text">
                <div class="right">
                    <i class="medium material-icons">date_range</i>
                </div>
                <div class="name">
                    Agenda Diones
                </div>
                <h6>{{$agenda}}</h6>
            </div>
        </div>
        </a>

        <a href="{{route('shedule2')}}">
        <div class="col s12 m6 l4">
            <div class="grey darken-2  card-panel white-text">
                <div class="right">
                    <i class="medium material-icons">date_range</i>
                </div>
                <div class="name">
                    Agenda
                </div>
                <h6>{{$agenda2}}</h6>
            </div>
        </div>
        </a>

        <a href="{{'birthday'}}">
        <div class="col s12 m6 l4">
            <div class="grey darken-1  card-panel white-text">
                <div class="right">
                    <i class="medium material-icons">person</i>
                </div>
                <div class="name">
                Aniversário
                </div>
                <h6>{{$birthday}}</h6>
            </div>
        </div>
        </a>

 
    </div>


@endsection

