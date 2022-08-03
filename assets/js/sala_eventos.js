$(document).ready( function () {
    // $('#table_sala_eventos').DataTable({
    //     "language": {
    //         "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
    //     }
    // });

    $('#nome_sala_de_evento').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });

    $('#lotacao_sala_evento').blur(function(){
        if($('#lotacao_sala_evento').val() != ''){
            $('#lotacao_sala_evento').removeClass('border border-danger');
        }
    });

    $('#btn_cadastra_evento').click(function(){
        var nome_sala_de_evento = $('#nome_sala_de_evento').val();
        var lotacao_sala_evento = $('#lotacao_sala_evento').val();

        if(nome_sala_de_evento == ''){

            $('#nome_sala_de_evento').addClass('border border-danger');
            $('#nome_sala_de_evento').focus();
            
            $('#error_msg_notification').append('<span">O campo nome precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3200);

        }else if(lotacao_sala_evento == ''){

            $('#lotacao_sala_evento').addClass('border border-danger');
            $('#lotacao_sala_evento').focus();
            
            $('#error_msg_notification').append('<span">O campo nome precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3200);

        }else{
            $('#form_cadastro_evento').submit();
        }
    });

});    