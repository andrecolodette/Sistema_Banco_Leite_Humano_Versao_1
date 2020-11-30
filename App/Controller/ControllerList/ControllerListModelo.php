<?php

namespace App\Controller\ControllerList;

use App\Model\ClassCRUD;
use Src\Classes\ClassString;
use DateTime;

abstract class ControllerListModelo
{
    /*Atrubutos*/
    //--Básicos
    private $crud;

    //--Específicos
    //----Definições
    //------Tabela
    private $Tabela;
    private $ColID;
    private $Filtro;
    private $Campos;
    private $OrderBy;
    private $Pesquisa;

    //------Controller
    private $ControllerGeral;
    private $ControllerTela;
    private $ControllerLista;

    //------Exibição
    private $COLUNAS = array();
    private $ColExibPadao = array();

    //------Colunas Expeciais
    //----------Colunas de Imagens
    private $ColImagem = array();
    //----------Colunas de ClassSessions
    private $ColClasses = array();
    //----------Colunas com Mascara
    private $ColMascara = array();
    //----------Colunas de Imagens
    private $ColData = array();

    //--Filtros
    //----Ordem
    private $FiltroOrderBy = array();
    //----Classes
    private $FiltroClasses = array();
    //----DATA
    private $FiltroData;

    //--Botões
    private $botaoEditar = FALSE;
    private $botaoVisualizar = FALSE;
    private $botaoExcluir = FALSE;

    private $nBotoes = 0;
    //--Utilitários
    private $colExib = array();
    private $numRegistroPadao = 10;
    private $numRegistroMaximo = 20;
    private $numRegistro;
    private $pag = 1;
    private $buscar = "";

    private $filtro_data_inicio = "";
    private $filtro_data_fim = "";
    private $filtro_orderBy = "";
    private $filtro_classe = "";

    private $string;

    /*Funções*/
    //--Gets e Sets
    public function setTabela($tabela){ $this->Tabela = $tabela; }
    public function setColID($id){ $this->ColID = $id; }
    public function setFiltro($filtro){ $this->Filtro = $filtro; }
    public function setCampos($campos = "*"){ $this->Campos = $campos; }
    public function setOrderBy($orderBy = ""){ $this->OrderBy = $orderBy; }
    public function setPesquisa($pesquisa = ""){ $this->Pesquisa = $pesquisa; }

    public function setControllerGeral($controllerGeral){ $this->ControllerGeral = $controllerGeral; }
    public function setControllerTela($controllerTela){ $this->ControllerTela = $controllerTela; }
    public function setControllerLista($controllerLista){ $this->ControllerList = $controllerLista; }

    public function setCOLUNAS($colunas = array()){ $this->COLUNAS = $colunas; }
    public function setColExibPadrao($colPadrao = array()){ $this->ColExibPadrao = $colPadrao; }

    public function setColunaImg($ColImagem = array()){ $this->ColImagem = $ColImagem; }
    public function setColunaClasses($ColClasses = array()){ $this->ColClasses = $ColClasses; }
    public function setColMascara($ColMascara = array()){ $this->ColMascara = $ColMascara; }
    public function setColData($ColData = array()){ $this->ColData = $ColData; }

    public function setFiltroData($filtroData = ""){ $this->FiltroData = $filtroData; }
    public function setFiltroOrderBy($filtroOrderBy = ""){ $this->FiltroOrderBy = $filtroOrderBy; }
    public function setFiltroClasses($filtroClasses = ""){ $this->FiltroClasses = $filtroClasses; }

    public function setBotaoEditar($permitir = FALSE){ $this->botaoEditar = $permitir; }
    public function setBotaoVisualizar($permitir = FALSE){ $this->botaoVisualizar = $permitir; }
    public function setBotaoExcluir($permitir = FALSE){ $this->botaoExcluir = $permitir; }

    //--Construtor
    public function __construct()
    {
        $this->crud = new ClassCRUD();
        $this->numRegistro = $this->numRegistroPadao;
        $this->colExib = array_merge($this->ColExibPadrao);
        $this->string = new ClassString();
    }

    public function contarNumeroBotoes(){
        $this->nBotoes = 0;
        if($this->botaoEditar){
            $this->nBotoes++;
        }
        if($this->botaoVisualizar){
            $this->nBotoes++;
        }
        if($this->botaoExcluir){
            $this->nBotoes++;
        }
    }

    //--Gerador do Menu de Configuração
    public function gerarMenuConfig()
    {
        $html = "";
        $html .= "<li class='listaConfigLista'> <a>Opções</a> \n";
        $html .= "    <form class='' id='formColConfig' name='formColConfig' action='".DIRPAGE."$this->ControllerList/tabelaListagem' method='post' > \n";
        $html .= "        <ul> \n";
        $html .= "            <li> \n";
        //$html .= "                Nº Registro: <input class='numRegistro' type='number' id='formNumRegistro' name='formNumRegistro' value='$this->numRegistro' > \n";
        $html .= "                <div class='divOpcaoLista'> \n";
        $html .= "                    Nº Registro: \n";
        $html .= "                </div> \n";
        $html .= "                <div class='divOpcaoCheck'> \n";
        $html .= "                    <input class='numRegistro' type='number' id='formNumRegistro' name='formNumRegistro' value='$this->numRegistro' > \n";
        $html .= "                </div> \n";
        $html .= "            </li> \n";

        foreach(array_keys($this->COLUNAS) as $coluna){
            $check = "";
            if(in_array($coluna, $this->colExib)){
                $check = "checked";
            }
            $html .= "            <li> \n";
            //$html .= "                $coluna: <input class='colConfig' type='checkbox' id='formColCheck' name='formColCheck[]' value='$coluna' $check> \n";
            $html .= "                <div class='divOpcaoLista'> \n";
            $html .= "                    $coluna: \n";
            $html .= "                </div> \n";
            $html .= "                <div class='divOpcaoCheck'> \n";
            $html .= "                    <input class='colConfig' type='checkbox' id='formColCheck' name='formColCheck[]' value='$coluna' $check> \n";
            $html .= "                </div> \n";
            $html .= "            </li> \n";
        }
        $html .= "            <li class='buttonColConfig'> \n";
        $html .= "                <input class='buttonBasico' type='submit' value='Atualizar!'> \n";
        $html .= "            </li> \n";
        $html .= "        </ul> \n";
        $html .= "    </form> \n";
        $html .= "</li> \n";

        echo $html;
    }

    //--Gera uma opção de busca no DB
    public function gerarMenuBusca($legenda = "")
    {
        $html = "";
        $html .= "<li class='listPesquisarRegistro'> \n";
        $html .= "    <a> \n";
        $html .= "        <div> \n";
        $html .= "        <form class='' id='formListPesquizar' name='formListPesquizar' action='".DIRPAGE."$this->ControllerList/tabelaListagem' method='post' autocomplete='off'> \n";
        $html .= "            <input class='inputListPesquisar' type='text' id='formListBuscar' name='formListBuscar' placeholder='$legenda'> \n";
        $html .= "            <input class='buttonListPesquisar' type='submit' value='Pesquisar!'> \n";
        $html .= "        </form> \n";
        $html .= "        </div> \n";
        $html .= "    </a> \n";
        $html .= "</li> \n";

        echo $html;
    }

    //--Gera uma pesquisa por intervalo de data
    public function gerarMenuData()
    {
        $html = "";
        $html .= "<li class='listPesquisarData'><a>Filtrar Data</a> \n";
        $html .= "    <form class='' id='formDataFiltro' name='formDataFiltro' action='".DIRPAGE."$this->ControllerList/tabelaListagem' method='post' autocomplete='off'> \n";
        $html .= "        <ul> \n";
        $html .= "            <li> \n";
        $html .= "                <div class='wp30 floatL'> \n";
        $html .= "                    Início\n";
        $html .= "                </div> \n";
        $html .= "                <div class='wp70 floatL'> \n";
        $html .= "                    <input class='' type='date' id='formDataFiltro_inic' name='formDataFiltro_inic'> \n";
        $html .= "                </div> \n";
        $html .= "            </li> \n";
        $html .= "            <li> \n";
        $html .= "                <div class='wp30 floatL'> \n";
        $html .= "                    Fim\n";
        $html .= "                </div> \n";
        $html .= "                <div class='wp70 floatL'> \n";
        $html .= "                    <input class='' type='date' id='formDataFiltro_fim' name='formDataFiltro_fim'> \n";
        $html .= "                </div> \n";
        $html .= "            </li> \n";
        $html .= "            <li class='buttonColConfig'> \n";
        $html .= "                <input class='buttonBasico' type='submit' value='Filtrar!'> \n";
        $html .= "            </li> \n";
        $html .= "        </ul> \n";
        $html .= "    </form> \n";
        $html .= "</li> \n";

        echo $html;
    }

    //--Gera uma menu de filtros - Ordem de Exibição, Classes e Data
    public function gerarMenuFiltro()
    {
        $html = "";
        $html .= "<li class='menuListaFiltro'><a>Filtros</a> \n";
        $html .= "    <form class='' id='formListFiltro' name='formListFiltro' action='".DIRPAGE."$this->ControllerList/tabelaListagem' method='post' autocomplete='off'> \n";
        $html .= "        <ul> \n";

        //Filtro de Order By
        if(count($this->FiltroOrderBy) > 0){
            $html .= "            <li> \n";
            $html .= "                <div class='wp30 floatL'> \n";
            $html .= "                    Ordenar:\n";
            $html .= "                </div> \n";
            $html .= "                <div class='wp70 floatL'> \n";
            $html .= "                    <select class='campoListFiltro' id='formListFiltroOrdemBy' name='formListFiltroOrdemBy'> \n";
            $html .= "                        <option value='$this->OrderBy'>Padrão</option> \n";
            foreach(array_keys($this->FiltroOrderBy) as $ordem){
                $html .= "                        <option value='".$this->FiltroOrderBy[$ordem]."'>$ordem</option> \n";
            }
            $html .= "                    </select> \n";
            $html .= "                </div> \n";
            $html .= "            </li> \n";
        }

        //Filtro de Classes
        if(count($this->ColClasses) > 0){
            $html .= "            <li> \n";
            $html .= "                <div class='wp30 floatL'> \n";
            $html .= "                    Classes:\n";
            $html .= "                </div> \n";
            $html .= "                <div class='wp70 floatL'> \n";
            $html .= "                    <select class='campoListFiltro' id='formListFiltroClasses' name='formListFiltroClasses'> \n";
            $html .= "                        <option value=''>Padrão</option> \n";
            foreach(array_keys($this->FiltroClasses) as $class){
                $html .= "                        <option value='$class'>".$class."</option> \n";
            }
            $html .= "                    </select> \n";
            $html .= "                </div> \n";
            $html .= "            </li> \n";
        }

        //Filtro de Data
        if($this->FiltroData != ""){
            $html .= "            <li> \n";
            $html .= "                <div class='wp30 floatL'> \n";
            $html .= "                    Data Iníc\n";
            $html .= "                </div> \n";
            $html .= "                <div class='wp70 floatL'> \n";
            $html .= "                    <input class='campoListFiltro' type='date' id='formListaFiltroData_inic' name='formListaFiltroData_inic'> \n";
            $html .= "                </div> \n";
            $html .= "            </li> \n";
            $html .= "            <li> \n";
            $html .= "                <div class='wp30 floatL'> \n";
            $html .= "                    Data Final\n";
            $html .= "                </div> \n";
            $html .= "                <div class='wp70 floatL'> \n";
            $html .= "                    <input class='campoListFiltro' type='date' id='formListaFiltroData_fim' name='formListaFiltroData_fim'> \n";
            $html .= "                </div> \n";
            $html .= "            </li> \n";
        }

        $html .= "            <li class='buttonColConfig'> \n";
        $html .= "                <div class='wp50 floatL'> \n";
        $html .= "                    <input class='buttonBasico' type='submit' value='Filtrar!'> \n";
        $html .= "                </div> \n";
        $html .= "                <div class='wp50 floatL'> \n";
        $html .= "                    <input class='buttonBasico' type='reset' value='Limpar!'> \n";
        $html .= "                </div> \n";
        $html .= "            </li> \n";
        $html .= "        </ul> \n";
        $html .= "    </form> \n";
        $html .= "</li> \n";

        echo $html;
    }


    //--Receber os valores de configuração
    public function receberColConfig()
    {
        if(isset($_POST['formNumRegistro'])){
            $this->numRegistro = $_POST['formNumRegistro'];
        }else{
            $this->numRegistro = $this->numRegistroPadao;
        }

        if(isset($_POST['formColCheck'])){
            $this->colExib = $_POST['formColCheck'];
        }else{
            //$this->colExib = $this->colExibPadrao;
            $this->colExib = array_merge($this->ColExibPadrao);
        }

        if(isset($_POST['pagListagem'])){
            $this->pag = $_POST['pagListagem'];
        }else{
            $this->pag = 1;
        }

        if(isset($_POST['formListFiltroClasses'])){
            //$this->filtro_classe = $_POST['formListFiltroClasses'];
            $ind = $_POST['formListFiltroClasses'];
            if($ind != ""){
                $this->filtro_classe = $this->FiltroClasses[$ind];
            }else{
                $this->filtro_classe = "";
            }
        }else{
            $this->filtro_classe = "";
        }

        if(isset($_POST['formListFiltroOrdemBy'])){
            $this->filtro_orderBy = $_POST['formListFiltroOrdemBy'];
        }else{
            $this->filtro_orderBy = $this->OrderBy;
        }

        if(isset($_POST['formListaFiltroData_inic'])){
            $this->filtro_data_inicio = $_POST['formListaFiltroData_inic'];
        }else{
            $this->filtro_data_inicio = "";
        }
        if(isset($_POST['formListaFiltroData_fim'])){
            $this->filtro_data_fim = $_POST['formListaFiltroData_fim'];
        }else{
            $this->filtro_data_fim = "";
        }

        if(isset($_POST['formListBuscar'])){
            $this->buscar = filter_input(INPUT_POST,"formListBuscar",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //$this->filtro_classe = "";
        }else{
            $this->buscar = "";
        }

    }

    //--Cria a Tabela de Listagem
    public function tabelaListagem()
    {
        $this->receberColConfig();
        $this->contarNumeroBotoes();

        if($this->numRegistro < 1){ $this->numRegistro = $this->numRegistroPadao; }
        if($this->numRegistro > $this->numRegistroMaximo){ $this->numRegistro = $this->numRegistroMaximo; }

        if($this->filtro_classe != ""){
            if($this->Filtro == ""){
                $this->Filtro = "WHERE $this->filtro_classe";
            }else{
                $this->Filtro .= " and $this->filtro_classe";
            }
        }

        if($this->filtro_data_inicio != ""){
            $pesquisa = "$this->FiltroData >= '$this->filtro_data_inicio'";
            if($this->Filtro == ""){
                $this->Filtro = "WHERE $pesquisa";
            }else{
                $this->Filtro .= " and $pesquisa";
            }
        }
        if($this->filtro_data_fim != ""){
            $pesquisa = "$this->FiltroData <= '$this->filtro_data_fim'";
            if($this->Filtro == ""){
                $this->Filtro = "WHERE $pesquisa";
            }else{
                $this->Filtro .= " and $pesquisa";
            }
        }

        if($this->buscar != ""){
            $pesquisa = str_replace('?', $this->buscar, $this->Pesquisa);
            if($this->Filtro == ""){
                $this->Filtro = "WHERE $pesquisa";
            }else{
                $this->Filtro .= " and $pesquisa";
            }
            $this->Filtro = "WHERE $pesquisa";
        }

        $totalRegistro = 0;
        $qtdReg = $this->crud->selectDB(
            "COUNT($this->ColID) AS 'QTD'",
            "$this->Tabela",
            "$this->Filtro",
            array()
          );
        foreach($qtdReg as $reg){
            $totalRegistro = $reg['QTD'];
        }
        $totalPagina = ceil($totalRegistro / $this->numRegistro);

        if($this->pag < 1){ $this->pag = 1; }
        if($this->pag > $totalPagina){ $this->pag = $totalPagina; }

        $inicio = ($this->pag - 1) * $this->numRegistro;
        $qtd = $this->numRegistro;

        $this->OrderBy = $this->filtro_orderBy;

        $registrosDB = $this->crud->selectDB(
            "$this->Campos",
            "$this->Tabela",
            //"$this->Filtro $this->OrderBy LIMIT $inicio, $qtd",
            "$this->Filtro $this->filtro_orderBy LIMIT $inicio, $qtd",
            array()
        );

        $html = "";
        $html .= "<div class='tabelaRolagem'> \n";
        $html .= "    <table class='tableListagem'> \n";
        $html .= "        <col class='colN'> \n";
        for($i=0; $i < count($this->colExib); $i++){
            $html .= "        <col class=''> \n";
        }
        $html .= "        <col class='colAcaoes nb$this->nBotoes'> \n";
        $html .= "        <thead> \n";
        $html .= "            <tr> \n";
        $html .= "                <th>Nº</th> \n";
        foreach($this->colExib as $coluna){
            $html .= "                <th>$coluna</th> \n";
        }
        $html .= "                <th>AÇÕES</th> \n";
        $html .= "            </tr> \n";
        $html .= "        </thead> \n";
        $html .= "        <tbody> \n";
        $n = 1;
        $n = (($this->pag - 1) * $this->numRegistro) + 1;
        foreach($registrosDB as $linha){
            $html .= "            <tr> \n";
            $html .= "                <td>$n</td> \n";
            $n++;
            foreach($this->colExib as $coluna){

                if(in_array($coluna, array_keys($this->ColImagem))){
                    $html .= "                <td><img class='imgTabelaListagem' src='".$this->ColImagem[$coluna].$linha[$this->COLUNAS[$coluna]]."'></td> \n";

                }elseif(in_array($coluna, array_keys($this->ColClasses))){
                    $classes = $this->ColClasses[$coluna];
                    $valor = $classes[$linha[$this->COLUNAS[$coluna]]];
                    $html .= "                <td>".$valor."</td> \n";

                }elseif(in_array($coluna, array_keys($this->ColMascara))){
                    $mascara = $this->ColMascara[$coluna];
                    $valor = $linha[$this->COLUNAS[$coluna]];
                    $str = $this->string->mascara_string($mascara, $valor);
                    $html .= "                <td>".$str."</td> \n";

                }elseif(in_array($coluna, array_keys($this->ColData))){
                    $valor = $linha[$this->COLUNAS[$coluna]];
                    $data = date("d/m/Y", strtotime($valor));
                    $html .= "                <td>".$data."</td> \n";

                }else{
                    $text = $linha[$this->COLUNAS[$coluna]];
                    $html .= "                <td>".$text."</td> \n";
                }

            }
            $html .= "                <td> \n";
            $html .= "                    <ul class='acoes nb$this->nBotoes'> \n";
            if($this->botaoEditar){
                $html .= "                       <li> \n";
                $html .= "                            <a class='buttonBasico buttonAcao' href='".DIRPAGE."$this->ControllerTela/atualizar/".$linha[$this->ColID]."'> \n";
                $html .= "                                <img class='iconAcao' src='".DIRIMG."icon/edite_16.png"."' alt='Editar'> \n";
                $html .= "                            </a> \n";
                $html .= "                        </li> \n";
            }
            if($this->botaoVisualizar){
                $html .= "                       <li> \n";
                $html .= "                            <a class='buttonBasico buttonAcao' href='".DIRPAGE."$this->ControllerTela/visualizar/".$linha[$this->ColID]."'> \n";
                $html .= "                                <img class='iconAcao' src='".DIRIMG."icon/visualizar_16.png"."' alt='Visualizar'> \n";
                $html .= "                            </a> \n";
                $html .= "                        </li> \n";
            }
            if($this->botaoExcluir){
                $html .= "                       <li> \n";
                $html .= "                            <a class='buttonBasico buttonAcao' onclick='return fLinkExcluir(this)' href='".DIRPAGE."$this->ControllerGeral/excluir/".$linha[$this->ColID]."'> \n";
                $html .= "                                <img class='iconAcao' src='".DIRIMG."icon/lixeira_16.png"."' alt='Excluir'> \n";
                $html .= "                            </a> \n";
                $html .= "                        </li> \n";
            }
            $html .= "                    </ul> \n";
            $html .= "                </td> \n";
            $html .= "            </tr> \n";
        }
        $html .= "        </tbody> \n";
        $html .= "    </table> \n";
        $html .= "</div> \n";

        echo $html;

        $html = "";
        $html .= "<div class='divPaginacao'> \n";
        $html .= "    <ul> \n";
        $html .= "        <li class='liPagListaRecursividade1'> \n";
        $html .= "            <a onclick='functionPagTelaListagem(1)'>1</a> \n";
        $html .= "        </li> \n";
        $html .= "        <li class='liPagListaRecursividade1'> \n";
        $html .= "            <a onclick='functionIrPagTelaListagem(-1)'>&#10094;</a> \n";
        $html .= "        </li> \n";
        $html .= "        <li class='liPagListaRecursividade2'> \n";
        $html .= "            <ul> \n";
        $html .= "                <li> \n";
        $html .= "                    <input type='number' id='pagAtual' name='pagAtual' value='$this->pag'> \n";
        $html .= "                </li> \n";
        $html .= "                <li> \n";
        $html .= "                    <input type='button' onclick='functionIrPagTelaListagem()' value='IR!'> \n";
        $html .= "                </li> \n";
        $html .= "            </ul> \n";
        $html .= "        </li> \n";
        $html .= "        <li class='liPagListaRecursividade1'> \n";
        $html .= "            <a onclick='functionIrPagTelaListagem(+1)'>&#10095;</a> \n";
        $html .= "        </li> \n";
        $html .= "        <li class='liPagListaRecursividade1'> \n";
        $html .= "            <a onclick='functionPagTelaListagem($totalPagina)'>$totalPagina</a> \n";
        $html .= "        </li> \n";
        $html .= "    </ul> \n";
        $html .= "</div> \n";

        echo $html;
    }
}
