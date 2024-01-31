@extends('panel.layouts.app')

@section('content')

    <div class="bred">
        <a href="{{route('panel')}}" class="bred">Home ></a>
        <a href="{{ route('brands.index') }}" class="bred">Marcas ></a>
        <a href="" class="bred">{{$brand->name}}</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Aviões da {{ $brand->name }}</h1>
    </div>

    <div class="content-din bg-white">
        <table class="table table-striped">
            <tr>
                <th>Marca</th>
                <th>Classe</th>
                <th>Quantidade de passageiros</th>
                <th>Data de criação</th>
                <th>Última atualização</th>
                <th width="150">Ações</th>
            </tr>

            @forelse($brand->planes as $plane)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $plane->class }}</td>
                    <td>{{ $plane->qty_passengers }}</td>
                    <td>{{ $plane->updated_at }}</td>
                    <td>{{ $plane->created_at }}</td>
                    <td>
                        <a href="{{ route('planes.edit', $plane->id) }}" class="edit">Edit</a>
                        <a href="{{ route('planes.show', $plane->id) }}" class="delete">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="200">Nenhum item cadastrado!</td>
                </tr>
            @endforelse
        </table>
@endsection