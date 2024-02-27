@extends('panel.layouts.app')

@section('content')
<div class="bred">
    <a href="{{ route('panel') }}" class="bred">Home ></a>
    <a href="{{ route('users.index') }}" class="bred">usuários ></a>
    <a class="bred">Alterar usuário</a>
</div>

<div class="title-pg">
    <h1 class="title-pg">Alterar usuário {{ $user->name }}</h1>
</div>

<div class="content-din">

    <div class="message">
        @include('panel.includes.alerts')
    </div>

    @include('panel.includes.errors')

    {!! Form::model($user, ['route' => ['users.update', $user->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'PUT']) !!}
        @include('panel.users.form')
    {!! Form::close() !!}

</div><!--Content Dinâmico-->

@endsection
