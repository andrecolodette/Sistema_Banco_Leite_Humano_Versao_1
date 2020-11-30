<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;
use Src\Classes\ClassPassword;

class ControllerUsuario
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;
    private $password;

    private $id, $hashSenhaAtual, $hashSenhaNova, $hashSenhaConfirma;
    private $senhaAtual, $senhaNova, $senhaConfirma;

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
        if(isset($_POST['formUsuarioSenhaAtual'])){
            $this->senhaAtual = $_POST['formUsuarioSenhaAtual'];
            $this->hashSenhaAtual = $this->password->passwordHash($this->senhaAtual);
        }else{
            $this->hashSenhaAtual = NULL;
        }
        if(isset($_POST['formUsuarioSenhaNova'])){
            $this->senhaNova = $_POST['formUsuarioSenhaNova'];
            $this->hashSenhaNova = $this->password->passwordHash($this->senhaNova);
        }else{
            $this->hashSenhaNova = NULL;
        }
        if(isset($_POST['formUsuarioSenhaConfirme'])){
            $this->senhaConfirma = $_POST['formUsuarioSenhaConfirme'];
            $this->hashSenhaConfirma = $this->password->passwordHash($this->senhaConfirma);
        }else{
            $this->hashSenhaConfirma = NULL;
        }
    }

    //Validar Variaveis
    private function validarCampos()
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(array($this->senhaAtual, $this->senhaNova, $this->hashSenhaNova, $this->senhaConfirma))){
            $erro = "Preencha todos os campos!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMinimoTexto($this->senhaNova, 8)){
            $erro = "A nova senha deve ter mais de 8 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateConfSenha($this->senhaNova, $this->senhaConfirma)){
            $erro = "Nova Senha diferente da confirmação da senha!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }else{
            $session = new \Src\Classes\ClassSessions();
            $this->id = $session->getSessionId();
            $reg = $this->crud->selectDB(
              "*",
              "funcionario",
              "WHERE id_funcionario = ?",
              array($this->id));
              if($reg->rowCount() != 1){
                  $erro = "Usuário não registrado!";
                  $this->msgAlerta->setSucesso(FALSE);
                  $this->msgAlerta->setMensagem($erro);
                  return FALSE;
              }else{
                  foreach($reg as $usuario){
                      $hashSenhaRegistrada = $usuario['senha'];
                      if(!$this->password->verifyHash($this->senhaAtual, $hashSenhaRegistrada)){
                          $erro = "Senha ataual incorreta!";
                          $this->msgAlerta->setSucesso(FALSE);
                          $this->msgAlerta->setMensagem($erro);
                          return FALSE;
                      }else{
                          return TRUE;
                      }
                  }
              }
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
            if($this->crud->updateDB(
                "funcionario",
                "senha = ?",
                "id_funcionario = ?",
                array(
                  $this->hashSenhaNova,
                  $this->id))){

                $msg = "Senha atualizada!";
                $this->msgAlerta->setSucesso(TRUE);
                $this->msgAlerta->setMensagem($msg);
            }else{
                $erro = "Falha na atualizaçã!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

}
