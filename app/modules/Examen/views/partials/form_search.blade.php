<div class="form-group">
    <label for="cuenta" class="col-sm-2 control-label">Cuenta</label>
    <div class="col-sm-10">
        {{ Form::number('cuenta', '', ['class' => 'form-control', 'id' => 'cuenta', 'placeholder' => 'Ingrese Cuenta', 'required' => true]) }}
    </div>
</div>
<div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-search fa-fw"></i> Buscar
    </button>
</div>