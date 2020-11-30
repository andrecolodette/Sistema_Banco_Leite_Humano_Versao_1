<?php

namespace App\Controller\ControllerList;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Controller\ControllerList\ControllerListModelo;

class ControllerListPostagem extends ControllerListModelo
{
    public function __construct(){
        $this->setTabela("postagem");
        $this->setColID("id_postagem");
        $this->setFiltro("");
        $this->setCampos("*");
        $this->setOrderBy("ORDER BY id_postagem");

        $this->setControllerGeral("ControllerPostagem");
        $this->setControllerTela("postagem");
        $this->setControllerLista("ControllerListPostagem");

        $this->setCOLUNAS(array(
            "ID" => "id_postagem",
            "Título" => "titulo",
            //"Descrição" => "descricao",
            "Imagem" => "imagem",
            //"Arquivo" => "arquivo"
          ));
        $this->setColExibPadrao(array(
            "Título",
            "Imagem"
          ));

        $this->setColunaImg(array(
            "Imagem" => DIRIMG."postagem/"
          ));

        $this->setBotaoEditar(TRUE);
        $this->setBotaoVisualizar(FALSE);
        $this->setBotaoExcluir(TRUE);

        parent::__construct();
    }
}
