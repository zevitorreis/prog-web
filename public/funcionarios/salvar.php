<?php

require_once(__DIR__ . '/../../templates/template-html.php');

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Funcionario.php');
require_once(__DIR__ . '/../../dao/DaoFuncionario.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoFuncionario = new DaoFuncionario($conn);
$daoFuncionario->inserir( new Funcionario($_POST['nome','cpf','telefone','endereco','email']));
    
header('Location: ./index.php');

?>