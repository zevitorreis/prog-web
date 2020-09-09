<?php

class Funcionario{

    $private $id;
    $private $nome;
    $private $cpf;
    $private $telefone;
    $private $email;
    $private $endereco;
    
    function __construct(int $id=-1, string $nome='', int $cpf=0, string $telefone='', string $email='', string $endereco='' ){
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->endereco = $endereco;
    }

    function setId(int $id){
        $this->id = $id;
    }
    function getId(){
        return $this->id;
    }

    function setNome(string $nome){
        $this->nome = $nome;
    }
    function getNome(){
        return $this->nome;
    }

    function setCpf(int $cpf){
        $this->cpf = $cpf;
    }
    function getCpf(){
        return $this->cpf;
    }

    function setTelefone(string $telefone){
        $this->telefone = $telefone;
    }
    function getTelefone(){
        return $this->telefone;
    }

    function setEmail(string $email){
        $this->email = $email;
    }
    function getEmail(){
        return $this->email;
    }

    function setEndereco(string $endereco){
        $this->endereco = $endereco;
    }
    function getEndereco(){
        return $this->endereco;
    }
}