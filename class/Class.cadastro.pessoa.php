<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(!empty($_POST['nome']) && !empty($_POST['sobre_nome']) && !empty($_POST['salao_eventos']) && !empty($_POST['periodo_cafe_1']) && !empty($_POST['periodo_cafe_2'])){

        $data_atual     = date('Y-m-d H:i:s');
        $nome           = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
        $sobre_nome     = filter_input(INPUT_POST,'sobre_nome',FILTER_SANITIZE_STRING);
        $salao_eventos  = filter_input(INPUT_POST,'salao_eventos',FILTER_SANITIZE_STRING);
        $periodo_cafe_1 = filter_input(INPUT_POST,'periodo_cafe_1',FILTER_SANITIZE_STRING);
        $periodo_cafe_2 = filter_input(INPUT_POST,'periodo_cafe_2',FILTER_SANITIZE_STRING);

        //Busca o lotação máxima da sala escolhida
        $sql_lotacao_max       = "SELECT `lotacao_sala`,`qnt_inscritos` FROM `sala_evento` WHERE `id_sala` = $salao_eventos";
        $sql_lotacao_max_query = mysqli_query($conn, $sql_lotacao_max);
        $sql_lotacao_max_assoc   = mysqli_fetch_assoc($sql_lotacao_max_query);

        //Calcula o total inscrito na sala
        $sql_inscritos = "SELECT COUNT(*) AS `qtn_pessoas` FROM `pessoas` WHERE `sala_id` = $salao_eventos";
        $sql_inscritos_query = mysqli_query($conn, $sql_inscritos);
        $sql_inscritos_assoc = mysqli_fetch_assoc($sql_inscritos_query);

        //Calcula o total de inscritos no espaço de café
        $sql_inscritos_espaco_cafe = "SELECT * FROM `espaco_cafe` WHERE `id_espaco_cafe` = $periodo_cafe_1";
        $sql_inscritos_espaco_cafe_query = mysqli_query($conn, $sql_inscritos_espaco_cafe);
        $sql_inscritos_espaco_cafe_assoc = mysqli_fetch_assoc($sql_inscritos_espaco_cafe_query);

        if(intval($sql_inscritos_assoc['qtn_pessoas']) <= intval($sql_lotacao_max_assoc['lotacao_sala'])){

            if($sql_inscritos_espaco_cafe_assoc['qtn_inscritos'] <= $sql_inscritos_espaco_cafe_assoc['lotacao_max_cafe']){
                
                $sql_novo_cadastro_pessoa = "INSERT INTO `pessoas`(`nome_pessoa`, `sobre_nome_pessoa`, `sala_id`, `cafe_id_um`, `cafe_id_dois`, `datecreate`) VALUES ('$nome','$sobre_nome','$salao_eventos','$periodo_cafe_1','$periodo_cafe_2','$data_atual')";
                $sql_novo_cadastro_pessoa_query = mysqli_query($conn,$sql_novo_cadastro_pessoa);
                
                $novo_id = mysqli_insert_id($conn);
        
                if($novo_id > 0 && $novo_id != ''){
    
                    $sql_novo_inscrito       = $sql_lotacao_max_assoc['qnt_inscritos'] + 1;
                    $sql_update_qtn_incritos = "UPDATE `sala_evento` SET `qnt_inscritos` = $sql_novo_inscrito,`datemodified`='$data_atual' WHERE `id_sala` = $salao_eventos";
                    $sql_update_qtn_incritos_query = mysqli_query($conn, $sql_update_qtn_incritos);
    
                    $sql_novo_inscrito_espaco_cafe = $sql_inscritos_espaco_cafe_assoc["qtn_inscritos"] + 1;
                    //Atualiza o espaço café 1
                    $sql_update_qtn_incritos_espaco_cafe = "UPDATE `espaco_cafe` SET `qtn_inscritos`='$sql_novo_inscrito_espaco_cafe',`datemodified`='$data_atual' WHERE `id_espaco_cafe` = $periodo_cafe_1";
                    $sql_update_qtn_incritos_espaco_cafe_query = mysqli_query($conn, $sql_update_qtn_incritos_espaco_cafe);
                    //Atualiza o espaço cafe 2
                    $sql_update_qtn_incritos_espaco_cafe_2 = "UPDATE `espaco_cafe` SET `qtn_inscritos`='$sql_novo_inscrito_espaco_cafe',`datemodified`='$data_atual' WHERE `id_espaco_cafe` = $periodo_cafe_2";
                    $sql_update_qtn_incritos_espaco_cafe_2_query = mysqli_query($conn, $sql_update_qtn_incritos_espaco_cafe_2);
    
                    mysqli_close($conn);
                    $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Cadastrado com sucesso</p>";
                    header('Location: ../pessoa');
                }else{
                    mysqli_close($conn);
                    $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível cadastrar</p>";
                    header('Location: ../pessoa');
                }
            }else{
                mysqli_close($conn);
                $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não permitido inscrição neste espaço de café, total máximo atingido</p>";
                header('Location: ../pessoa');
            }
      
        }else{
            mysqli_close($conn);
            $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não permitido inscrição nesta sala, total máximo atingido</p>";
            header('Location: ../pessoa');
        }

        /* close connection */
        mysqli_close($conn);
    
       
}else{
    header('Location: ./');
}
        