    <div class="form-group">
        <label for="name">Nome</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome completo'] ) !!}
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
    </div>

    <div class="form-group">
        <label for="password">Senha</label>
        {!! Form::text('password', '12345678', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="image">Imagem</label>
        {!! Form::file('image', null, ['class' => 'form-control', 'placeholder' => 'Imagem']) !!}
    </div>

    <div class="form-group">
        <label for="is_admin">É administrador?</label>
        {!! Form::checkbox('is_admin', true, false, ['class' => 'form-check-input']) !!}
    </div>

<div class="form-group">
    <button class="btn btn-search">Enviar</button>
</div>

