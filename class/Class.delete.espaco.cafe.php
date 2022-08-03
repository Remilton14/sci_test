<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(isset($_GET['id_espaco_cafe']) && !empty($_GET['id_espaco_cafe'])){

    $data_atual = date('Y-m-d H:i:s');
    $id_espaco_cafe    = filter_input(INPUT_GET,'id_espaco_cafe',FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM `espaco_cafe` WHERE `id_espaco_cafe` = $id_espaco_cafe";
    $sql_query = mysqli_query($conn, $sql);

    $linha_afetada = mysqli_affected_rows($conn);

    if($linha_afetada === 1){
        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Espaço de café deletado com sucesso</p>";
        header('Location: ../espaco-de-cafe');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível apagar este registro</p>";    
        header('Location: ../espaco-de-cafe');
    }
}else{
    header('Location: ../espaco-de-cafe');
}