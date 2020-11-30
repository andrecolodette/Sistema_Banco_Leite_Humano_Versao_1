<?php

#Arquivos diretórios raízes
$PastaInterna="Projetos/leiticia/";
define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$PastaInterna}");
if(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/'){
    define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$PastaInterna}");
} else{
    define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}");
}

#Diretórios Específicos
define('DIRIMG',DIRPAGE."Public/img/");
define('DIRCSS',DIRPAGE."Public/css/");
define('DIRJS',DIRPAGE."Public/js/");
define('DIRFILE',DIRPAGE."Public/file/");

#Acesso ao banco de dados
define('HOST',"localhost");
define('DB',"leiticia");
define('USER',"root");
define('PASSWORD',"");

#Outras Definições
define("DOMAIN",$_SERVER["HTTP_HOST"]);

/*
#Arquivos diretórios raízes
$PastaInterna="leiticia/";
define('DIRPAGE',"https://{$_SERVER['HTTP_HOST']}/{$PastaInterna}");
if(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/'){
    define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$PastaInterna}");
} else{
    define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}/{$PastaInterna}");
}

#Diretórios Específicos
define('DIRIMG',DIRPAGE."Public/img/");
define('DIRCSS',DIRPAGE."Public/css/");
define('DIRJS',DIRPAGE."Public/js/");
define('DIRFILE',DIRPAGE."Public/file/");

#Acesso ao banco de dados
define('HOST',"localhost");
define('DB',"id14625923_leiticia_teste");
define('USER',"id14625923_leiticia");
define('PASSWORD',"rArcm}k(0-}]d4gq");

#Outras Definições
define("DOMAIN",$_SERVER["HTTP_HOST"]);
*/
