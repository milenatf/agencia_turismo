    <div class="form-group">
        {!! Form::select('brand_id', $brands, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::number('qty_passengers', null, ['class' => 'form-control', 'placeholder' => 'Quantidade de passageiros']) !!}
    </div>

    <div class="form-group">
        {!! Form::select('class', $classes, null, ['class' => 'form-control']) !!}
    </div>

<div class="form-group">
    <button class="btn btn-search">Enviar</button>
</div>

