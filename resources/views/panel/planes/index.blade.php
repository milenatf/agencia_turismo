@extends('panel.layouts.app')

@section('content')
    <div class="bred">
        <a href="" class="bred">Home ></a>
        <a href="" class="bred">Planes ></a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem dos aviões</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {{-- <form class="form form-inline"> --}}
            {!! Form::open(['route' => 'planes.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('key_search', null, ['class' => 'form-control', 'placeholder' => 'O que deseja encontrar?']) !!}

                <button class="btn btn-search">Pesquisar</button>
            {!! Form::close() !!}

            @if (isset($dataForm['key_search']))
                <div class="alert alert-info">
                    <p>
                        <a href="{{route('planes.index')}}"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        Resultado para: <strong>{{ $dataForm['key_search'] }}</strong>
                    </p>
                </div>
            @endif
            {{-- </form> --}}
        </div>

        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <div class="class-btn-insert">
            <a href="{{ route('planes.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th>Marca</th>
                <th>Total de passageiros</th>
                <th>classe</th>
                <th width="150">Ações</th>
            </tr>

            @forelse($planes as $plane)
                <tr>
                    <td>{{ $plane->name }}</td>
                    <td>...</td>
                    <td>{{ $plane->qty_passengers }}</td>
                    <td>{{ $plane->class }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $plane->id) }}" class="edit">Edit</a>
                        <a href="{{ route('brands.show', $plane->id) }}" class="delete">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="200">Nenhum item cadastrado!</td>
                </tr>
            @endforelse
        </table>

        @if(isset($dataForm)) <!-- Se existir a busca na página index -->
            {{ $planes->appends($dataForm)->links() }}
        @else
            {{ $planes->links() }}
        @endif
    </div><!--Content Dinâmico-->
@endsection