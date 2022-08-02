<?php
    $servername = "localhost";
    $database = "sci_test";
    $username = "root";
    $password = "";
        
    try{
        $conn = mysqli_connect($servername, $username, $password, $database);
     
    }catch(Exception $error){
        echo "Erro: Entre em contato com o administrador do sistema!";
    }
