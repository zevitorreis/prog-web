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
$funcionario = $daoFuncionario->porId( $_GET['id'] );

if (! $funcionario )
    header('Location: ./index.php');

else {  
    ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Funcionarios</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="atualizar.php" class="card p-2 my-4" method="POST">
                  <div class="input-group">
                      <input type="hidden" name="id" 
                          value="<?php echo $funcionario->getId(); ?>">                      
                      <input type="text" placeholder="Nome do Funcionario" 
                          value="<?php echo $funcionario->getNome(); ?>"
                          class="form-control" name="nome" required>
                      <input type="number" placeholder="CPF" 
                          value="<?php echo $funcionario->getCpf(); ?>"
                          class="form-control" name="cpf" required>
                      <input type="text" placeholder="Telefone" 
                          value="<?php echo $funcionario->getTelefone(); ?>"
                          class="form-control" name="telefone" required>
                      <input type="text" placeholder="Endereco" 
                          value="<?php echo $funcionario->getEndereco(); ?>"
                          class="form-control" name="endereco" required>
                      <input type="text" placeholder="Email" 
                          value="<?php echo $funcionario->getEmail(); ?>"
                          class="form-control" name="email" required>
                      <div class="input-group-append">
                          <button type="submit" class="btn btn-primary">
                              Salvar
                          </button>
                      </div>
                  </div>
              </form>
              <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>

            </div>
        </div>
    </div>
<?php

    $content = ob_get_clean();
    echo html( $content );
} // else-if

?>