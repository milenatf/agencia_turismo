@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home ></a>
    <a href="{{route('states.index')}}" class="bred">Estados ></a>
    <a href="{{ route('state.cities', $city->state->initials) }}" class="bred">{{$city->name}} ></a>
    <a href="{{ route('airports.index', $city->id) }}" class="bred">Aeroportos ></a>
    <a class="bred">Cadastrar aeroporto</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Cadastrar aeroporto na cidade: {{ $city->name }}</h1>
</div>

<div class="content-din">

    @include('panel.includes.errors')

    {!! Form::open(['route' => ['airports.store', $city->id], 'class' => 'form form-search form-ds', 'files' => true]) !!}
        @include('panel.airports.form')
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection
