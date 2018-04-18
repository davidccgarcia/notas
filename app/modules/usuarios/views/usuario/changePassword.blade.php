<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Cambiar Clave</h4>
        </div>
        <div class="modal-body">
            <form role="form">
                <div class="form-group">
                    {{ Form::label('password', 'Contraseña') }}
                    {{ Form::password('password', array('class' => 'form-control','placeholder'=>'Escriba su clave')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
                    {{ Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>'Vuelva a escribir su clave')) }}
                </div>

            </form>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </div>
</div>
