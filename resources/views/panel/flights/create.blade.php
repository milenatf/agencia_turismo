@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{ route('panel') }}" class="bred">Home ></a>
    <a href="{{ route('planes.index') }}" class="bred">Voos ></a>
    <a class="bred">Cadastrar voo</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Cadastrar voo</h1>
</div>

<div class="content-din">

    @include('panel.includes.errors')

    {!! Form::open(['route' => 'flights.store', 'class' => 'form form-search form-ds', 'files' => true]) !!}
        @include('panel.flights.form')
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection
