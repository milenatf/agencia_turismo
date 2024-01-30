@extends('panel.layouts.app')

@section('content')
    <div class="bred">
        <a href="" class="bred">Home ></a>
        <a href="" class="bred">Marcas ></a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Marcas de aviões</h1>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Listagem dos Itens</h1>
    </div>

    <div class="content-din bg-white">

        <div class="form-search">
            {{-- <form class="form form-inline"> --}}
            {!! Form::open(['route' => 'brands.search', 'class' => 'form form-inline']) !!}
                {!! Form::text('key_search', null, ['class' => 'form-control', 'placeholder' => 'O que deseja encontrar?']) !!}

                <button class="btn btn-search">Pesquisar</button>
            {!! Form::close() !!}
            {{-- </form> --}}
        </div>

        <div class="message">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>

        <div class="class-btn-insert">
            <a href="{{ route('brands.create') }}" class="btn-insert">
                <span class="glyphicon glyphicon-plus"></span>
                Cadastrar
            </a>
        </div>

        <table class="table table-striped">
            <tr>
                <th>Nome</th>
                <th width="150">Ações</th>
            </tr>

            @forelse($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="edit">Edit</a>
                        <a href="" class="delete">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="200">Nenhum item cadastrado!</td>
                </tr>
            @endforelse
        </table>

        @if(isset($dataForm)) <!-- Se existir a busca na página index -->
            {{ $brands->appends($dataForm)->links() }}
        @else
            {{ $brands->links() }}
        @endif
    </div><!--Content Dinâmico-->
@endsection