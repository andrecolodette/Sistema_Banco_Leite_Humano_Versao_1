<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
if($session->verifyThereIsSession()){
    header("Location: ".DIRPAGE."home");
    die();
}

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;

class ControllerTelaLogin extends ClassRender implements InterfaceView
{

    public function __construct()
    {
        $this->setTitle("Tela de Login");
        $this->setDescription("Tela de Login");
        $this->setKeywords("Banco, Leite, Humano, Tela, Login");
        $this->setDir("");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Login");
        $this->renderLayout();
    }
}
