@extends('panel.layouts.app')

@section('content')

    <div class="bred">
        <a href="{{route('panel')}}" class="bred">Home ></a>
        <a href="{{ route('airports.index', $airport->city->id) }}" class="bred">Aeroportos ></a>
        <a class="bred">Detalhes</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Detalhes de {{ $airport->name }}</h1>
    </div>

    <div class="content-din">
        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <ul>
            <li><strong>Nome:</strong> {{ $airport->name }}</li>
            <li><strong>Cidade:</strong> {{ $airport->city->name }}</li>
            <li><strong>Latitude:</strong> {{ $airport->latitude }}</li>
            <li><strong>Longitude:</strong> {{ $airport->longitude }}</li>
            <li><strong>Número:</strong> {{ $airport->number }}</li>
            <li><strong>CEP:</strong> {{ $airport->zip_code }}</li>
            <li><strong>Endereço:</strong> {{ $airport->address }}</li>
            <li><strong>Complemento:</strong> {{ $airport->complement }}</li>
            <li><strong>Data de criação:</strong> {{ $airport->created_at }}</li>
            <li><strong>Última atualização:</strong> {{ $airport->updated_at }}</li>
        </ul>

        {{ Form::open(['route' => ['airports.destroy', $airport->city->id, $airport->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) }}
            <div class="form-group">
                <button class="btn btn-danger">Deletar</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection