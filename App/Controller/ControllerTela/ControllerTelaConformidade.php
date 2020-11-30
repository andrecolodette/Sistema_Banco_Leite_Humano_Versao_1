<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaConformidade extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;

    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("Conformidade");
        $this->setDescription("Conformidade");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Postagem, Artigo");
        $this->setDir("Conformidade/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar")))
        {
            $this->setDir("Conformidade/Lista");
            $this->renderLayout();
        }
    }

    public function cadastro($id_doadora = NULL)
    {
        $this->setDir("Conformidade/Form");
        $this->renderLayout();
    }

    public function atualizar($ID = 0)
    {
        if($ID > 0){
            $this->DadosDB = $this->CRUD->selectDB(
                "*",
                "Conformidade",
                "WHERE id_conformidade = ?",
                array($ID)
              );
        }

        $this->setDir("Conformidade/Form");
        $this->renderLayout();
    }

}
