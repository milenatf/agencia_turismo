@extends('panel.layouts.app')

@section('content')
    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="{{ route('states.index') }}" class="bred">Estados ></a>
        <a href="{{ route('state.cities', $state->initials) }}" class="bred">{{$state->name}}</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">{{ $cities->count() }} de {{ $cities->total() }} Cidades brasileiras do estado do <strong>{{$state->name}}</strong></h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {!! Form::open(['route' => ['state.cities.search', $state->initials], 'class' => 'form form-inline']) !!}
                {!! Form::text('key_search', null, ['class' => 'form-control', 'placeholder' => 'O que deseja encontrar?']) !!}

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

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th with="200">Ações</th>
            </tr>

            @forelse($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>
                        <a href="{{ route('airports.index', $city->id) }}" class="edit">
                            <i class="fa fa-thumb-tack" aria-hidden="true"></i> Aeroportos
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
            {{ $cities->appends($dataForm)->links() }}
        @else
            {{ $cities->links() }}
        @endif
    </div><!--Content Dinâmico-->
@endsection
