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
$funcionarios = $daoFuncionario->todos();

ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Funcionarios</h2>
        </div>
        <div class="row mb-2">
            <div class="col-md-12" >
                <a href="novo.php" class="btn btn-primary active" role="button" aria-pressed="true">Novo Funcionario</a>
            </div>
        </div>

<?php 
    if (count($funcionarios) >0) 
    {
?>
        <div class="row">
            <div class="col-md-12" >

                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
<?php 
        foreach($funcionarios as $d) {
?>                    
                    <tr>
                        <th scope="row"><?php echo  $d->getId(); ?></th>
                        <td><?php echo $d->getNome(); ?></td>
                        <td><?php echo $d->getCpf(); ?></td>
                        <td><?php echo $d->getTelefone(); ?></td>
                        <td><?php echo $d->getEmail(); ?></td>
                        <td><?php echo $d->getEndereco(); ?></td>
                        <td>
                            <a class="btn btn-danger btn-sm active" 
                                href="apagar.php?id=<?php echo $d->getId();?>">
                                Apagar
                            </a>
                            <a class="btn btn-secondary btn-sm active" 
                                href="editar.php?id=<?php echo $d->getId();?>">
                                Editar
                            </a>                        
                        </td>
                    </tr>
<?php
        } // foreach
?>                    
                </tbody>
                </table>

            </div>
        </div>
<?php 
    
    }  // if 
?>        
    </div>
<?php

$content = ob_get_clean();
echo html( $content );
    
?>