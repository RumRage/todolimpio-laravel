<div class="box box-info padding-1">
    <div class="box-body">
         
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $agenda->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $agenda->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $agenda->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha_hora', 'Fecha y Hora') }}
            {{ Form::datetimeLocal('fecha_hora', $agenda->fecha_hora ?? null, ['class' => 'form-control' . ($errors->has('fecha_hora') ? ' is-invalid' : '')]) }}
            {!! $errors->first('fecha_hora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('combo_ids[]', 'Combos') }}
            <select class="form-control selectpicker" multiple data-live-search="true" name="combo_ids[]">
            @foreach($combos as $id => $nombre)
            <option value="{{ $id }}" data-precio="{{ $precio[$id] }}" {{ $agenda->combos && in_array($id, $agenda->combos->pluck('id')->toArray()) ? 'selected' : '' }} class="combo-precio">{{ $nombre }}</option>
            @endforeach
            </select>
            {!! $errors->first('combo_ids', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('precio', $agenda->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
        {{ Form::label('descuento') }}
        {{ Form::text('descuento', $agenda->descuento, ['class' => 'form-control' . ($errors->has('descuento') ? ' is-invalid' : ''), 'placeholder' => 'Descuento']) }}
        {!! $errors->first('descuento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
        {{ Form::label('precio_final') }}
        {{ Form::text('precio_final', $agenda->precio_final ?: 0, ['class' => 'form-control' . ($errors->has('precio_final') ? ' is-invalid' : ''), 'placeholder' => 'Precio Final']) }}
        {!! $errors->first('precio_final', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('metodo_pago') }}
            {{ Form::select('metodo_pago', ['Efectivo' => 'Efectivo', 'Transferencia' => 'Transferencia'], $agenda->metodo_pago, ['class' => 'form-control' . ($errors->has('metodo_pago') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un método de pago']) }}
            {!! $errors->first('metodo_pago', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.selectpicker').selectpicker();
  });

  $('.selectpicker').on('changed.bs.select', function () {
    var total = 0;
    $('.selectpicker option:selected').each(function() {
        total += parseFloat($(this).data('precio'));
    });
    var descuento = parseFloat($('#descuento').val());
    var precio_final = total - total * (descuento / 100);
    $('#precio').val(total);
    $('#precio_final').val(precio_final.toFixed(2)); // redondea a 2 decimales
});

$('#descuento').on('input', function() {
    var total = parseFloat($('#precio').val());
    var descuento = parseFloat($(this).val());
    var precio_final = total - total * (descuento / 100);
    $('#precio_final').val(precio_final.toFixed(2));
});
$('#precio_final').on('input', function() {
    var total = parseFloat($('#precio').val());
    var precio_final = parseFloat($(this).val());
    var descuento = 100 - ((precio_final / total) * 100);
    $('#descuento').val(descuento.toFixed(2));
});
</script>