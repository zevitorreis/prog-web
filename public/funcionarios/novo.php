<?php

require_once(__DIR__ . '/../../templates/template-html.php');
ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Funcionarios</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="salvar.php" class="card p-2 my-4" method="POST">
              
              <div class="form-group">
                        <label for="nome">Nome do Funcionario</label>
                        <input type="text" class="form-control" id="nome"
                            name="nome" placeholder="Funcionario" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control"id="preco" 
                                name="cpf" placeholder="CPF" required>
                        </div>                            
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" 
                                name="telefone" placeholder="Telefone" required>
                        </div>
						<div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" id="email" 
                                name="email" placeholder="Email" required>
                        </div>
						<div class="form-group col-md-6">
                            <label for="endereco">Endereco</label>
                            <input type="text" class="form-control" id="endereco" 
                                name="endereco" placeholder="Endereco" required>
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
    
?>