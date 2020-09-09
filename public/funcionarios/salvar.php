<?php

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Funcionario.php');
require_once(__DIR__ . '/../../dao/DaoFuncionario.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoFuncionario = new DaoFuncionario($conn);
$daoFuncionario->inserir( new Funcionario($_POST['nome'],$_POST['cpf'],$_POST['telefone'],$_POST['email'], $_POST['endereco']));
    
header('Location: ./index.php');

?>