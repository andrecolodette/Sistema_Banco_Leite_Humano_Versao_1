<?php

namespace App\Controller\ControllerList;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Controller\ControllerList\ControllerListModelo;

class ControllerListDoadora extends ControllerListModelo
{
    public function __construct(){
        $this->setTabela("doadora");
        $this->setColID("id_doadora");
        $this->setFiltro("");
        $this->setCampos("*");
        $this->setOrderBy("ORDER BY nome");
        $this->setPesquisa("nome LIKE '%?%' OR cpf LIKE '%?%'");

        $this->setControllerGeral("ControllerDoadora");
        $this->setControllerTela("doadora");
        $this->setControllerLista("ControllerListDoadora");

        $this->setFiltroClasses(array(
            "Doando" => "status_doando = 'S'",
            "Inativa" => "status_doando = 'N'",
        ));

        $this->setCOLUNAS(array(
            "ID" => "id_doadora",
            "Nome" => "nome",
            "RG" => "rg",
            "CPF" => "cpf",
            "Cartão do SUS" => "cartao_sus",
            "Data de Nascimento" => "data_nasc",
            "Celular" => "celular",
            "Estado" => "estado",
            "Cidade" => "cidade",
            "Bairro" => "bairro",
            "CEP" => "cep",
            "Endereço" => "endereco",
            "Data de Registro" => "data_registro",
            "Status" => "status_doando"
          ));
        $this->setColExibPadrao(array(
            "Nome",
            "CPF",
            "Celular",
            "Status",
          ));

        /*
        $this->setColunaImg(array(
            "" => ""
          ));
        */

        $this->setColunaClasses(array(
            "Status"=>array(
                'S' => "Doando",
                'N' => "Inativa",
              ),
          ));

        $this->setColMascara(array(
            "CPF" => "###.###.###-##",
            "Cartão do SUS" => "### #### #### ####",
            "Celular" => "(##) #####-####",
            "CEP" => "##.###-###",
          ));
        /*
        $this->setColData(array(
            "Data de Nascimento",
            "Data de Registro",
          ));
        */
        $this->setBotaoEditar(FALSE);
        $this->setBotaoVisualizar(TRUE);
        $this->setBotaoExcluir(FALSE);

        parent::__construct();
    }
}
