<?php 

function conectar() {
    $host = "127.0.0.1"; //endereço do servidor 
    $db = "rede_social"; // nome do bando de dados
    $user = "root";    //usuário do banco
    $pass = "";       // 


    $conn = mysqli_connect("$host","$user","$pass","$db") or die ("Erro de conexão");
    return $conn;
}  

fubb
?>