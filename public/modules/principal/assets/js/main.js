function successFormExamen(result) {

    var alert = $('#alertMessage');
    var clases = 'alert alert-success alert-dismissible';
    var mensaje = result.mensaje;
    
    if (result.error) {
        mensaje = result.error;
        clases = 'alert alert-danger alert-dismissible';
    }

    $('<span/>', {
        'aria-hidden' : 'true'
    }).html('&times;').appendTo(
        $('<button/>', {
            'type': 'button',
            'class': 'close',
            'data-dismiss' : 'alert',
            'aria-label' : 'Close'
        }).appendTo(
            $('<div/>', {
                'class' : clases,
                'role' : 'alert'
            }).text(mensaje).appendTo(alert)
        )
    );

    document.getElementById('form-exam').reset();

    return false;
}

function errorFormExamen(result) {
    console.log(result.responseText);
}

var funciones = {
    'ajax': function(data, url, success, error, token) {
        //console.log(data);
        var obj = {
            'data': data,
            '_token':$("input[name=_token]").val(), 
            'hallazgo' : $('#hallazgo').val(), 
            'evolucion_id' : $('#evolucion_id').val(), 
            'ingreso' : $('#ingreso').val(), 
            'fecha': $('#fecha').val()
        };

        $.ajax({
            method: "POST",
            url: url,
            data: obj,
            success: function(result){
                successFormExamen(result);
            },
            error: function(result){
                /*console.log('error');
                /*console.log(result);*/
                errorFormExamen(result);
            }
        }, "json")
    }
};



$(document).ready(function() {
    var elementForm = document.getElementsByClassName('sw_normal');
    var longitud = elementForm.length;
    //console.log(elementForm);
    
    var alert = $('#success-message');
    alert.addClass('hidden');

    $('#save').click(function(e) {
        e.preventDefault();

        var data = [];
        
        for (var i = 0; i < longitud; i++) {
            var element = $(elementForm[i]);

            if (element.is(':checked')) {
                var objSwNomral = {
                    'tipo_sistema' : element.attr('tipo_sistema'),
                    'sw_normal' : element.val()
                };

                data.push(objSwNomral);
            }
        }
        var url = '/examen';
       //console.log(data);
        
        funciones.ajax(data, url, successFormExamen, errorFormExamen);
        return false;

    });
});