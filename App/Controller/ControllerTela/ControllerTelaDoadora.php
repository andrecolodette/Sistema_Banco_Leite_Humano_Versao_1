<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaDoadora extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;

    public $ID_Doadora = NULL;
    public $DoadoraDB = NULL;
    public $GestacaoDB = NULL;
    public $DoacaoDB = NULL;

    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("Doadora");
        $this->setDescription("Doadora");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Postagem, Artigo");
        $this->setDir("Doadora/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar") and ($urlMetodo[1] != "visualizar")))
        {
            $this->setDir("Doadora/Lista");
            $this->renderLayout();
        }
    }

    public function cadastro()
    {
        $this->setDir("Doadora/Form");
        $this->renderLayout();
    }

    public function atualizar($ID = 0)
    {
        if($ID > 0){
            $this->DadosDB = $this->CRUD->selectDB(
                "*",
                "doadora",
                "WHERE id_doadora = ?",
                array($ID)
              );
        }

        $this->setDir("Doadora/Form");
        $this->renderLayout();
    }

    public function visualizar($ID = 0)
    {
        if($ID > 0){
            $this->ID_Doadora = $ID;
            $this->DoadoraDB = $this->CRUD->selectDB(
                "*",
                "doadora",
                "WHERE id_doadora = ?",
                array($ID)
            );
            $this->GestacaoDB = $this->CRUD->selectDB(
                "*",
                "gestacao",
                "WHERE doadora_id = ?
                ORDER BY data_parto, id_gestacao",
                array($ID)
            );
            $this->DoacaoDB = $this->CRUD->selectDB(
                "doacao.*, GROUP_CONCAT(naoconf.descricao) AS nao_conformidade",
                "doacao LEFT JOIN (SELECT nao_conformidade.*, conformidade.descricao FROM nao_conformidade, conformidade WHERE nao_conformidade.conformidade_id = conformidade.id_conformidade) AS naoconf ON doacao.id_doacao = naoconf.doacao_id",
                "WHERE doacao.doadora_id = ?
                GROUP BY doacao.id_doacao ORDER BY doacao.data_doacao, doacao.id_doacao",
                array($ID)
            );

            $this->setDir("Doadora/Visualizar");
        }else{
            $this->setDir("Doadora/Lista");
        }

        $this->renderLayout();
    }

}
