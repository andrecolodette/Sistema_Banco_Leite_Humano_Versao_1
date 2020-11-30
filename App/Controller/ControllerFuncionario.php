<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(true);

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;
use Src\Classes\ClassPassword;

class ControllerFuncionario
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;
    private $password;

    private $id, $nome, $usuario, $hashSenha, $hashSenhaConfirm, $administrador, $ativo;
    private $senha, $senhaConfirma;

    /*Métods*/
    //Construtor
    public function __construct()
    {
        $this->crud = new ClassCrud();

        $this->validate = new ClassValidateCampos();
        $this->msgAlerta = new ClassMensagemAlerta();

        $this->password = new ClassPassword();
    }

    //Receber Variaveis Form
    private function recVariableForm()
    {
        if(isset($_POST['formFuncionarioId'])){
            $this->id = $_POST['formFuncionarioId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST["formFuncionarioNome"])){
            $this->nome = filter_input(INPUT_POST,"formFuncionarioNome",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->nome = NULL;
        }
        if(isset($_POST["formFuncionarioUsuario"])){
            $this->usuario = filter_input(INPUT_POST,"formFuncionarioUsuario",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->usuario = NULL;
        }
        if(isset($_POST['formFuncionarioSenha'])){
            $this->senha = $_POST['formFuncionarioSenha'];
            $this->hashSenha = $this->password->passwordHash($this->senha);
        }else{
            $this->hashSenha = NULL;
        }
        if(isset($_POST['formFuncionarioSenhaConfirme'])){
            $this->senhaConfirma = $_POST['formFuncionarioSenhaConfirme'];
            $this->hashSenhaConfirm = $this->password->passwordHash($this->senhaConfirma);
        }else{
            $this->hashSenhaConfirm = NULL;
        }
        if(isset($_POST['formFuncionarioAdministrador'])){
            $this->administrador = 1;
        }else{
            $this->administrador = 0;
        }
        if(isset($_POST['formFuncionarioAtivo'])){
            $this->ativo = 1;
        }else{
            $this->ativo = 0;
        }
    }

    //Validar Variaveis
    private function validarCampos($atualizar = FALSE)
    {
        $this->recVariableForm();

        if(!$atualizar){
            if(!$this->validate->validateFields(array($this->nome, $this->usuario, $this->hashSenha, $this->hashSenhaConfirm))){
                $erro = "Preencha todos os campos!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }elseif(!$this->validate->validateTamanhoMinimoTexto($this->senha, 8)){
                $erro = "A senha deve ter mais de 8 caracteres!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }elseif(!$this->validate->validateConfSenha($this->senha, $this->senhaConfirma)){
                $erro = "Senha diferente da confirmação da senha!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }
            $reg = $this->crud->selectDB("*","funcionario", "WHERE usuario = ?", array($this->usuario));
            if(($reg->rowCount()) > 0){
                $erro = "Já há um funcionario registrado com esse usuário!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }else{
                return TRUE;
            }
        }else{
            return TRUE;
        }

    }

    //Cadastrar
    public function cadastrar()
    {
        if($this->validarCampos(FALSE)){
            $this->ativo = 1;
            if($this->crud->insertDB(
                "funcionario",
                "?,?,?,?,?,?",
                array(
                  $this->id,
                  $this->nome,
                  $this->usuario,
                  $this->hashSenha,
                  $this->administrador,
                  $this->ativo
                ))){
                  $msg = "Cadastro Realizado!";
                  $this->msgAlerta->setSucesso(TRUE);
                  $this->msgAlerta->setMensagem($msg);
            }else{
                $erro = "Falha ao cadastrar no Banco de Dados!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Atualizar
    public function atualizar()
    {
        if($this->validarCampos(TRUE)){
            $session = new \Src\Classes\ClassSessions();
            $idUsuario = $session->getSessionId();

            if($this->id == $idUsuario){
                $erro = "Não é permitido alterar suas próprias definições!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }elseif($this->crud->updateDB(
                "funcionario",
                "administrador = ?, ativo = ?",
                "id_funcionario = ?",
                array(
                  $this->administrador,
                  $this->ativo,
                  $this->id))){

                $msg = "Sucesso na Atualização!";
                $this->msgAlerta->setSucesso(TRUE);
                $this->msgAlerta->setMensagem($msg);
            }else{
                $erro = "Falha na atualização!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Excluir
    /*
    public function excluir($ID)
    {
        if($this->crud->deleteDB("funcionario", "id_funcionario = ?", array($ID))){
            $msg = "Sucesso ao Excluir!";
            $this->msgAlerta->setSucesso(TRUE);
            $this->msgAlerta->setMensagem($msg);
        }else{
            $erro = "Falha ao excluir!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
        }

        $this->msgAlerta->validateFinalMensagem();
    }
    */

    //Listar
    public function listar()
    {
        return $this->crud->selectDB(
            "*",
            "funcionario",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "funcionario",
            "WHERE id_funcionario = ?",
            array($ID));
    }
}
