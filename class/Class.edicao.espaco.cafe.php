<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(isset($_POST["id_espaco_cafe"]) && isset($_POST["nome_espaco_cafe_edicao"]) && isset($_POST["lotacao_max_cafe_edicao"])){

    $data_atual = date('Y-m-d H:i:s');
    $id_espaco_cafe          = filter_input(INPUT_POST,'id_espaco_cafe',FILTER_SANITIZE_STRING);
    $nome_espaco_cafe_edicao = filter_input(INPUT_POST,'nome_espaco_cafe_edicao',FILTER_SANITIZE_STRING);
    $lotacao_max_cafe_edicao = filter_input(INPUT_POST,'lotacao_max_cafe_edicao',FILTER_SANITIZE_STRING);

    $sql = "UPDATE `espaco_cafe` SET `nome_espaco_cafe`='$nome_espaco_cafe_edicao',`lotacao_max_cafe`='$lotacao_max_cafe_edicao',`datemodified`='$data_atual' WHERE `id_espaco_cafe` = $id_espaco_cafe";
    $sql_query = mysqli_query($conn, $sql);

    $num_linha_afetada = mysqli_affected_rows($conn);

    if($num_linha_afetada === 1){

        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Sucesso na edição</p>";
        header('Location: ../espaco-de-cafe');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding:10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível editar</p>";
        header('Location: ../espaco-de-cafe');
    }

}else{
    header('Location: ../espaco-de-cafe');
}