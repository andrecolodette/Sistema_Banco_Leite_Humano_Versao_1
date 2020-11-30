<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaUsuario extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;

    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $session = new \Src\Classes\ClassSessions();
        $id = $session->getSessionId();

        $this->CRUD = new ClassCRUD();

        $this->DadosDB = $this->CRUD->selectDB(
            "*",
            "funcionario",
            "WHERE id_funcionario = ?",
            array($id));

        $this->setTitle("Usuario");
        $this->setDescription("Usuario");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Home, Artigo");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $this->setDir("Usuario");
        $this->renderLayout();
    }

}
