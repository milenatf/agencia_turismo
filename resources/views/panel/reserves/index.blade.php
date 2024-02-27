@extends('panel.layouts.app')

@section('content')
    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="{{ route('reserves.index') }}" class="bred">Reservas </a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">{{ $reserves->count() }} de {{ $reserves->total() }} Reservas </strong></h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => 'reserves.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('user', null, ['class' => 'form-control', 'placeholder' => 'Filtrar por usuário']) !!}

                {!! Form::text('reserve', null, ['class' => 'form-control', 'placeholder' => 'Filtrar por reserva']) !!}

                {!! Form::date('date', null, ['class' => 'form-control', 'placeholder' => 'Filtrar por data']) !!}

                <button class="btn btn-search">Pesquisar</button>
            {!! Form::close() !!}

            @if (isset($dataForm['key_search']))
                <div class="alert alert-info">
                    <p>
                        <a href=""><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        Resultado para: <strong>{{ $dataForm['key_search'] }}</strong>
                    </p>
                </div>
            @endif
        </div>

        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <div class="class-btn-insert">
            <a href="{{ route('reserves.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Usuário</th>
                <th>Voo</th>
                <th>Data da reserva</th>
                <th>Status</th>
                <th with="200">Ações</th>
            </tr>

            @forelse($reserves as $reserve)
                <tr>
                    <td>{{ $reserve->user->name }}</td>
                    <td>{{ $reserve->flight_id }} ({{formatDateAndtime($reserve->flight->date)}})</td>
                    <td>{{ formatDateAndtime($reserve->date_reserved) }}</td>
                    <td>{{ $reserve->status($reserve->status) }}</td>
                    {{-- <td>{{ $reserve->status($reserve->status) }}</td> --}}
                    <td>
                        <a href="{{ route('reserves.edit', $reserve->id) }}" class="edit">
                            <i class="fa fa-thumb-tack" aria-hidden="true"></i> Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="200">Nenhum item cadastrado!</td>
                </tr>
            @endforelse
        </table>

        @if(isset($dataForm)) <!-- Se existir a busca na página index -->
            {{ $reserves->appends($dataForm)->links() }}
        @else
            {{ $reserves->links() }}
        @endif
    </div><!--Content Dinâmico-->
@endsection
