<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaNaoConformidade extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;


    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("NaoConformidade");
        $this->setDescription("NaoConformidade");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Postagem, Artigo");
        $this->setDir("NaoConformidade/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        //if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar")))
        //{
            $this->setDir("NaoConformidade/Lista");
            $this->renderLayout();
        //}
    }

}
