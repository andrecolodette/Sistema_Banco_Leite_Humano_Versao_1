<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaSlideShow extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;

    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("Slide Show");
        $this->setDescription("Slide Show");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Slide, Show");
        $this->setDir("SlideShow/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar")))
        {
            $this->setDir("SlideShow/Lista");
            $this->renderLayout();
        }
    }

    public function cadastro()
    {
        $this->setDir("SlideShow/Form");
        $this->renderLayout();
    }

    public function atualizar($ID = 0)
    {
        if($ID > 0){
            $this->DadosDB = $this->CRUD->selectDB(
                "*",
                "slide_show",
                "WHERE id_slide_show = ?",
                array($ID)
              );
        }

        $this->setDir("SlideShow/Form");
        $this->renderLayout();
    }

}
