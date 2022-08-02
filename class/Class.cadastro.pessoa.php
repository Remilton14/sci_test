<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['btn_cadastrar_pessoa']) && !empty($_POST['btn_cadastrar_pessoa']))
    if(!empty($_POST['nome']) && !empty($_POST['sobre_nome']) && !empty($_POST['salao_eventos']) && !empty($_POST['periodo_cafe_1']) && !empty($_POST['periodo_cafe_2']))
        
        include_once 'Class.Conection.php';
       
        $data           = date('Y-m-d H:i:s');
        $nome           = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
        $sobre_nome     = filter_input(INPUT_POST,'sobre_nome',FILTER_SANITIZE_STRING);
        $salao_eventos  = filter_input(INPUT_POST,'salao_eventos',FILTER_SANITIZE_STRING);
        $periodo_cafe_1 = filter_input(INPUT_POST,'periodo_cafe_1',FILTER_SANITIZE_STRING);
        $periodo_cafe_2 = filter_input(INPUT_POST,'periodo_cafe_2',FILTER_SANITIZE_STRING);

        $sql_nova_pessoa = "INSERT INTO `pessoas`(`nome_pessoa`, `sobre_nome_pessoa`, `sala_id`, `cafe_id_um`, `cafe_id_dois`, `datecreate`) VALUES ('$nome','$sobre_nome','$salao_eventos','$periodo_cafe_1','$periodo_cafe_2','$data')";
        $sql_nova_pessoa_query = mysqli_query($conn,$sql_nova_pessoa);

        var_dump($sql_nova_pessoa_query);
        // $novo_id = mysqli_insert_id($conn);



        /* close connection */
        mysqli_close($conn);
        