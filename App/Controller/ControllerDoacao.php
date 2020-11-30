<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;

class ControllerDoacao
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;

    private $id, $doadora, $data_doacao, $volume, $acidez, $media_sc, $media_c, $caloria, $aprovada;
    private $nao_conformidade = array();

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
        if(isset($_POST['formDoacaoId'])){
            $this->id = $_POST['formDoacaoId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST['formDoacaoDoadora'])){
            $this->doadora = $_POST['formDoacaoDoadora'];
        }else{
            $this->doadora = NULL;
        }
        if(isset($_POST['formDoacaoData'])){
            $this->data_doacao = $_POST['formDoacaoData'];
        }else{
            $this->data_doacao = NULL;
        }
        if(isset($_POST['formDoacaoVolume'])){
            $this->volume = $_POST['formDoacaoVolume'];
        }else{
            $this->volume = NULL;
        }
        if(isset($_POST['formDoacaoAcidez'])){
            $this->acidez = $_POST['formDoacaoAcidez'];
        }else{
            $this->acidez = 0;
        }
        if(isset($_POST['formDoacaoMediaSC'])){
            $this->media_sc = $_POST['formDoacaoMediaSC'];
        }else{
            $this->media_sc = 0;
        }
        if(isset($_POST['formDoacaoMediaC'])){
            $this->media_c = $_POST['formDoacaoMediaC'];
        }else{
            $this->media_c = 0;
        }
        if(isset($_POST['formDoacaoCaloria'])){
            $this->caloria = $_POST['formDoacaoCaloria'];
        }else{
            $this->caloria = 0;
        }
        if(isset($_POST['formDoacaoAprovada'])){
            $this->aprovada = $_POST['formDoacaoAprovada'];
        }else{
            $this->aprovada = 'A';
        }

        if(isset($_POST['formDoacaoNaoConformidade'])){
            $this->nao_conformidade = $_POST['formDoacaoNaoConformidade'];
        }else{
            $this->nao_conformidade = array();
        }

    }

    //Validar Variaveis
    private function validarCampos()
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(
            array(
              $this->doadora,
              $this->data_doacao,
              $this->volume,
              $this->aprovada,
              )))
        {
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

            $id_doacao_DB = $this->crud->insertDB_returnID(
                "doacao",
                "?,?,?,?,?,?,?,?,?",
                array(
                  $this->id,
                  $this->doadora,
                  $this->data_doacao,
                  $this->volume,
                  $this->acidez,
                  $this->media_sc,
                  $this->media_c,
                  $this->caloria,
                  $this->aprovada
                )
              );

              if(!$id_doacao_DB > 0){
                  $erro = "Falha ao cadastrar a doação no Banco de Dados!";
                  $this->msgAlerta->setSucesso(FALSE);
                  $this->msgAlerta->setMensagem($erro);
              }else{
                  $msg = "Cadastro da Doação Realizado!";
                  $this->msgAlerta->setMensagem($msg);
                  $msg = "ID da Nova Doação: ".$id_doacao_DB;
                  $this->msgAlerta->setMensagem($msg);
                  $this->msgAlerta->setSucesso(TRUE);

                  $this->msgAlerta->setExtra(array('id_doacao' => $id_doacao_DB));

                  //$url = DIRPAGE."doacao/atualizar/".$id_doacao_DB;
                  //$this->msgAlerta->setUrl($url);

                  if($this->aprovada == "N"){
                      //A doação foi reprovada e portantem tem uma não conformidade
                      $conform = 0;
                      foreach($this->nao_conformidade as $n_conf){
                          if($this->crud->insertDB(
                              "nao_conformidade",
                              "?,?,?",
                              array(
                                0,
                                $id_doacao_DB,
                                $n_conf
                              )
                          )){
                              $conform++;
                          }
                      }
                      $qtd_conform = count($this->nao_conformidade);
                      if($conform == $qtd_conform){
                          $msg = "Não-Conformidades foram Cadastradas!";
                          $this->msgAlerta->setSucesso(TRUE);
                          $this->msgAlerta->setMensagem($msg);
                      }else{
                          $msg = "Erro ao cadastrar as Não-Conformidadess!";
                          $this->msgAlerta->setSucesso(TRUE);
                          $this->msgAlerta->setMensagem($msg);
                      }
                  }

              }


        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Atualizar
    public function atualizar()
    {

        if($this->validarCampos()){

            if($this->crud->updateDB(
                "doacao",
                "doadora_id = ?, data_doacao = ?, volume = ?,
                ac_dornic_media = ?, media_s_c = ?, media_c = ?, caloria = ?,
                aprovado = ?",
                "id_doacao = ?",
                array(
                  $this->doadora,
                  $this->data_doacao,
                  $this->volume,
                  $this->acidez,
                  $this->media_sc,
                  $this->media_c,
                  $this->caloria,
                  $this->aprovada,
                  $this->id,
                )
            )){
                $msg = "Sucesso na Atualização da Doação!";
                $this->msgAlerta->setSucesso(TRUE);
                $this->msgAlerta->setMensagem($msg);
            }else{
                $erro = "Falha na atualização da Doação!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }

            #Atualizar as Não-Conformidades
            ##Excluir toadas as Não-Conformidades daquela Doação primeiro
            if($this->crud->deleteDB(
              "nao_conformidade",
              "doacao_id = ?",
              array($this->id)
            )){
                if($this->aprovada == "N"){
                    //A doação foi reprovada e portantem tem uma não conformidade
                    $conform = 0;
                    foreach($this->nao_conformidade as $n_conf){
                        if($this->crud->insertDB(
                            "nao_conformidade",
                            "?,?,?",
                            array(
                              0,
                              $this->id,
                              $n_conf
                            )
                        )){
                            $conform++;
                        }
                    }
                    $qtd_conform = count($this->nao_conformidade);
                    if($conform == $qtd_conform){
                        $msg = "Não-Conformidades Atualizadas!";
                        $this->msgAlerta->setSucesso(TRUE);
                        $this->msgAlerta->setMensagem($msg);
                    }else{
                        $msg = "Erro! na Atualização das Não-Conformidades!";
                        $this->msgAlerta->setSucesso(FALSE);
                        $this->msgAlerta->setMensagem($msg);
                    }
                }
            }else{
                #Não-conformidades não foram excluidas
                $msg = "Erro na Atualização das Não-Conformidades!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($msg);
            }

        }
        $this->msgAlerta->validateFinalMensagem();
    }

    //Excluir
    /*
    public function excluir($ID)
    {
        if($this->crud->deleteDB("Doacao", "id_Doacao = ?", array($ID))){
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
            "Doacao",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "Doacao",
            "WHERE id_Doacao = ?",
            array($ID));
    }
}
