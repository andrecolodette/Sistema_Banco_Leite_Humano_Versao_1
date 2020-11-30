<?php

namespace App\Controller\ControllerList;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Controller\ControllerList\ControllerListModelo;

class ControllerListSlideShow extends ControllerListModelo
{
    public function __construct(){
        $this->setTabela("slide_show");
        $this->setColID("id_slide_show");
        $this->setFiltro("");
        $this->setCampos("*");
        $this->setOrderBy("ORDER BY id_slide_show");

        $this->setControllerGeral("ControllerSlideShow");
        $this->setControllerTela("slideshow");
        $this->setControllerLista("ControllerListSlideShow");

        $this->setCOLUNAS(array(
            "ID" => "id_slide_show",
            "Título" => "titulo",
            "Link" => "link",
            "Imagem" => "imagem"
          ));
        $this->setColExibPadrao(array(
            "Título",
            "Link",
            "Imagem"
          ));

        $this->setColunaImg(array(
            "Imagem" => DIRIMG."slide/"
          ));

        $this->setBotaoEditar(TRUE);
        $this->setBotaoVisualizar(FALSE);
        $this->setBotaoExcluir(TRUE);

        parent::__construct();
    }
}
