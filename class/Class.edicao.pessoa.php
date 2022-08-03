<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if($_POST && !empty($_POST))
    if(!empty($_POST['nome']) && !empty($_POST['sobre_nome']) && !empty($_POST['salao_eventos']) && !empty($_POST['periodo_cafe_1']) && !empty($_POST['periodo_cafe_2']))

        $data_atual     = date('Y-m-d H:i:s');
        $id_pessoa      = filter_input(INPUT_POST,'id_pessoa',FILTER_SANITIZE_NUMBER_INT);
        $nome           = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
        $sobre_nome     = filter_input(INPUT_POST,'sobre_nome',FILTER_SANITIZE_STRING);
        $salao_eventos  = filter_input(INPUT_POST,'salao_eventos',FILTER_SANITIZE_STRING);
        $periodo_cafe_1 = filter_input(INPUT_POST,'periodo_cafe_1',FILTER_SANITIZE_STRING);
        $periodo_cafe_2 = filter_input(INPUT_POST,'periodo_cafe_2',FILTER_SANITIZE_STRING);

        if($periodo_cafe_1 != $periodo_cafe_2)
            $sql_edita_pessoa = "UPDATE `pessoas` SET `nome_pessoa`='$nome',`sobre_nome_pessoa`='$sobre_nome',`sala_id`='$salao_eventos',`cafe_id_um`='$periodo_cafe_1',`cafe_id_dois`='$periodo_cafe_2',`datemodified`='$data_atual' WHERE `id_pessoa` = $id_pessoa";
            $sql_edita_pessoa_query = mysqli_query($conn, $sql_edita_pessoa);

            $num_linha_afetada = mysqli_affected_rows($conn);

            if($num_linha_afetada === 1){
                mysqli_close($conn);
                $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Sucesso na edição</p>";
                header('Location: ../pessoa');
            }else{
                mysqli_close($conn);
                $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível editar</p>";
                header('Location: ../pessoa');
            }