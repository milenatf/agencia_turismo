@extends('panel.layouts.app')

@section('content')

    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="{{ route('planes.index') }}" class="bred">Aviões ></a>
        <a class="bred">{{ $plane->id }}</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Detalhes de {{ $plane->name }}</h1>
    </div>

    <div class="content-din">
        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <ul>
            <li><strong>ID:</strong> {{ $plane->id }}</li>
            <li><strong>Marca:</strong> {{ $plane->brand->name }}</li>
            <li><strong>Classe:</strong> {{ $plane->class }}</li>
            <li><strong>Total de passageiros:</strong> {{ $plane->qty_passengers }}</li>
            <li><strong>Data de criação:</strong> {{ $plane->created_at }}</li>
            <li><strong>Última atualização:</strong> {{ $plane->updated_at }}</li>
        </ul>

        {{ Form::open(['route' => ['planes.destroy', $plane->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) }}
            <div class="form-group">
                <button class="btn btn-danger">Deletar {{ $plane->name }}</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection