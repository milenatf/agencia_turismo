@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home ></a>
    <a href="" class="bred">{{$airport->city->name}} ></a>
    <a href="{{ route('airports.index', $airport->city->id) }}" class="bred">Aeroportos ></a>
     <a href="" class="bred">Alterar Aeroporto {{ $airport->name }}</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Alterar Aeroporto {{ $airport->name }}</h1>
</div>

<div class="content-din">

    @include('panel.includes.errors')

    {!! Form::model($airport, ['route' => ['airports.update', $airport->city->id, $airport->id ], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
        @include('panel.airports.form')
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection
