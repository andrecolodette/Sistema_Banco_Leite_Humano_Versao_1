<?php

namespace Src\Classes;

class ClassMensagemAlerta
{
    private $Sucesso = TRUE;
    private $Mensagem=[];
    private $Redirecionar = FALSE;
    private $URL = NULL;

    private $Extra = [];

    public function getSucesso(){ return $this->Sucesso; }
    public function setSucesso($Sucesso){ $this->Sucesso = $Sucesso; }

    public function getMensagem(){ return $this->Mensagem; }
    public function setMensagem($Mensagem){ array_push($this->Mensagem,$Mensagem); }

    public function getRedirecionar(){ return $this->Redirecionar; }
    public function setRedirecionar($Redirecionar){ $this->Redirecionar = $Redirecionar; }
    public function getURL(){ return $this->URL; }
    public function setURL($URL){ $this->URL = $URL; }

    public function getExtra(){ return $this->Extra; }
    public function setExtra($Extra){ $this->Extra = array_merge($this->Extra,$Extra); }

    public function __construct()
    {}

    #Mensagem Validação Final
    public function validateFinalMensagem()
    {

        $arrResponse = array(
            "sucesso" => $this->getSucesso(),
            "mensagem" => $this->getMensagem(),
            "redirecionar" => $this->getURL(),
            "extra" => $this->getExtra(),
        );
        /*
        if(count($this->Extra) > 0){
            $arrResponse = array_merge($arrResponse, $this->Extra);
        }
        */

        #$arrResponse['extra'] = $this->getExtra();

        echo json_encode($arrResponse);
    }

      #Imprimir Erros
      public function imprimirErros()
      {
          foreach ($this->getMensagem() as $msg) {
              echo "$msg \n";
          }
      }

}
