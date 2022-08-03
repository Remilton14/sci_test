<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(isset($_GET['id_sala']) && !empty($_GET['id_sala'])){

    $data_atual = date('Y-m-d H:i:s');
    $id_sala    = filter_input(INPUT_GET,'id_sala',FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM `sala_evento` WHERE `id_sala` = $id_sala";
    $sql_query = mysqli_query($conn, $sql);

    $linha_afetada = mysqli_affected_rows($conn);

    if($linha_afetada === 1){
        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Sala deletada com sucesso</p>";
        header('Location: ../sala-de-eventos');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível apagar este registro</p>";    
        header('Location: ../sala-de-eventos');
    }
}else{
    header('Location: ../sala-de-eventos');
}