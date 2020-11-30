<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;

class ControllerGestacao
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;

    private $id, $id_doadora, $loc_pre_natal, $num_consultas;
    private $peso_inicio, $peso_final, $data_parto, $loc_parto;
    private $vdrl, $hbsag, $hb, $ht, $transfusao, $tabagismo;
    private $etilismo, $drogas, $medicamentos, $intercorrencias;
    private $tratamentos, $obs, $aprovada;

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
        if(isset($_POST['formGestacaoDoadoraID'])){
            $this->id_doadora = $_POST['formGestacaoDoadoraID'];
        }else{
            $this->id_doadora = NULL;
        }
        if(isset($_POST['formGestacaoId'])){
            $this->id = $_POST['formGestacaoId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST["formGestacaoLocPreNatal"])){
            $this->loc_pre_natal = filter_input(INPUT_POST,"formGestacaoLocPreNatal",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->loc_pre_natal = NULL;
        }
        if(isset($_POST["formGestacaoLocParto"])){
            $this->loc_parto = filter_input(INPUT_POST,"formGestacaoLocParto",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->loc_parto = NULL;
        }
        if(isset($_POST["formGestacaoNumConsulta"])){
            $this->num_consultas = filter_input(INPUT_POST,"formGestacaoNumConsulta",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->num_consultas = NULL;
        }
        if(isset($_POST["formGestacaoPesoInicio"])){
            $this->peso_inicio = filter_input(INPUT_POST,"formGestacaoPesoInicio",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->peso_inicio = NULL;
        }
        if(isset($_POST["formGestacaoPesoFinal"])){
            $this->peso_final = $_POST["formGestacaoPesoFinal"];
        }else{
            $this->peso_final = NULL;
        }
        if(isset($_POST["formGestacaoDataParto"])){
            $this->data_parto = filter_input(INPUT_POST,"formGestacaoDataParto",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->data_parto = NULL;
        }
        if(isset($_POST["formGestacaoHB"])){
            $this->hb = filter_input(INPUT_POST,"formGestacaoHB",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->hb = NULL;
        }
        if(isset($_POST["formGestacaoHT"])){
            $this->ht = filter_input(INPUT_POST,"formGestacaoHT",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->ht = NULL;
        }
        if(isset($_POST["formGestacaoVDRL"])){
            $this->vdrl = filter_input(INPUT_POST,"formGestacaoVDRL",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->vdrl = NULL;
        }
        if(isset($_POST["formGestacaoHBSAG"])){
            $this->hbsag = filter_input(INPUT_POST,"formGestacaoHBSAG",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->hbsag = NULL;
        }
        if(isset($_POST["formGestacaoTransfusao"])){
            $this->transfusao = filter_input(INPUT_POST,"formGestacaoTransfusao",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->transfusao = NULL;
        }
        if(isset($_POST["formGestacaoTabagismo"])){
            $this->tabagismo = filter_input(INPUT_POST,"formGestacaoTabagismo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->tabagismo = NULL;
        }
        if(isset($_POST["formGestacaoEtilismo"])){
            $this->etilismo = filter_input(INPUT_POST,"formGestacaoEtilismo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->etilismo = NULL;
        }
        if(isset($_POST["formGestacaoDroga"])){
            $this->drogas = filter_input(INPUT_POST,"formGestacaoDroga",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->drogas = NULL;
        }
        if(isset($_POST["formGestacaoMedicamento"])){
            $this->medicamentos = filter_input(INPUT_POST,"formGestacaoMedicamento",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->medicamentos = NULL;
        }
        if(isset($_POST["formGestacaoIntercorrencia"])){
            $this->intercorrencias = filter_input(INPUT_POST,"formGestacaoIntercorrencia",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->intercorrencias = NULL;
        }
        if(isset($_POST["formGestacaoTratamento"])){
            $this->tratamentos = filter_input(INPUT_POST,"formGestacaoTratamento",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->tratamentos = NULL;
        }
        if(isset($_POST["formGestacaoObservacao"])){
            $this->obs = filter_input(INPUT_POST,"formGestacaoObservacao",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->obs = NULL;
        }
        if(isset($_POST["formGestacaoAprovada"])){
            $this->aprovada = $_POST["formGestacaoAprovada"];
        }else{
            $this->aprovada = NULL;
        }

    }

    //Validar Variaveis
    private function validarCampos()
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(
            array(
                /*$this->id,*/
                $this->id_doadora,
                $this->loc_pre_natal,
                $this->num_consultas,
                $this->peso_inicio,
                $this->peso_final,
                $this->data_parto,
                $this->loc_parto,
                $this->vdrl,
                $this->hbsag,
                $this->hb,
                $this->ht,
                $this->transfusao,
                $this->tabagismo,
                $this->etilismo,
                $this->drogas,
                $this->medicamentos,
                $this->intercorrencias,
                $this->tratamentos,
                $this->obs,
                $this->aprovada
        ))){
            $erro = "Preencha todos os campos!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->loc_pre_natal, 100)){
            $erro = "ERRO! Local do pré natal tem mais de 100 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->loc_parto, 100)){
            $erro = "ERRO! Local do parto tem mais de 100 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->etilismo, 100)){
            $erro = "ERRO! Etilismo tem mais de 200 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->drogas, 200)){
            $erro = "ERRO! Drogas tem mais de 200 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->intercorrencias, 100)){
            $erro = "ERRO! Intercorrencias tem mais de 100 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->tratamentos, 100)){
            $erro = "ERRO! Tratamentos tem mais de 100 caracteres!";
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

            if($this->crud->insertDB(
                "gestacao",
                "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                array(
                  $this->id,
                  $this->id_doadora,
                  $this->loc_pre_natal,
                  $this->num_consultas,
                  $this->peso_inicio,
                  $this->peso_final,
                  $this->data_parto,
                  $this->loc_parto,
                  $this->vdrl,
                  $this->hbsag,
                  $this->hb,
                  $this->ht,
                  $this->transfusao,
                  $this->tabagismo,
                  $this->etilismo,
                  $this->drogas,
                  $this->medicamentos,
                  $this->intercorrencias,
                  $this->tratamentos,
                  $this->obs,
                  $this->aprovada
                )))
            {
                $msg = "Cadastro Realizado!";
                $this->msgAlerta->setSucesso(TRUE);
                $this->msgAlerta->setMensagem($msg);
                $url = DIRPAGE."doadora/visualizar/$this->id_doadora";
                $this->msgAlerta->setURL($url);
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

            if($this->crud->updateDB(
                "gestacao",
                "doadora_id = ?, loc_pre_natal = ?, num_consultas = ?,
                peso_gest_inicio = ?, peso_gest_final = ?, data_parto = ?,
                loc_parto = ?, pre_natal_vdrl = ?, pre_natal_hbsag = ?,
                pre_natal_hb = ?, pre_natal_ht = ?, transf_sang_5_anos = ?,
                tabagismo = ?, etilismo = ?, drogas = ?, medicamentos_atuais = ?,
                interc_pre_natal = ?, interc_trat_intern_pre_natal = ?,
                obs_gestacao = ?, aprovada = ?",
                "id_gestacao = ?",
                array(
                  $this->id_doadora,
                  $this->loc_pre_natal,
                  $this->num_consultas,
                  $this->peso_inicio,
                  $this->peso_final,
                  $this->data_parto,
                  $this->loc_parto,
                  $this->vdrl,
                  $this->hbsag,
                  $this->hb,
                  $this->ht,
                  $this->transfusao,
                  $this->tabagismo,
                  $this->etilismo,
                  $this->drogas,
                  $this->medicamentos,
                  $this->intercorrencias,
                  $this->tratamentos,
                  $this->obs,
                  $this->aprovada,
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
            "Gestacao",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "Gestacao",
            "WHERE id_Gestacao = ?",
            array($ID));
    }
}
