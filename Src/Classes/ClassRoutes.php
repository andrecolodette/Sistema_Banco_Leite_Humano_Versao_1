<?php
namespace Src\Classes;

use Src\Traits\TraitUrlParser;

class ClassRoutes{

    use TraitUrlParser;

    private $Rota;

    #Método de retorno da rota
    public function getRota(){
        $Url=$this->parseUrl();
        $I=$Url[0];

        $this->Rota=array(
            ""=>"ControllerTela\ControllerTelaIndex",

            "contatos"=>"ControllerContato",
            "login"=>"ControllerTela\ControllerTelaLogin",

            "home"=>"ControllerTela\ControllerTelaHome",
            "usuario"=>"ControllerTela\ControllerTelaUsuario",

            "slideshow"=>"ControllerTela\ControllerTelaSlideShow",
            "postagem"=>"ControllerTela\ControllerTelaPostagem",
            "funcionario"=>"ControllerTela\ControllerTelaFuncionario",
            "doadora"=>"ControllerTela\ControllerTelaDoadora",
            "gestacao"=>"ControllerTela\ControllerTelaGestacao",
            "conformidade"=>"ControllerTela\ControllerTelaConformidade",
            "doacao"=>"ControllerTela\ControllerTelaDoacao",
            "naoconformidade"=>"ControllerTela\ControllerTelaNaoConformidade",
            "lote"=>"ControllerTela\ControllerTelaLote",

            "ControllerLogin"=>"ControllerLogin",
            "ControllerUsuario"=>"ControllerUsuario",
            "ControllerSlideShow"=>"ControllerSlideShow",
            "ControllerPostagem"=>"ControllerPostagem",
            "ControllerFuncionario"=>"ControllerFuncionario",
            "ControllerDoadora"=>"ControllerDoadora",
            "ControllerGestacao"=>"ControllerGestacao",
            "ControllerConformidade"=>"ControllerConformidade",
            "ControllerDoacao"=>"ControllerDoacao",

            "ControllerListSlideShow"=>"ControllerList\ControllerListSlideShow",
            "ControllerListPostagem"=>"ControllerList\ControllerListPostagem",
            "ControllerListFuncionario"=>"ControllerList\ControllerListFuncionario",
            "ControllerListDoadora"=>"ControllerList\ControllerListDoadora",
            "ControllerListConformidade"=>"ControllerList\ControllerListConformidade",
            "ControllerListDoacao"=>"ControllerList\ControllerListDoacao",
            "ControllerListNaoConformidade"=>"ControllerList\ControllerListNaoConformidade",
        );

        if(array_key_exists($I,$this->Rota)){
            if(file_exists(DIRREQ."App/Controller/{$this->Rota[$I]}.php")){
                return $this->Rota[$I];
            }else{
                return "ControllerTela\ControllerTelaIndex";
            }
        }else{
            return "ControllerTela\ControllerTelaErro404";
        }
    }
}
