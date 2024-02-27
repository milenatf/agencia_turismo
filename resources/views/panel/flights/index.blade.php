@extends('panel.layouts.app')

@section('content')
    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="" class="bred">Voos</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">{{ $title }}</strong></h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => 'flights.search', 'class' => 'form form-inline']) !!}
                {!! Form::number('code', null, ['class' => 'form-control', 'placeholder' => 'Código do voo']) !!}
                {!! Form::date('date', null, ['class' => 'form-control']) !!}
                {!! Form::time('hour_output', null, ['class' => 'form-control']) !!}
                {!! Form::number('qts_stops', null, ['class' => 'form-control', 'placeholder' => 'Paradas']) !!}
                {!! Form::select('airport_origin_id', $airports, ['class' => 'form-control']) !!}
                {!! Form::select('airport_destination_id', $airports, ['class' => 'form-control']) !!}

                <button class="btn btn-search">Pesquisar</button>
            {!! Form::close() !!}

            @if (isset($dataForm))
                <div class="alert alert-info">
                    <p>
                        <a href="{{ route('flights.index') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        <p>Resultado para:<p>
                        @if($dataForm['code'])
                            <p><strong>Codigo:</strong> {{$dataForm['code']}} </p>
                        @endif

                        @if($dataForm['date'])
                            <p><strong>Data do voo:</strong> {{ formatDateAndtime($dataForm['date']) }} </p>
                        @endif

                        @if($dataForm['hour_output'])
                            <p><strong>Saída:</strong> {{ formatDateAndTime($dataForm['hour_output'], 'H:i')}} </p>
                        @endif

                        @if($dataForm['qts_stops'])
                            <p><strong>Paradas:</strong> {{$dataForm['qts_stops']}} </p>
                        @endif

                        @if($dataForm['airport_origin_id'])
                            <p><strong>Origem:</strong> {{$airports[$dataForm['airport_origin_id']]}} </p>
                        @endif

                        @if($dataForm['airport_destination_id'])
                            <p><strong>Destino:</strong> {{$airports[$dataForm['airport_destination_id']]}} </p>
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <div class="class-btn-insert">
            <a href="{{ route('flights.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Imagem</th>
                <th>Avião</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Paradas</th>
                <th>Data</th>
                <th>Saída</th>
                <th width="150">Ações</th>
            </tr>

            @forelse($flights as $flight)
                <tr>
                    <td>
                        @if($flight->image)
                            <img src="{{ url("/storage/flights/{$flight->image}") }}" alt="{{$flight->id}}" style="max-width: 50px;">
                        @else
                            <img src="{{ url('assets/panel/imgs/no-image.png') }}" alt="{{$flight->id}}" style="max-width: 50px;">
                        @endif
                    </td>
                    <td>{{ $flight->plane_id }}</td>
                    <td><a href="">{{ $flight->origin->name }}</a></td>
                    <td><a href="">{{ $flight->destination->name }}</a></td>
                    <td>{{ $flight->qts_stops }}</td>
                    <td>{{ formatDateAndtime($flight->date) }}</td>
                    <td>{{ formatDateAndtime($flight->hour_output, 'H:i') }}</td>
                    <td>
                        <a href="{{ route('flights.edit', $flight->id) }}" class="edit">Edit</a>
                        <a href="{{ route('flights.show', $flight->id) }}" class="delete">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="200">Nenhum item cadastrado!</td>
                </tr>
            @endforelse
        </table>

        @if(isset($dataForm)) <!-- Se existir a busca na página index -->
            {{ $flights->appends($dataForm)->links() }}
        @else
            {{ $flights->links() }}
        @endif
    </div><!--Content Dinâmico-->
@endsection