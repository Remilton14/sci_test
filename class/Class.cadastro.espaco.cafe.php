<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(!empty($_POST["nome_espaco_cafe"]) && !empty($_POST["lotacao_max_cafe"])){

    $data_atual     = date('Y-m-d H:i:s');
    $nome_espaco_cafe = filter_input(INPUT_POST,'nome_espaco_cafe',FILTER_SANITIZE_STRING); 
    $lotacao_max_cafe = filter_input(INPUT_POST,'lotacao_max_cafe',FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO `espaco_cafe`(`nome_espaco_cafe`, `lotacao_max_cafe`, `datecreate`) VALUES ('$nome_espaco_cafe','$lotacao_max_cafe','$data_atual')";
    $sql_query = mysqli_query($conn, $sql);

    $novo_id = mysqli_insert_id($conn);
    
    if($novo_id > 0 && $novo_id != ''){
        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Cadastrado realizado com sucesso</p>";
        header('Location: ../espaco-de-cafe');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível cadastrar</p>";
        header('Location: ../espaco-de-cafe');
    }

}else{
    header('Location: ../espaco-de-cafe');
}