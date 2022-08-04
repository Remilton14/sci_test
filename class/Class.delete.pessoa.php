<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include_once 'Class.Conection.php';

if(isset($_GET['id_pessoa']) && !empty($_GET['id_pessoa']))
    $data_atual     = date('Y-m-d H:i:s');
    $id_pessoa      = filter_input(INPUT_GET,'id_pessoa',FILTER_SANITIZE_NUMBER_INT);
    $salao_eventos  = filter_input(INPUT_GET,'salao_eventos',FILTER_SANITIZE_NUMBER_INT);
    $periodo_cafe_1 = filter_input(INPUT_GET,'cafe_um',FILTER_SANITIZE_NUMBER_INT);;
    $periodo_cafe_2 = filter_input(INPUT_GET,'cafe_dois',FILTER_SANITIZE_NUMBER_INT);;

    $sql_delete_pessoa       = "DELETE FROM `pessoas` WHERE `id_pessoa` = $id_pessoa";
    $sql_delete_pessoa_query = mysqli_query($conn,$sql_delete_pessoa);

    $linha_afetada = mysqli_affected_rows($conn);

    if($linha_afetada === 1){

        //Busca o lotação máxima da sala escolhida
        $sql_lotacao_max       = "SELECT `lotacao_sala`,`qnt_inscritos` FROM `sala_evento` WHERE `id_sala` = $salao_eventos";
        $sql_lotacao_max_query = mysqli_query($conn, $sql_lotacao_max);
        $sql_lotacao_max_assoc  = mysqli_fetch_assoc($sql_lotacao_max_query);

        //Calcula o total de inscritos no espaço de café
        $sql_inscritos_espaco_cafe = "SELECT * FROM `espaco_cafe` WHERE `id_espaco_cafe` = $periodo_cafe_1";
        $sql_inscritos_espaco_cafe_query = mysqli_query($conn, $sql_inscritos_espaco_cafe);
        $sql_inscritos_espaco_cafe_assoc = mysqli_fetch_assoc($sql_inscritos_espaco_cafe_query);

        //Atualiza as vagas
        $novo_inscrito       = $sql_lotacao_max_assoc['qnt_inscritos'] - 1;
        $sql_update_qtn_incritos = "UPDATE `sala_evento` SET `qnt_inscritos` = $novo_inscrito,`datemodified`='$data_atual' WHERE `id_sala` = $salao_eventos";
        $sql_update_qtn_incritos_query = mysqli_query($conn, $sql_update_qtn_incritos);

        $sql_novo_inscrito_espaco_cafe = $sql_inscritos_espaco_cafe_assoc["qtn_inscritos"] - 1;
        //Atualiza o espaço café 1
        $sql_update_qtn_incritos_espaco_cafe = "UPDATE `espaco_cafe` SET `qtn_inscritos`='$sql_novo_inscrito_espaco_cafe',`datemodified`='$data_atual' WHERE `id_espaco_cafe` = $periodo_cafe_1";
        $sql_update_qtn_incritos_espaco_cafe_query = mysqli_query($conn, $sql_update_qtn_incritos_espaco_cafe);
        //Atualiza o espaço cafe 2
        $sql_update_qtn_incritos_espaco_cafe_2 = "UPDATE `espaco_cafe` SET `qtn_inscritos`='$sql_novo_inscrito_espaco_cafe',`datemodified`='$data_atual' WHERE `id_espaco_cafe` = $periodo_cafe_2";
        $sql_update_qtn_incritos_espaco_cafe_2_query = mysqli_query($conn, $sql_update_qtn_incritos_espaco_cafe_2);


        mysqli_close($conn);
        $_SESSION['msg_success'] = "<p id='msg' style='background-color: #3b9d6f;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Pessoa deletada com sucesso</p>";
        header('Location: ../pessoa');
    }else{
        mysqli_close($conn);
        $_SESSION['msg_error'] = "<p id='msg' style='background-color: #d75656;color:#fff;padding: 10px;width: 40%;position: absolute;bottom: 40px;right: 0;box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;'>Não foi possível apagar este registro</p>";    
        header('Location: ../pessoa');
    }