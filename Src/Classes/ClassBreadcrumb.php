<?php

namespace Src\Classes;

class ClassBreadcrumb{
    use \Src\Traits\TraitUrlParser;

    #Cria os breadcrumbs do site
    public function addBreadcrumb()
    {
        $Contador=count($this->parseUrl());
        $ArrayLink[0]='';
        echo "<a href=".DIRPAGE.">site</a>";
        for($I=0; $I < $Contador; $I++){
            $ArrayLink[0].=$this->parseUrl()[$I].'/';
            if($this->parseUrl()[$I] != ""){
              echo " > <a href=".DIRPAGE.$ArrayLink[0].">".$this->parseUrl()[$I]."</a>";
            }
        }
    }
}