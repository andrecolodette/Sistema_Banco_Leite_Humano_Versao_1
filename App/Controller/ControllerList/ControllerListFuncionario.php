<?php

namespace App\Controller\ControllerList;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Controller\ControllerList\ControllerListModelo;

class ControllerListFuncionario extends ControllerListModelo
{
    public function __construct(){
        $this->setTabela("funcionario");
        $this->setColID("id_funcionario");
        $this->setFiltro("");
        $this->setCampos("*");
        $this->setOrderBy("ORDER BY nome");

        $this->setFiltroOrderBy(array(
            "Nome" => "ORDER BY nome",
            "Usuário" => "ORDER BY usuario",
        ));
        $this->setFiltroClasses(array(
            "Adiministrador" => "administrador = 1",
            "Comum" => "administrador = 0",
            "Ativo" => "ativo = 1",
            "Inativo" => "ativo = 0",
        ));

        $this->setControllerGeral("ControllerFuncionario");
        $this->setControllerTela("funcionario");
        $this->setControllerLista("ControllerListFuncionario");

        $this->setCOLUNAS(array(
            "ID" => "id_funcionario",
            "Nome" => "nome",
            "Usuário" => "usuario",
            "Administrador" => "administrador",
            "Ativo" => "ativo"
          ));
        $this->setColExibPadrao(array(
            "Nome",
            "Usuário",
            "Administrador",
            "Ativo"
          ));

        /*
        $this->setColunaImg(array(
            "" => ""
          ));
        */
        $this->setColunaClasses(array(
            "Administrador"=>array(
                1 => "Administrador",
                0 => "Comum",
              ),
            "Ativo"=>array(
                1 => "Ativo",
                0 => "Inativo",
              ),
          ));

        $this->setBotaoEditar(TRUE);
        $this->setBotaoVisualizar(FALSE);
        $this->setBotaoExcluir(FALSE);

        parent::__construct();
    }
}
