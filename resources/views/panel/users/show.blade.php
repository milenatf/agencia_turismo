@extends('panel.layouts.app')

@section('content')

    <div class="bred">
        <a href="{{ route('panel') }}" class="bred">Home ></a>
        <a href="{{ route('users.index') }}" class="bred">Usuários ></a>
        <a class="bred">{{ $user->name }}</a>
    </div>

    <div class="title-pg">
        <h1 class="title-pg">Detalhes de {{ $user->name }}</h1>
    </div>

    <div class="content-din">
        <div class="message">
            @include('panel.includes.alerts')
        </div>

        <ul>
            <li><img src="{{isset($user->image) ? url("/storage/users/{$user->image}") : url('assets/panel/imgs/no-image.png')}}" alt="{{ $user->image }}" width="70"></li>
            <li><strong>Nome:</strong> {{ $user->name }}</li>
            <li><strong>E-mail:</strong> {{ $user->email }}</li>
            <li><strong>Administrador:</strong> {{ $user->is_admin == 1 ? 'Sim' : 'Não' }}</li>
            <li><strong>Data de criação:</strong> {{ formatDateAndtime($user->created_at) }}</li>
            <li><strong>Última atualização:</strong> {{ formatDateAndtime($user->updated_at) }}</li>
        </ul>

        {{ Form::open(['route' => ['users.destroy', $user->id], 'class' => 'form form-search form-ds', 'method' => 'DELETE']) }}
            <div class="form-group">
                <button class="btn btn-danger">Deletar {{ $user->name }}</button>
            </div>
        {{ Form::close() }}
    </div>

@endsection