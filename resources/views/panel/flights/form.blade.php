<div class="form-group">
    <label for="plane_id">Escolha o avião</label>
    {!! Form::select('plane_id', $planes, null, ['class' => 'form-control']) !!}
</div>
    <div class="form-group">
        <label for="origin">Origem</label>
        {{-- {!! Form::select('origin', $airports, $flight->airport_origin_id, null, ['class' => 'form-control']) !!} --}}
        {!! Form::select('origin', $airports, isset($flight) ? $flight->airport_origin_id : null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="destination">Destino</label>
        {!! Form::select('destination', $airports, isset($flight) ? $flight->destination : null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="date">Data</label>
        {!! Form::date('date', null, ['class' => 'form-control', 'placeholder' => 'Data']) !!}
    </div>

    <div class="form-group">
        <label for="time_duration">Duração</label>
        {!! Form::time('time_duration', null, ['class' => 'form-control', 'placeholder' => 'Duração']) !!}
    </div>

    <div class="form-group">
        <label for="hour_output">Hora da saída</label>
        {!! Form::time('hour_output', null, ['class' => 'form-control', 'placeholder' => 'Hora da saída']) !!}
    </div>

    <div class="form-group">
        <label for="arrival_time">Hora da chegada</label>
        {!! Form::time('arrival_time', null, ['class' => 'form-control', 'placeholder' => 'Hora da chegada']) !!}
    </div>

    <div class="form-group">
        <label for="old_price">Preço anterior</label>
        {!! Form::text('old_price', null, ['class' => 'form-control', 'placeholder' => 'Preço anterior']) !!}
    </div>

    <div class="form-group">
        <label for="price">Preço</label>
        {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Preço']) !!}
    </div>

    <div class="form-group">
        <label for="total_plots">Total de parcelas</label>
        {!! Form::text('total_plots', null, ['class' => 'form-control', 'placeholder' => 'Total de parcelas']) !!}
    </div>

    <div class="form-group">
        <label for="is_promotion">É Promoção?</label>
        {!! Form::checkbox('is_promotion', (isset($flight->is_promotion) && $flight->is_promotion == 1) ? true : 0, ['id' => 'is_promotion']) !!}
    </div>

    <div class="form-group">
        <label for="image">Arquivo</label>
        {!! Form::file('image', null, ['class' => 'form-control', 'placeholder' => 'Imagem']) !!}
    </div>

    <div class="form-group">
        <label for="qts_stops">Paradas</label>
        {!! Form::number('qts_stops', null, ['class' => 'form-control', 'placeholder' => 'Quantidade de paradas']) !!}
    </div>

    <div class="form-group">
        <label for="description">Descrição</label>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}
    </div>

<div class="form-group">
    <button class="btn btn-search">Enviar</button>
</div>

