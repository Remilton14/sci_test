<?php
    $servername = "localhost";
    $database = "u562704257_gerenciamento_";
    $username = "root";
    $password = "";
        
    try{
        $conn = mysqli_connect($servername, $username, $password, $database);
     
    }catch(Exception $error){
        echo "Erro: Entre em contato com o administrador do sistema!";
    }
