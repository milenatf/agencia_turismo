@extends('panel.layouts.app')

@section('content')
    {{ $airports }}
    <div class="bred">
        <a href="{{route('panel')}}" class="bred">Home ></a>
        <a href="{{route('states.index')}}" class="bred">Estados ></a>
        <a href="{{ route('state.cities', $city->state->initials) }}" class="bred">{{ $city->state->name }} ></a>
        <a href="" class="bred">{{$city->name}} ></a>
        <a href="" class="bred">Aeroportos</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Aeroportos da cidade {{ $city->name }}</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => ['airports.search', $city->id], 'class' => 'form form-inline']) !!}
                {!! Form::text('key_search', null, ['class' => 'form-control', 'placeholder' => 'O que deseja encontrar?']) !!}

                <button class="btn btn-search">Pesquisar</button>
            {!! Form::close() !!}

            @if (isset($dataForm['key_search']))
                <div class="alert alert-info">
                    <p>
                        <a href="{{ route('airports.index', $city->id) }}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        Resultado para: <strong>{{ $dataForm['key_search'] }}</strong>
                    </p>
                </div>
            @endif
        </div>

        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <div class="class-btn-insert">
            <a href="{{ route('airports.create', $city->id) }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th width="150">Ações</th>
            </tr>

            @forelse($airports as $airport)
                <tr>
                    <td>{{ $airport->name }}</td>
                    <td>{{ $airport->address }}</td>
                    <td>
                        <a href="{{ route('airports.edit', [$city->id, $airport->id]) }}" class="edit">Edit</a>
                        <a href="{{ route('airports.show', [$city->id, $airport->id]) }}" class="delete">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="200">Nenhum item cadastrado!</td>
                </tr>
            @endforelse
        </table>

        @if(isset($dataForm)) <!-- Se existir a busca na página index -->
            {{ $airports->appends($dataForm)->links() }}
        @else
            {{ $airports->links() }}
        @endif
    </div><!--Content Dinâmico-->
@endsection