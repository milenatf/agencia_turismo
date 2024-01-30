@extends('panel.layouts.app')

@section('content')

    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="{{ route('brands.index') }}" class="bred">Marcas ></a>
        <a class="bred">{{ $brand->name }}</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Detalhes de {{ $brand->name }}</h1>
    </div>

    <div class="content-din">
        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <ul>
            <li><strong>Nome:</strong> {{ $brand->name }}</li>
            <li><strong>Data de criação:</strong> {{ $brand->created_at }}</li>
            <li><strong>Última atualização:</strong> {{ $brand->updated_at }}</li>
        </ul>

        {{ Form::open(['route' => ['brands.destroy', $brand->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) }}
            <div class="form-group">
                <button class="btn btn-danger">Deletar {{ $brand->name }}</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection