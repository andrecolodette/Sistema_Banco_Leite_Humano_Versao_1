<?php

namespace App\Controller\ControllerList;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Controller\ControllerList\ControllerListModelo;

class ControllerListConformidade extends ControllerListModelo
{
    public function __construct(){
        $this->setTabela("conformidade");
        $this->setColID("id_conformidade");
        $this->setFiltro("");
        $this->setCampos("*");
        $this->setOrderBy("ORDER BY descricao");
        $this->setPesquisa("");

        $this->setControllerGeral("ControllerConformidade");
        $this->setControllerTela("conformidade");
        $this->setControllerLista("ControllerListConformidade");

        $this->setCOLUNAS(array(
            "ID" => "id_conformidade",
            "Descrição" => "descricao",
          ));
        $this->setColExibPadrao(array(
            "Descrição",
          ));

        /*
        $this->setColunaImg(array(
            "" => ""
          ));
        */
        /*
        $this->setColunaClasses(array(
            ""=>array(
                1 => "",
                0 => "",
              ),
          ));
        *
        $this->setColMascara(array());

        $this->setColData(array());
        */

        $this->setBotaoEditar(TRUE);
        $this->setBotaoVisualizar(FALSE);
        $this->setBotaoExcluir(FALSE);

        parent::__construct();
    }
}
