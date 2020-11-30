<?php

namespace App\Controller\ControllerTela;
use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;

class ControllerTelaErro404 extends ClassRender implements InterfaceView
{

    public function __construct()
    {
        $this->setTitle("Erro 404");
        $this->setDescription("Erro 404");
        $this->setKeywords("Banco, Leite, Modelo, Erro, 404");
        $this->setDir("Erro404");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Site");
        $this->renderLayout();
    }
}
