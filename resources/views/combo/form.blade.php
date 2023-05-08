<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('servicio_ids[]', 'Servicios') }}
            <select class="form-control selectpicker" multiple data-live-search="true" name="servicio_ids[]">
            @foreach($servicios as $id => $nombre)
            <option value="{{ $id }}" data-precio="{{ $precio[$id] }}" {{ in_array($id, $combo->servicios->pluck('id')->toArray()) ? 'selected' : '' }} class="servicio-precio">{{ $nombre }}</option>
@endforeach
</select>

            {!! $errors->first('servicio_ids', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $combo->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('precio', $combo->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
    {{ Form::label('descuento') }}
    {{ Form::text('descuento', $combo->descuento, ['class' => 'form-control' . ($errors->has('descuento') ? ' is-invalid' : ''), 'placeholder' => 'Descuento']) }}
    {!! $errors->first('descuento', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('precio_final') }}
    {{ Form::text('precio_final', $combo->precio_final ?: 0, ['class' => 'form-control' . ($errors->has('precio_final') ? ' is-invalid' : ''), 'placeholder' => 'Precio Final']) }}
    {!! $errors->first('precio_final', '<div class="invalid-feedback">:message</div>') !!}
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
