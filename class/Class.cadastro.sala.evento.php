<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';
echo "<pre>";
var_dump($conn);

if(!empty($_POST['nome_sala_de_evento']) && !empty($_POST['lotacao_sala_evento'])){

    $data_atual           = date('Y-m-d H:i:s');
    $nome_sala_de_evento = filter_input(INPUT_POST,'nome_sala_de_evento',FILTER_SANITIZE_STRING);
    $lotacao_sala_evento = filter_input(INPUT_POST,'lotacao_sala_evento',FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO `sala_evento`(`nome_sala`, `lotacao_sala`, `qnt_inscritos`, `datecreate`) VALUES ('$nome_sala_de_evento','$lotacao_sala_evento',0,'$data_atual')";
    $sql_query = mysqli_query($conn, $sql);
    $novo_id = mysqli_insert_id($conn);

    var_dump($conn);
    
    if($novo_id > 0 && $novo_id != ''){
        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Cadastrado com sucesso</p>";
        header('Location: ../sala-de-eventos');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível cadastrar</p>";
        //header('Location: ../sala-de-eventos');
    }

}else{
    //header('Location: ../sala-de-eventos');
}