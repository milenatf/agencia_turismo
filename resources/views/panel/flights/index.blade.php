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
                {!! Form::text('key_search', null, ['class' => 'form-control', 'placeholder' => 'O que deseja encontrar?']) !!}

                <button class="btn btn-search">Pesquisar</button>
            {!! Form::close() !!}

            @if (isset($dataForm['key_search']))
                <div class="alert alert-info">
                    <p>
                        <a href="{{ route('flights.index') }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        Resultado para: <strong>{{ $dataForm['key_search'] }}</strong>
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
