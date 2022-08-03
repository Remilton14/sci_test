<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(isset($_GET['id_pessoa']) && !empty($_GET['id_pessoa']))
    $id_pessoa = filter_input(INPUT_GET,'id_pessoa',FILTER_SANITIZE_NUMBER_INT);
    $sql_delete_pessoa = "DELETE FROM `pessoas` WHERE `id_pessoa` = $id_pessoa";
    $sql_delete_pessoa_query = mysqli_query($conn,$sql_delete_pessoa);

    $linha_afetada = mysqli_affected_rows($conn);

    if($linha_afetada === 1){
        $_SESSION['msg_success'] = "<p>teste</p>";
        header('Location: ../pessoa');
    }else{
        $_SESSION['msg_error'] = "<p>teste error</p>";    
        header('Location: ../pessoa');
    }