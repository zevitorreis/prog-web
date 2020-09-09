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
$funcionario = $daoFuncionario->porId( $_POST['id'] );
    
if ( $funcionario )
{  
  $funcionario->setNome( $_POST['nome'] );
  $funcionario->setCpf( $_POST['cpf'] );
  $funcionario->setTelefone( $_POST['telefone'] );
  $funcionario->setEmail( $_POST['email'] );
  $funcionario->setEndereco( $_POST['endereco'] );
  $daoFuncionario->atualizar( $funcionario );
}

header('Location: ./index.php');