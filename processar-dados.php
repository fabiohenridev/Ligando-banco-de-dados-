<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];
$data_atual = date('d/m/Y');
$hora_atual = date('H:i:s');

$conn = new mysqli('localhost', 'root', '', 'aula_formulario');

if($conn->connect_error){
    die("falha ao se conectar com banco de dados: ".$conn->connect_error);
}

$smtp = $conn->prepare("INSERT INTO mensagens(nome, email, mensagem, data, hora) VALUES(?,?,?,?,?)");
$smtp->bind_param("sssss", $nome, $email, $mensagem, $data_atual, $hora_atual );

if($smtp->execute()){
    echo "mensagem enviada com sucesso";
}else{
    echo "erro no envio da mensagem".$smtp->error;
}

$smtp->close();
$conn->close();

?>