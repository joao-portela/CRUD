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
        <form action='principalRedeSocial.php' method='get'>
            <h1 id='titulo'><strong>INCLUSÃO DE REDE SOCIAL</strong></h1> <hr>
            
            <p>PREENCHA OS DADOS</p> 

            <label for='id'>ID REDE SOCIAL</label>
            <input type='text' name='id' id='id'> <br>
            <label for='nome'>NOME</label> 
            <input type='text' name='nome' id='nome'> <br>
            <label for='plataforma'>PLATAFORMA</label> 
            <input type='text' name='plataforma' id='plataforma'> <br>
            <label for='CNPJ'>CNPJ</label>
            <input type='text' name='CNPJ' id='CNPJ'> <br>
            <label for='CEO'>CEO</label>
            <input type='text' name='CEO' id='CEO'> <br>
            <label for='empresa'>EMPRESA</label>
            <input type='text' name='empresa' id='empresa'> <br>
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
    $id = $_GET['id'];
    $plataforma = $_GET['plataforma'];
    $nome = $_GET['nome'];
    $cnpj = $_GET['CNPJ'];
    $ceo = $_GET['CEO'];
    $empresa = $_GET['empresa'];

    //Montando o SQL
    $sql = "INSERT INTO redesocial (ceo_rede, cnpj, empresa, id_rede_social, nome, plataforma) values('$ceo', '$cnpj', '$empresa', '$id', '$nome', '$plataforma')";

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
    $sql = "SELECT * FROM redesocial";

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
    <h1><strong>LISTAGEM DE REDES SOCIAIS</strong></h1> <br>";

    echo"<center><table border=1 width=80%>";
    echo"<tr><th>CEO</TH><TH>CNPJ</TH><TH>EMPRESA</TH><th>ID DA REDE</th><th>NOME DA REDE</th><th>PLATAFORMA</th></TR>";

    $linha = mysqli_fetch_array($dados); //Posiciona na primeira linha

    for($i=0; $i<$total; $i++) {
        
        $ceo =  $linha['ceo_rede'];
        $cnpj =  $linha['cnpj'];
        $empresa =  $linha['empresa'];
        $id = $linha['id_rede_social'];
        $nome =  $linha['nome'];      
        $plataforma = $linha['plataforma'];

        echo "<tr><td>$ceo</td><td>$cnpj</td><td>$empresa</td><td>$id</td><td>$nome</td><td>$plataforma</td></tr>";
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
        <form action='principalRedeSocial.php' method='get'>
            <h1 id='titulo'><strong>PESQUISA DE REDE SOCIAL</strong></h1> <hr>
            
            <label for='id'>DIGITE O ID DA REDE:</label>
            <input type='text' name='id' id='id'> <br>
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

    //Recebendo o ID 
    $id = $_GET["id"];

    //Montando o SQL
    $sql = "SELECT * FROM redesocial WHERE $id=id_rede_social";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $dados = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($dados);

    if($total == 0) {
        echo "<br> Rede Social não encontrada <br>";
        echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
        exit();
    }

    echo"<center><table border=1 width=80%>";
    echo"<tr><th>CEO</TH><TH>CNPJ</TH><TH>EMPRESA</TH><th>ID DA REDE</th><th>NOME DA REDE</th><th>PLATAFORMA</th></TR>";

    $linha = mysqli_fetch_array($dados); //Posiciona na primeira linha

    for($i=0; $i<$total; $i++) {
        
        $ceo =  $linha['ceo_rede'];
        $cnpj =  $linha['cnpj'];
        $empresa =  $linha['empresa'];
        $id = $linha['id_rede_social'];
        $nome =  $linha['nome'];      
        $plataforma = $linha['plataforma'];

        echo "<tr><td>$ceo</td><td>$cnpj</td><td>$empresa</td><td>$id</td><td>$nome</td><td>$plataforma</td></tr>";
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
    </>
        <form action='principalRedeSocial.php' method='get'>
            <h1 id='titulo'><strong>EXCLUSÃO DE REDE SOCIAL</strong></h1> <hr>
            
            <label for='id'>DIGITE O ID DA REDE:</label>
            <input type='text' name='id' id='id'> <br>
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
    $id = $_GET['id'];

    //Montando o SQL
    $sql = "DELETE FROM redesocial WHERE id_rede_social = $id";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $status = mysqli_query($conn,$sql);

    if($status) {
        echo "<br> Registro de ID: $id excluído. <br>";
    } else {
        echo "<br> Erro na exclusão. Verifique o ID inserido. <br>" ;

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
        <form action='principalRedeSocial.php' method='get'>
            <h1 id='titulo'><strong>ALTERAÇÃO DE REDE SOCIAL</strong></h1> <hr>
            
            <label for='id'>DIGITE O ID DA REDE:</label>
            <input type='text' name='id' id='id'> <br>
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
    $id = $_GET["id"];

    //Montando o SQL
    $sql = "SELECT * FROM redesocial WHERE $id=id_rede_social";

    //Estabelecendo a conexão
    $conn = conectar();

    //Aplicando o SQL na conexão
    $dados = mysqli_query($conn,$sql);
    $total = mysqli_num_rows($dados);

    if($total == 0) {
        echo "<br> Rede Social não encontrada <br>";
        echo "<button><a href='./telaInicial.html'>Voltar</a></button>";
        exit();
    }

    $linha = mysqli_fetch_array($dados); //Posiciona na primeira linha
 
    $ceo =  $linha['ceo_rede'];
    $cnpj =  $linha['cnpj'];
    $empresa =  $linha['empresa'];
    $nome =  $linha['nome'];      
    $plataforma = $linha['plataforma'];

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
        <form action='principalRedeSocial.php' method='get'>
            <h1 id='titulo'><strong>ALTERAÇÃO DE REDE SOCIAL</strong></h1> <hr>
            
            <p>PREENCHA OS DADOS</p> 

            <label for='id'>ID REDE SOCIAL</label>
            <input type='text' name='id' id='id' value='$id'> <br>
            <label for='nome'>NOME</label> 
            <input type='text' name='nome' id='nome' value='$nome'> <br>
            <label for='plataforma'>PLATAFORMA</label> 
            <input type='text' name='plataforma' id='plataforma' value='$plataforma'> <br>
            <label for='CNPJ'>CNPJ</label>
            <input type='text' name='CNPJ' id='CNPJ' value='$cnpj'> <br>
            <label for='CEO'>CEO</label>
            <input type='text' name='CEO' id='CEO' value='$ceo'> <br>
            <label for='empresa'>EMPRESA</label>
            <input type='text' name='empresa' id='empresa' value='$empresa'> <br>
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
    $id = $_GET['id'];
    $plataforma = $_GET['plataforma'];
    $nome = $_GET['nome'];
    $cnpj = $_GET['CNPJ'];
    $ceo = $_GET['CEO'];
    $empresa = $_GET['empresa'];

    //Montando o SQL
    $sql = "UPDATE redesocial SET plataforma='$plataforma', nome='$nome', cnpj='$cnpj', ceo_rede='$ceo', empresa='$empresa' WHERE id_rede_social=$id";

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