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

if (isset($_POST['id']) && isset($_POST['confirmacao'])) {
    $funcionario = $daoFuncionario->porId( $_POST['id'] );
    $daoFuncionario->remover( $funcionario );
    header('Location: ./index.php');
    exit;
  }

$funcionario = $daoFuncionario->porId( $_GET['id'] );
if (! $funcionario )
    header('Location: ./index.php');
else {  
    ob_start();
?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Apagar Funcionario</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="apagar.php" class="card p-2 my-4" method="POST">
                <input type="hidden" name="id" 
                  value="<?php echo $funcionario->getId(); ?>"
                >
                <div class="form-group">
                  <label for="funcionario">Deseja realmente apagar o funcionario abaixo?</label>
                  <input type="text" class="form-control" id="funcionario" aria-describedby="help" 
                    value="<?php echo $funcionario->getNome();?>" 
                    readonly
                  >
                  <small id="help" class="form-text text-muted">Esta operação não poderá ser desfeita.</small>
                </div>
                <div class="form-row">
                  <input type="submit" class="btn btn-danger ml-1" value="Apagar" name="confirmacao"/>
                  <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                </div>
              </form>

            </div>
        </div>
    </div>
<?php
    $content = ob_get_clean();
    echo html( $content );
}