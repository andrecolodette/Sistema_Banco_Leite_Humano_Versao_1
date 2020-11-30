<?php

namespace App\Controller\ControllerList;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Controller\ControllerList\ControllerListModelo;

class ControllerListDoacao extends ControllerListModelo
{

    //SELECT doa.*, GROUP_CONCAT(naoconf.descricao) FROM (SELECT doadora.nome, doacao.* FROM doadora, doacao WHERE doadora.id_doadora = doacao.doadora_id) AS doa LEFT JOIN (SELECT * FROM nao_conformidade, conformidade WHERE nao_conformidade.conformidade_id = conformidade.id_conformidade) AS naoconf ON doa.id_doacao = naoconf.doacao_id GROUP BY doa.id_doacao
    //SELECT * FROM (SELECT doadora.nome, doacao.* FROM doadora, doacao WHERE doadora.id_doadora = doacao.doadora_id) AS doa LEFT JOIN (SELECT nao_conformidade.doacao_id, GROUP_CONCAT(conformidade.descricao) AS nao_conf FROM nao_conformidade, conformidade WHERE nao_conformidade.conformidade_id = conformidade.id_conformidade GROUP BY nao_conformidade.doacao_id) AS naoconf ON doa.id_doacao = naoconf.doacao_id

    public function __construct(){

        $this->setCampos("*");
        $this->setTabela("(SELECT doadora.nome, doacao.* FROM doadora, doacao WHERE doadora.id_doadora = doacao.doadora_id) AS doa
                        LEFT JOIN (SELECT nao_conformidade.doacao_id, GROUP_CONCAT(conformidade.descricao) AS nao_conf FROM nao_conformidade, conformidade WHERE nao_conformidade.conformidade_id = conformidade.id_conformidade GROUP BY nao_conformidade.doacao_id) AS naoconf
                        ON doa.id_doacao = naoconf.doacao_id");
        $this->setColID("id_doacao");
        $this->setFiltro("");
        $this->setOrderBy("ORDER BY doa.data_doacao DESC, doa.nome, doa.id_doacao DESC");
        $this->setPesquisa("doa.id_doacao = ?");

        $this->setFiltroData("doa.data_doacao");
        $this->setFiltroOrderBy(array(
            "ID" => "ORDER BY doa.id_doacao",
            "Doadora" => "ORDER BY doa.nome",
            "Data" => "ORDER BY doa.data_doacao",
        ));
        $this->setFiltroClasses(array(
            "Aprovada" => "doa.aprovado = 'S'",
            "Reprovado" => "doa.aprovado = 'N'",
            "Analizando" => "doa.aprovado = 'A'",
        ));

        $this->setControllerGeral("ControllerDoacao");
        $this->setControllerTela("doacao");
        $this->setControllerLista("ControllerListDoacao");

        $this->setCOLUNAS(array(
            "ID" => "id_doacao",
            "Doadora" => "nome",
            "Data Doação" => "data_doacao",
            "Volume (mL)" => "volume",
            "Acidez Dornic Média" => "ac_dornic_media",
            "Média S C" => "media_s_c",
            "Média C" => "media_c",
            "Calorias" => "caloria",
            "Aprovado" => "aprovado",
            "Não Conformidade" => "nao_conf",
          ));
        $this->setColExibPadrao(array(
            "ID",
            "Doadora",
            "Data Doação",
            "Volume (mL)",
            "Aprovado",
          ));

        /*
        $this->setColunaImg(array(
            "" => ""
          ));
        */

        $this->setColunaClasses(array(
            "Aprovado"=>array(
                "S" => "Aprovado",
                "N" => "Reprovado",
                "A" => "Analizando",
              ),
          ));
        /*
        $this->setColMascara(array());
        *
        $this->setColData(array("Data Doação"));
        */

        $this->setBotaoEditar(TRUE);
        $this->setBotaoVisualizar(FALSE);
        $this->setBotaoExcluir(FALSE);

        parent::__construct();
    }
}
