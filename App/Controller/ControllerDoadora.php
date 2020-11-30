<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;

class ControllerDoadora
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;

    private $id, $nome, $rg, $cpf, $cartao_sus, $data_nasc;
    private $celular, $estado, $cidade, $bairro, $cep, $endereco;
    private $data_registro, $status_doando;

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
        if(isset($_POST['formDoadoraId'])){
            $this->id = $_POST['formDoadoraId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST["formDoadoraNome"])){
            $this->nome = filter_input(INPUT_POST,"formDoadoraNome",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->nome = NULL;
        }
        if(isset($_POST["formDoadoraRg"])){
            $this->rg = filter_input(INPUT_POST,"formDoadoraRg",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->rg = preg_replace('/[^0-9]/', '', (string) $this->rg);
        }else{
            $this->rg = NULL;
        }
        if(isset($_POST["formDoadoraCpf"])){
            $this->cpf = filter_input(INPUT_POST,"formDoadoraCpf",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->cpf = preg_replace('/[^0-9]/', '', (string) $this->cpf);
        }else{
            $this->cpf = NULL;
        }
        if(isset($_POST["formDoadoraCartaoSus"])){
            $this->cartao_sus = filter_input(INPUT_POST,"formDoadoraCartaoSus",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->cartao_sus = preg_replace('/[^0-9]/', '', (string) $this->cartao_sus);
        }else{
            $this->cartao_sus = NULL;
        }
        if(isset($_POST["formDoadoraNascimento"])){
            $this->data_nasc = $_POST["formDoadoraNascimento"];
        }else{
            $this->data_nasc = NULL;
        }
        if(isset($_POST["formDoadoraCelular"])){
            $this->celular = filter_input(INPUT_POST,"formDoadoraCelular",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->celular = preg_replace('/[^0-9]/', '', (string) $this->celular);
        }else{
            $this->celular = NULL;
        }
        if(isset($_POST["formDoadoraEstado"])){
            $this->estado = filter_input(INPUT_POST,"formDoadoraEstado",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->estado = NULL;
        }
        if(isset($_POST["formDoadoraCidade"])){
            $this->cidade = filter_input(INPUT_POST,"formDoadoraCidade",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->cidade = NULL;
        }
        if(isset($_POST["formDoadoraBairro"])){
            $this->bairro = filter_input(INPUT_POST,"formDoadoraBairro",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->bairro = NULL;
        }
        if(isset($_POST["formDoadoraCep"])){
            $this->cep = filter_input(INPUT_POST,"formDoadoraCep",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->cep = preg_replace('/[^0-9]/', '', (string) $this->cep);
        }else{
            $this->cep = NULL;
        }
        if(isset($_POST["formDoadoraEndereco"])){
            $this->endereco = filter_input(INPUT_POST,"formDoadoraEndereco",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->endereco = NULL;
        }

        if(isset($_POST['formDoadoraStatus'])){
            $this->status_doando = $_POST['formDoadoraStatus'];
        }else{
            $this->status_doando = "N";
        }

    }

    //Validar Variaveis
    private function validarCampos($atualizar = FALSE)
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(
            array(
                //$this->id,
                $this->nome,
                $this->rg,
                $this->cpf,
                $this->cartao_sus,
                $this->data_nasc,
                $this->celular,
                $this->estado,
                $this->cidade,
                $this->bairro,
                $this->cep,
                $this->endereco,
                //$this->data_registro,
                //$this->status_doando,
        ))){
            $erro = "Preencha todos os campos!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateCpf($this->cpf)){
            $erro = "CPF inválido!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }

        if(!$atualizar){
            $reg = $this->crud->selectDB("*", "doadora", "WHERE cpf = ?", array($this->cpf));
            if(($reg->rowCount()) > 0){
                $erro = "CPF já está cadastrado!";
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
        $this->data_registro = date("Y-m-d");
        $this->status_doando = "N";

        if($this->validarCampos(FALSE)){

            $id_cadastrado = $this->crud->insertDB_returnID(
                "doadora",
                "?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                array(
                  $this->id,
                  $this->nome,
                  $this->rg,
                  $this->cpf,
                  $this->cartao_sus,
                  $this->data_nasc,
                  $this->celular,
                  $this->estado,
                  $this->cidade,
                  $this->bairro,
                  $this->cep,
                  $this->endereco,
                  $this->data_registro,
                  $this->status_doando,
                )
              );
              if($id_cadastrado <= 0){
                  //Erro no cadastro
                  $erro = "Falha ao cadastrar no Banco de Dados!";
                  $this->msgAlerta->setSucesso(FALSE);
                  $this->msgAlerta->setMensagem($erro);
              }elseif($id_cadastrado > 0){
                  $msg = "Cadastro Realizado!";
                  $this->msgAlerta->setSucesso(TRUE);
                  $this->msgAlerta->setMensagem($msg);
                  $url = DIRPAGE."gestacao/cadastro/".$id_cadastrado;
                  $this->msgAlerta->setURL($url);
              }else{
                  $msg = "Cadastro Realizado - Mas sem retorno!";
                  $this->msgAlerta->setSucesso(TRUE);
                  $this->msgAlerta->setMensagem($msg);
              }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Atualizar
    public function atualizar()
    {

        if($this->validarCampos(TRUE)){

            $reg = $this->buscar($this->id);
            foreach($reg as $doadora){
              $this->data_registro = $doadora['data_registro'];
              //$this->status_doando = $doadora['status_doando'];
            }

            if($this->crud->updateDB(
                "doadora",
                "nome = ?, rg = ?, cpf = ?, cartao_sus = ?, data_nasc = ?,
                celular = ?, estado = ?, cidade = ?, bairro = ?, cep = ?,
                endereco = ?, data_registro = ?, status_doando = ?",
                "id_doadora = ?",
                array(
                  $this->nome,
                  $this->rg,
                  $this->cpf,
                  $this->cartao_sus,
                  $this->data_nasc,
                  $this->celular,
                  $this->estado,
                  $this->cidade,
                  $this->bairro,
                  $this->cep,
                  $this->endereco,
                  $this->data_registro,
                  $this->status_doando,
                  $this->id,
                )))
            {
                $msg = "Sucesso na Atualização!";
                $this->msgAlerta->setSucesso(TRUE);
                $this->msgAlerta->setMensagem($msg);
            }else{
                $erro = "Falha na atualização no Banco de Dados!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }

        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Excluir
    public function excluir($ID)
    {
        $this->msgAlerta->validateFinalMensagem();
    }

    //Listar
    public function listar()
    {
        return $this->crud->selectDB(
            "*",
            "doadora",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "doadora",
            "WHERE id_doadora = ?",
            array($ID));
    }
}
