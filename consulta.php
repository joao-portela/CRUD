<?php

$operacao = $_GET["op"];

if($operacao == 1) {
    echo
    "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <link rel='stylesheet' href='./styleConsulta.css'>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@345;400&display=swap' rel='stylesheet'>    
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Cadastro de Alunos</title>
    </head>
    <body>
        <style>
            h1 {
                text-align: center;
            }
        </style>
    
        <h1>REDE SOCIAL</h1> <hr>

        <form action='principalRedeSocial.php' method='get'>
            <p>ESCOLHA A OPÇÃO:</p>
            <div class='formInput'>
                <input checked='checked' type='radio' name='op' id='incluir' value='1'>
                <label for='op'>INCLUIR</label> <br>
                <input type='radio' name='op' id='listar' value='2'>
                <label for='op'>LISTAR</label> <br>
                <input type='radio' name='op' id='pesquisar' value='3'>
                <label for='op'>PESQUISAR</label> <br>
                <input type='radio' name='op' id='alterar' value='4'>
                <label for='op'>ALTERAR</label> <br>
                <input type='radio' name='op' id='excluir' value='5'>
                <label for='op'>EXCLUIR</label> <br>
            </div>
            
            <input class='buttons' type='submit' name='send' id='send' value='ENVIAR'>
            <input class='buttons' type='reset' name='clear' id='clear' value='LIMPAR'>
            <input class='buttons' type='hidden' name='entrada' value='1'>
            <button class='buttons'><a href='./telaInicial.html'>Voltar</a></button>
       
        </form>
    </body>
    </html>";
} elseif($operacao == 2) {
    echo
    "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='./styleConsulta.css'>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@345;400&display=swap' rel='stylesheet'>    
        <title>Cadastro de Alunos</title>
    </head>
    <body>
        <style>
            h1 {
                text-align: center;
            
        </style>
    
        <h1>USUÁRIOS</h1> <hr>

        <form action='principalUsuarios.php' method='get'>
            <p>ESCOLHA A OPÇÃO:</p>
            <div class='formInput'>
                <input checked='checked' type='radio' name='op' id='incluir' value='1'>
                <label for='op'>INCLUIR</label> <br>
                <input type='radio' name='op' id='listar' value='2'>
                <label for='op'>LISTAR</label> <br>
                <input type='radio' name='op' id='pesquisar' value='3'>
                <label for='op'>PESQUISAR</label> <br>
                <input type='radio' name='op' id='alterar' value='4'>
                <label for='op'>ALTERAR</label> <br>
                <input type='radio' name='op' id='excluir' value='5'>
                <label for='op'>EXCLUIR</label> <br>
            </div>
            <input class='buttons' type='submit' name='send' id='send' value='ENVIAR'>
            <input class='buttons' type='reset' name='clear' id='clear' value='LIMPAR'>
            <input class='buttons' type='hidden' name='entrada' value='1'>
            <button class='buttons'><a href='./telaInicial.html'>Voltar</a></button>
        </form>
    </body>
    </html>";
} 
?>