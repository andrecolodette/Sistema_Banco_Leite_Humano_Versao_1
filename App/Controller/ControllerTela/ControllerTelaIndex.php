<?php

namespace App\Controller\ControllerTela;

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;

class ControllerTelaIndex extends ClassRender implements InterfaceView
{
    public $slideShow = NULL;
    public $postagem = NULL;

    public function __construct()
    {
        $crud = new \App\Model\ClassCRUD();

        $this->slideShow = $crud->selectDB("*", "slide_show", "", array());


        $this->postagem = $crud->selectDB("*", "postagem", "", array());

        $this->setTitle("LEITICIA");
        $this->setDescription("Tela inicial do sistema LEITICIA do Banco de Leite Humano da Santa Casa De Misericódia de Vitória");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória");
        $this->setDir("Index");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Site");
        $this->renderLayout();
    }
}
