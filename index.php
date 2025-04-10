<?php

//configurar a conexao com o banco de dados

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "exemplo_bd";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if($conexao->connect_error)
{
    die("Erro de conexão: ".$conexao->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nome = $_POST["nome"];
    $idade = (int)$_POST["idade"];
    $email = $_POST["email"];
}

$sql = "INSERT INTO USUARIO (NOME, IDADE, EMAIL) VALUES (?, ?, ?)";
$stm = $conexao->prepare($sql);
$stm->bind_param("sis", $nome, $idade, $email);

if($stm->execute())
{
    echo "Dados inseridos com sucesso!";

} else {
    echo "Erro ao inserir".$stm->error;
}

$stm->close();

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
    <h2>Aplicação com Banco de Dados</h2>
    <h4>Cadastre-se</h4>
    <form method="POST">
        <label for="">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Seu nome aqui" required>
        <br>
        <label for="">Idade</label>
        <input type="number" name="idade" id="idade" placeholder="Sua idade aqui" required>
        <br>
        <label for="">Email</label>
        <input type="email" id="email" name="email" placeholder="Seu email aqui" required>
        <br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>