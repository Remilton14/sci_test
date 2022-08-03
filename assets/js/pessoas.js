$(document).ready( function () {
    $('#tabela_pessoas').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
            }
    });

    // Cadastro novo
    $('#nome').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });
    $('#sobre_nome').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });
    $('#salao_eventos').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });
    $('#periodo_cafe_1').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });
    $('#periodo_cafe_2').blur(function(){
        if($(this).val() != ''){
            $(this).removeClass('border border-danger');
        }
    });

    $('#periodo_cafe_1').change(function(){
        var cafe_1 = $(this).val();
        if(cafe_1 != ''){
            $('#periodo_cafe_2').removeAttr("disabled");
        }
    });

    $('#periodo_cafe_2').change(function(){
        var cafe_1 = $('#periodo_cafe_1').val();
        var cafe_2 = $('#periodo_cafe_2').val();
        if(cafe_2 != '' && cafe_2 == cafe_1){
            $('#error_msg_notification').empty();
            $('#error_msg_notification').append('<span>Os tempos dos cafés precisam ser diferentes</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);
        }
    });

    $('#btn_cadastrar_pessoa').click(function(){
        //$('#form_cadastro_pessoas').preventDefault();

        var nome           = $('#nome').val();
        var sobre_nome     = $('#sobre_nome').val();
        var salao_eventos  = $('#salao_eventos').val();
        var periodo_cafe_1 = $('#periodo_cafe_1').val();
        var periodo_cafe_2 = $('#periodo_cafe_2').val();

        if(nome == ''){
            $('#nome').addClass('border border-danger');
            $('#nome').focus();
            
            $('#error_msg_notification').append('<span">O campo nome precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);
            
        }else if(sobre_nome == ''){
            $('#sobre_nome').addClass('border border-danger');
            $('#sobre_nome').focus();

            $('#error_msg_notification').append('<span">O campo sobre nome precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);

        }else if(salao_eventos  == ''){
            $('#salao_eventos').addClass('border border-danger');

            $('#error_msg_notification').append('<span">O campo Salão de eventos precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);

            $('#salao_eventos').focus();
        }else if(periodo_cafe_1 == ''){
            $('#periodo_cafe_1').addClass('border border-danger');
            $('#periodo_cafe_1').focus();

            $('#error_msg_notification').append('<span">O campo Período café um precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);

        }else if(periodo_cafe_2 == ''){
            $('#periodo_cafe_2').addClass('border border-danger');
            $('#periodo_cafe_2').focus();

            $('#error_msg_notification').append('<span">O campo Período café um precisa ser preenchido corretamente</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);

        }else if(periodo_cafe_1 == periodo_cafe_2){
            $('#periodo_cafe_1').addClass('border border-danger');
            $('#periodo_cafe_2').addClass('border border-danger');
            $('#periodo_cafe_2').focus();

            $('#error_msg_notification').append('<span>Os tempos dos cafés precisam ser diferentes</span>');
            setTimeout(() => {
                $('#error_msg_notification').empty();
            }, 3000);
        }else{
            $('#form_cadastro_pessoas').submit();
        }
    });

    //Fim cadastro novo
});