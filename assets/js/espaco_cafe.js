$(document).ready( function () {
    $('#table_espaco_cafe').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
    });

    $('#nome_espaco_cafe').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });

    $('#lotacao_max_cafe').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });

    $('#btn_cadastra_espaco_cafe').click(function(){

        var nome_espaco_cafe = $('#nome_espaco_cafe').val();
        var lotacao_max_cafe = $('#lotacao_max_cafe').val();

        if(nome_espaco_cafe == ''){

            $('#nome_espaco_cafe').addClass('border border-danger');
            $('#nome_espaco_cafe').focus();
            
            $('#error_msg_notification').append('<span">O campo nome precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3200);

        }else if(lotacao_max_cafe == ''){

            $('#lotacao_max_cafe').addClass('border border-danger');
            $('#lotacao_max_cafe').focus();
            
            $('#error_msg_notification').append('<span">O campo nome precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3200);

        }else{
            $('#form_cadastro_espaco_cafe').submit();
        }

    });

});