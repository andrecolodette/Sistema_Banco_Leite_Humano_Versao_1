<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaDoacao extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;

    public $ID_Doadora = NULL;
    public $DoadoraDB = NULL;
    public $ConformidadeDB = NULL;
    public $NaoConformidadeDB = NULL;


    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("Doacao");
        $this->setDescription("Doacao");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Postagem, Artigo");
        $this->setDir("Doacao/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar")))
        {
            $this->setDir("Doacao/Lista");
            $this->renderLayout();
        }
    }

    public function cadastro($id_doadora = NULL)
    {
        $this->ID_Doadora = $id_doadora;

        $this->DoadoraDB = $this->CRUD->selectDB(
            "*",
            "doadora",
            "WHERE status_doando = 'S' ORDER BY nome",
            array()
          );

        $this->ConformidadeDB = $this->CRUD->selectDB(
            "*",
            "conformidade",
            "ORDER BY descricao",
            array()
          );

        $this->setDir("Doacao/Form");
        $this->renderLayout();
    }

    public function atualizar($ID = 0)
    {
        if($ID > 0){

            $this->DadosDB = $this->CRUD->selectDB(
                "*",
                "doacao",
                "WHERE id_Doacao = ?",
                array($ID)
              );

            $this->DoadoraDB = $this->CRUD->selectDB(
                "*",
                "doadora",
                "ORDER BY nome",
                array()
              );

            $this->ConformidadeDB = $this->CRUD->selectDB(
                "*",
                "conformidade",
                "ORDER BY descricao",
                array()
              );

            $this->NaoConformidadeDB = $this->CRUD->selectDB(
                "*",
                "nao_conformidade",
                "WHERE doacao_id = ? ORDER BY conformidade_id",
                array($ID)
              );
        }

        $this->setDir("Doacao/Form");
        $this->renderLayout();
    }

}
