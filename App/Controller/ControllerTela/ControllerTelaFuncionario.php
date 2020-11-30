<?php

namespace App\Controller\ControllerTela;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use Src\Classes\ClassRender;
use Src\Interfaces\InterfaceView;
use App\Model\ClassCRUD;

class ControllerTelaFuncionario extends ClassRender implements InterfaceView
{

    private $CRUD;
    public $DadosDB = NULL;

    use \Src\Traits\TraitUrlParser;
    public function __construct()
    {
        $this->CRUD = new ClassCRUD();

        $this->setTitle("Funcionario");
        $this->setDescription("Funcionario");
        $this->setKeywords("Leiticia, Sistema, Banco, Leite, Humano, Santa, Casa, Misericódia, Vitória, Funcionario");
        $this->setDir("Funcionario/Lista");
        $this->setAuthor("Andre Louzada Colodette");
        $this->setLayout("Layout_Restrito");

        $urlMetodo = $this->parseUrl();
        if((count($urlMetodo) == 1) or (($urlMetodo[1] != "cadastro") and ($urlMetodo[1] != "atualizar")))
        {
            $this->setDir("Funcionario/Lista");
            $this->renderLayout();
        }
    }

    public function cadastro()
    {
        $session = new \Src\Classes\ClassSessions();
        $session->verifyInsideSession(true);

        $registro = NULL;

        $this->setDir("Funcionario/Form");
        $this->renderLayout();
    }

    public function atualizar($ID = 0)
    {
        $session = new \Src\Classes\ClassSessions();
        $session->verifyInsideSession(true);

        if($ID > 0){
            $id = $session->getSessionId();
            if($ID == $id){
              echo "
                  <script>
                      alert('Não é permitido alterar suas próprias definições!');
                      window.location.href='".DIRPAGE."funcionario';
                  </script>
              ";
            }else{
                $this->DadosDB = $this->CRUD->selectDB(
                    "*",
                    "funcionario",
                    "WHERE id_funcionario = ?",
                    array($ID));

                    $this->setDir("Funcionario/Form");
                    $this->renderLayout();
            }
        }else{
            $this->setDir("Funcionario/Form");
            $this->renderLayout();
        }
    }

}
