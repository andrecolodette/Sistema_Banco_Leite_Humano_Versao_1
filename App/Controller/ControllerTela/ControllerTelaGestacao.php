<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaGestacao extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;
    public $doadoraDB = NULL;

    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("Gestacao");
        $this->setDescription("Gestacao");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Postagem, Artigo");
        $this->setDir("Gestacao/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar")))
        {
            $this->setDir("Doadora/Lista");
            $this->renderLayout();
        }
    }

    public function cadastro($id_doadora = NULL)
    {
        if($id_doadora == NULL){
            /*Não tem uma doadora asociada*/
        }else{
            $this->doadoraDB = $this->CRUD->selectDB(
                "*",
                "doadora",
                "WHERE id_doadora = ?",
                array($id_doadora)
            );
            if(($this->doadoraDB->rowCount()) != 1){
                $this->doadoraDB = NULL;
            }
        }

        $this->setDir("Gestacao/Form");
        $this->renderLayout();
    }

    public function atualizar($ID = 0)
    {
        if($ID > 0){
            $this->DadosDB = $this->CRUD->selectDB(
                "gestacao.*, doadora.nome",
                "gestacao, doadora",
                "WHERE id_doadora = doadora_id AND id_gestacao = ?",
                array($ID)
              );
            /*
            $dados = $this->DadosDB;
            $id_doadora = NULL;
            foreach($dados as $gest){
                $id_doadora = $gest['doadora_id'];
            }
            $this->doadoraDB = $this->CRUD->selectDB(
                "*",
                "doadora",
                "WHERE id_doadora = ?",
                array($id_doadora)
              );*/
        }


        $this->setDir("Gestacao/Form");
        $this->renderLayout();
    }

}
