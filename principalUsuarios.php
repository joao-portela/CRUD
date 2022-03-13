<?php

//Utilizando as funções do arquivo banco.php
 require_once("banco.php");

// recebendo a função
$operacao = $_GET['op'];
    
// selecionando a operação 

switch($operacao){
    case 1:  // incluir
        $entrada = $_GET['entrada'];
        if($entrada == 1) 
            formIncluir();
        if($entrada == 2) 
            execIncluir();    
        break;
    case 2:  // Listar
        execListar();
        break;
    case 3:  // pesquisar
        $entrada = $_GET['entrada'];
        if($entrada == 1) 
            formPesquisar();
        if($entrada == 2)
            execPesquisar();   
        break;
    case 4:  // alterar
        $entrada = $_GET['entrada'];
        if($entrada == 1)
            formPesquisarAlterar();
        if($entrada == 2)
            formAlterar();   
        if($entrada == 3)
            execAlterar();   
        break;
    case 5:  // excluir
        $entrada = $_GET['entrada'];            
        if($entrada == 1)
            formExcluir();
        if($entrada == 2)
            execExcluir();   
        break;
}

function formIncluir() {
    echo 
   "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
    <style>
        #titulo {
            text-align: center;
        }
    </style>
        <form action='principalUsuarios.php' method='get'>
            <h1 id='titulo'><strong>INCLUSÃO DE USUÁRIOS</strong></h1> <hr>
            
            <p>PREENCHA OS DADOS</p> 

            <label for='CPF'>CPF</label>
            <input type='text' name='CPF' id='CPF'> <br>
            <label for='nome'>NOME</label> 
            <input type='text' name='nome' id='nome'> <br>
            <label for='nascimento'>NASCIMENTO</label> 
            <input type='text' name='nascimento' id='nascimento' value='Digite no formato xxxx-xx-xx'> <br>
            <label for='idade'>IDADE</label> 
            <input type='text' name='idade' id='idade'> <br>
            <label for='email'>E-MAIL</label> 
            <input type='email' name='email' id='email'> <br>
            <label for='telefone'>TELEFONE</label> 
            <input type='tel' name='telefone' id='telefone'> <br>
            <input type='submit' name='send' id='send' value='ENVIAR'>
            <input type='reset' name='clear' id='clear' value='LIMPAR'>
            <input type='hidden' name='op' value='1'>
            <input type='hidden' name='entrada' value='2'>
            <button><a href='./telaInicial.html'>Voltar</a></button>
        </form>
    </body>
    </html>";
}

function execIncluir() {
   
    //Recebendo os dados
    $cpf = $_GET['CPF'];
    $nascimento = $_GET['nascimento'];
    $nome = $_GET['nome'];
    $idade = $_GET['idade'];
    $email = $_GET['email'];
    $telefone = $_GET['telefone'];

    //Montando o SQL
    $sql = "INSERT INTO usuario (cpf, email_usuario, idade, nascimento, nome, telefone) values('$cpf', '$email', '$idade', '$nascimento', '$nome', '$telefone')";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $status = mysqli_query($conn,$sql);

    if($status) {
        echo "<br> Registro inserido <br>";
    } else {
        echo "<br> Erro na inclusão. Verifique os dados inseridos. <br>" ;

    }   
   
    echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
}

function execListar() {

    //Montando o SQL
    $sql = "SELECT * FROM usuario";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $dados = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($dados);

    echo "
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1><strong>LISTAGEM DE USUÁRIOS</strong></h1> <br>";

    echo"<center><table border=1 width=80%>";
    echo"<tr><th>CPF</TH><TH>E-MAIL</TH><TH>IDADE</TH><th>NASCIMENTO</th><th>NOME</th><th>TELEFONE</th></TR>";

    $linha = mysqli_fetch_array($dados); //Posiciona na primeira linha

    for($i=0; $i<$total; $i++) {
        
        $cpf =  $linha['cpf'];
        $email =  $linha['email_usuario'];
        $idade =  $linha['idade'];
        $nascimento = $linha['nascimento'];
        $nome =  $linha['nome'];      
        $telefone = $linha['telefone'];

        echo "<tr><td>$cpf</td><td>$email</td><td>$idade</td><td>$nascimento</td><td>$nome</td><td>$telefone</td></tr>";
        $linha = mysqli_fetch_assoc($dados);
    }
    echo "</table></center>";
    echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
 
}

function formPesquisar() {
    echo 
   "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
    <style>
        #titulo {
            text-align: center;
        }
    </style>
        <form action='principalUsuarios.php' method='get'>
            <h1 id='titulo'><strong>PESQUISA DE USUÁRIOS</strong></h1> <hr>
            
            <label for='CPF'>DIGITE O CPF DO USUÁRIO:</label>
            <input type='text' name='CPF' id='CPF'> <br>
            <input type='submit' name='send' id='send' value='ENVIAR'>
            <input type='reset' name='clear' id='clear' value='LIMPAR'>
            <input type='hidden' name='op' value='3'>
            <input type='hidden' name='entrada' value='2'>
            <button><a href='./telaInicial.html'>Voltar</a></button>
        </form>
    </body>
    </html>";
}

function execPesquisar() {

    //Recebendo o CPF 
    $cpf = $_GET['CPF'];

    //Montando o SQL
    $sql = "SELECT * FROM usuario WHERE $cpf=cpf";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $dados = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($dados);

    if($total == 0) {
        echo "<br> Usuário não encontrado <br>";
        echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
        exit();
    }

    echo"<center><table border=1 width=80%>";
    echo"<tr><th>CPF</th><th>E_MAIL</th><th>IDADE</th><th>NASCIMENTO</th><th>NOME</th><th>TELEFONE</th></tr>";

    $linha = mysqli_fetch_array($dados); //Posiciona na primeira linha

    for($i=0; $i<$total; $i++) {
        
        $cpf =  $linha['cpf'];
        $email =  $linha['email_usuario'];
        $idade =  $linha['idade'];
        $nascimento = $linha['nascimento'];
        $nome =  $linha['nome'];      
        $telefone = $linha['telefone'];

        echo "<tr><td>$cpf</td><td>$email</td><td>$idade</td><td>$nascimento</td><td>$nome</td><td>$telefone</td></tr>";
        $linha = mysqli_fetch_assoc($dados);
    }
    echo "</table></center>";
    echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
 
}

function formExcluir() {
    echo 
   "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
    <style>
        #titulo {
            text-align: center;
        }
    </style>
        <form action='principalUsuarios.php' method='get'>
            <h1 id='titulo'><strong>EXCLUSÃO DE REDE SOCIAL</strong></h1> <hr>
            
            <label for='CPF'>DIGITE O CPF DO USUÁRIO:</label>
            <input type='text' name='CPF' id='CPF'> <br>
            <input type='submit' name='send' id='send' value='ENVIAR'>
            <input type='reset' name='clear' id='clear' value='LIMPAR'>
            <input type='hidden' name='op' value='5'>
            <input type='hidden' name='entrada' value='2'>
            <button><a href='./telaInicial.html'>Voltar</a></button>
        </form>
    </body>
    </html>";


}

function execExcluir() {
   
    //Recebendo os dados
    $cpf = $_GET['CPF'];

    //Montando o SQL
    $sql = "DELETE FROM usuario WHERE cpf = $cpf";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $status = mysqli_query($conn,$sql);

    if($status) {
        echo "<br> Registro de CPF: $cpf excluído. <br>";
    } else {
        echo "<br> Erro na exclusão. Verifique o CPF inserido. <br>" ;

    }  
   
    echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
}

function formPesquisarAlterar() {
    echo 
   "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
    <style>
        #titulo {
            text-align: center;
        }
    </style>
        <form action='principalUsuarios.php' method='get'>
            <h1 id='titulo'><strong>ALTERAÇÃO DE USUÁRIO</strong></h1> <hr>
            
            <label for='CPF'>DIGITE O CPF DO USUÁRIO:</label>
            <input type='text' name='CPF' id='CPF'> <br>
            <input type='submit' name='send' id='send' value='ENVIAR'>
            <input type='reset' name='clear' id='clear' value='LIMPAR'>
            <input type='hidden' name='op' value='4'>
            <input type='hidden' name='entrada' value='2'>
            <button><a href='./telaInicial.html'>Voltar</a></button>
        </form>
    </body>
    </html>";


}

function formAlterar() {

    //Recebendo o ID 
    $cpf = $_GET["CPF"];

    //Montando o SQL
    $sql = "SELECT * FROM usuario WHERE $cpf=cpf";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $dados = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($dados);

    if($total == 0) {
        echo "<br> Usuário não encontrado <br>";
        echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
        exit();
    }

    $linha = mysqli_fetch_array($dados); //Posiciona na primeira linha
 
    $email =  $linha['email_usuario'];
    $idade =  $linha['idade'];
    $nascimento = $linha['nascimento'];
    $nome =  $linha['nome'];      
    $telefone = $linha['telefone'];


    echo 
   "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
    </head>
    <body>
    <style>
        #titulo {
            text-align: center;
        }
    </style>
        <form action='principalUsuarios.php' method='get'>
            <h1 id='titulo'><strong>ALTERAÇÃO DE USUÁRIO</strong></h1> <hr>
            
            <p>PREENCHA OS DADOS</p> 

            <label for='CPF'>CPF</label>
            <input type='text' name='CPF' id='CPF' value='$cpf'> <br>
            <label for='nome'>NOME</label> 
            <input type='text' name='nome' id='nome' value='$nome'> <br>
            <label for='nascimento'>NASCIMENTO</label> 
            <input type='text' name='nascimento' id='nascimento' value='$nascimento'> <br>
            <label for='idade'>IDADE</label> 
            <input type='text' name='idade' id='idade' value='$idade'> <br>
            <label for='email'>E-MAIL</label> 
            <input type='email' name='email' id='email' value='$email'> <br>
            <label for='telefone'>TELEFONE</label> 
            <input type='tel' name='telefone' id='telefone' value='$telefone'> <br>
            <input type='submit' name='send' id='send' value='ENVIAR'>
            <input type='reset' name='clear' id='clear' value='LIMPAR'>
            <input type='hidden' name='op' value='4'>
            <input type='hidden' name='entrada' value='3'>
            <button><a href='./telaInicial.html'>Voltar</a></button>
        </form>
    </body>
    </html>";
}

function execAlterar() {
   
    //Recebendo os dados
    $cpf =  $_GET['CPF'];
    $email =  $_GET['email'];
    $idade =  $_GET['idade'];
    $nascimento = $_GET['nascimento'];
    $nome =  $_GET['nome'];      
    $telefone = $_GET['telefone'];

    //Montando o SQL
    $sql = "UPDATE usuario SET email_usuario='$email', idade='$idade', nascimento='$nascimento', nome='$nome', telefone='$telefone' WHERE cpf=$cpf";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $status = mysqli_query($conn,$sql);

    if($status) {
        echo "<br> Registro alterado <br>";
    } else {
        echo "<br> Erro na alteração. Verifique os dados inseridos. <br>" ;

    }  
   
    echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
}


?>