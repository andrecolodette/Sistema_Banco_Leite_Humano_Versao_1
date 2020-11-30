<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;

class ControllerConformidade
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;

    private $id, $descricao;

    /*Métods*/
    //Construtor
    public function __construct()
    {
        $this->crud = new ClassCrud();

        $this->validate = new ClassValidateCampos();
        $this->msgAlerta = new ClassMensagemAlerta();
    }

    //Receber Variaveis Form
    private function recVariableForm()
    {
        if(isset($_POST['formConformidadeId'])){
            $this->id = $_POST['formConformidadeId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST["formConformidadeDescricao"])){
            $this->descricao = filter_input(INPUT_POST,"formConformidadeDescricao",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->descricao = NULL;
        }
    }

    //Validar Variaveis
    private function validarCampos()
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(array($this->descricao))){
            $erro = "Preencha todos os campos!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }else{
            return TRUE;
        }
    }

    //Cadastrar
    public function cadastrar()
    {
        if($this->validarCampos()){
            $this->ativo = 1;
            if($this->crud->insertDB(
                "conformidade",
                "?,?",
                array(
                  $this->id,
                  $this->descricao
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
        if($this->validarCampos()){
            $this->ativo = 1;
            if($this->crud->updateDB(
                "conformidade",
                "descricao = ?",
                "id_conformidade = ?",
                array(
                  $this->descricao,
                  $this->id,
                ))){
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
        if($this->crud->deleteDB("Conformidade", "id_Conformidade = ?", array($ID))){
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
            "conformidade",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "conformidade",
            "WHERE id_conformidade = ?",
            array($ID));
    }
}
