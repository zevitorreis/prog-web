<?php 
require_once(__DIR__ . '/../model/Funcionario.php');
require_once(__DIR__ . '/../db/Db.php');

class DaoFuncionario{
    private $connection;

    public function __construct(Db $connection) {
        $this->connection = $connection;
    }

    public function porId(int $id): ?Funcionario {
        $sql = "SELECT nome, cpf,
                        telefone, endereco,
                        email FROM funcionarios where id = ?";
        $stmt = $this->connection->prepare($sql);
        $dep = null;
        if ($stmt) {
          $stmt->bind_param('i',$id);
          if ($stmt->execute()) {
            $nome = ''; $cpf = 0; $telefone = ''; $endereco = ''; $email = '';
            $stmt->bind_result($nome,$cpf,$telefone,$endereco,$email);
            $stmt->store_result();
            if ($stmt->num_rows == 1 && $stmt->fetch()) {
              $dep = new Funcionario($nome,$cpf,$telefone,$endereco,$email,$id);
            }
          }
          $stmt->close();
        }
        return $dep;
      }

    public function inserir(Funcionario $funcionario): bool {
    $sql = "INSERT INTO funcionarios (nome,cpf,telefone,endereco,email) VALUES(?,?,?,?,?)";
    $stmt = $this->connection->prepare($sql);
    $res = false;
    if ($stmt) {
        $nome = $funcionario->getNome();
        $cpf = $funcionario->getCpf();
        $telefone = $funcionario->getTelefone();
        $endereco = $funcionario->getEndereco();
        $email = $funcionario->getEmail();
        $stmt->bind_param('sisss', $nome,$cpf,$telefone,$endereco,$email);
        if ($stmt->execute()) {
            $id = $this->connection->getLastID();
            $funcionario->setId($id);
            $res = true;
        }
        $stmt->close();
    }
    return $res;
    }

    public function remover(Funcionario $funcionario): bool {
        $sql = "DELETE FROM funcionarios where id=?";
        $id = $funcionario->getId(); 
        $stmt = $this->connection->prepare($sql);
        $ret = false;
        if ($stmt) {
          $stmt->bind_param('i',$id);
          $ret = $stmt->execute();
          $stmt->close();
        }
        return $ret;
    }

    public function atualizar(Funcionario $funcionario): bool {
        $sql = "UPDATE funcionarios SET nome = ?, cpf = ?, telefone = ?, endereco = ?, email = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $ret = false;      
        if ($stmt) {
            $nome = $funcionario->getNome();
            $cpf = $funcionario->getCpf();
            $telefone = $funcionario->getTelefone();
            $endereco = $funcionario->getEndereco();
            $email = $funcionario->getEmail();
            $id   = $funcionario->getId();
            $stmt->bind_param('sisssi', $nome,$cpf,$telefone,$endereco,$email,$id);
            $ret = $stmt->execute();
            $stmt->close();
        }
        return $ret;
    }

    public function todos(): array {
        $sql = "SELECT id, nome, cpf, telefone, endereco, email from funcionarios";
        $stmt = $this->connection->prepare($sql);
        $marcas = [];
        if ($stmt) {
          if ($stmt->execute()) {
            $id = 0; $nome = ''; $cpf = 0; $telefone = ''; $endereco = ''; $email = '';
            $stmt->bind_result($id, $nome, $cpf, $telefone, $endereco, $email);
            $stmt->store_result();
            while($stmt->fetch()) {
              $funcionarios[] = new Funcionario($nome, $cpf, $telefone, $endereco, $email, $id);
            }
          }
          $stmt->close();
        }
        return $funcionarios;
    }
};