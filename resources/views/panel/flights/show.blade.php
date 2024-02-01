@extends('panel.layouts.app')

@section('content')

    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="{{ route('flights.index') }}" class="bred">voos ></a>
        <a class="bred">{{ $flight->id }}</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Detalhes do voo {{ $flight->id }}</h1>
    </div>

    <div class="content-din">
        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <ul>
            <li><strong>ID:</strong> {{ $flight->id }}</li>
            <li><strong>Avião:</strong> {{ $flight->plane_id }}</li>
            <li><strong>Origem:</strong> {{ $flight->origin->name }}</li>
            <li><strong>Destino:</strong> {{ $flight->destination->name }}</li>
            <li><strong>Data:</strong> {{ formatDateAndtime($flight->date) }}</li>
            <li><strong>Tempo de voo:</strong> {{ formatDateAndtime($flight->time_duration) }}</li>
            <li><strong>Saída:</strong> {{ formatDateAndtime($flight->hour_output, 'H:i') }}</li>
            <li><strong>Chegada:</strong> {{ formatDateAndtime($flight->arrival_time, 'H:i') }}</li>
            <li><strong>Preço anterior:</strong> {{ number_format($flight->old_price, 2, ',','.') }}</li>
            <li><strong>Preço:</strong> {{ number_format($flight->price, 2, ',','.') }}</li>
            <li><strong>Parcelas:</strong> {{ $flight->total_plots }}</li>
            <li><strong>Promocional:</strong> {{ $flight->is_promotion ? 'Sim' : 'Não' }}</li>
            <li><strong>Imagem:</strong> {{ $flight->image }}</li>
            <li><strong>Parada:</strong> {{ $flight->qts_stops }}</li>
            <li><strong>Descrição:</strong> {{ $flight->description }}</li>
            <li><strong>Data de criação:</strong> {{ $flight->created_at }}</li>
            <li><strong>Última atualização:</strong> {{ $flight->updated_at }}</li>
        </ul>

        {{ Form::open(['route' => ['flights.destroy', $flight->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) }}
            <div class="form-group">
                <button class="btn btn-danger">Deletar {{ $flight->id }}</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection