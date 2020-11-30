<?php
namespace Src\Classes;

use Src\Traits\TraitGetIp;

class ClassSessions{

    //private $timeSession=1200;
    //private $timeCanary=300;

    public function __construct()
    {
        if(session_id() == ''){
            ini_set("session.save_handler","files");
            ini_set("session.use_cookies",1);
            ini_set("session.use_only_cookies",1);
            ini_set("session.cookie_domain",DOMAIN);
            ini_set("session.cookie_httponly",1);
            if(DOMAIN != "localhost"){ini_set("session.cookie_secure",1);}
            /*Criptografia das nossas sessions*/
            ini_set("session.entropy_length",512);
            ini_set("session.entropy_file",'/dev/urandom');
            ini_set("session.hash_function",'sha256');
            ini_set("session.hash_bits_per_character",5);
            session_start();
        }
    }

    #Proteger contra roubo de sessão
    public function setSessionCanary($par=null)
    {
        session_regenerate_id(true);
        if($par == null){
            $_SESSION['canary']=[
                "birth" => time(),
                "IP" => TraitGetIp::getUserIp()
            ];
        }else{
            $_SESSION['canary']['birth']=time();
        }
    }

    #Verificar a integridade da sessão
    public function verifyIdSessions()
    {
        if(!isset($_SESSION['canary'])){
            $this->setSessionCanary();
        }

        if($_SESSION['canary']['IP'] !== TraitGetIp::getUserIp()){
            $this->destructSessions();
            $this->setSessionCanary();
        }

        /*
        if($_SESSION['canary']['birth'] < time() - $this->timeCanary){
            $this->setSessionCanary("time");
        }
        */
    }

    #Setar as sessões do nosso sistema
    public function setSessions($nome, $id, $usuario, $administrador)
    {
        $this->verifyIdSessions();

        $_SESSION["login"]=true;
        $_SESSION["time"]=time();
        $_SESSION['name'] = $nome;
        $_SESSION["id"] = $id;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["admin"] = $administrador;
    }
    #Verificar se há uma Session
    public function verifyThereIsSession()
    {
        $this->verifyIdSessions();
        if(isset($_SESSION['login']) & isset($_SESSION['admin']) & isset($_SESSION['canary'])){
            //Há uma session
            //header("Location: ".DIRPAGE."slideshow");
            //die();
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getSessionId(){ return $_SESSION['id']; }

    #Validar as páginas internas do sistema
    public function verifyInsideSession($restrito = FALSE)
    {
        $this->verifyIdSessions();
        if(!isset($_SESSION['login']) || !isset($_SESSION['admin']) || !isset($_SESSION['id']) || !isset($_SESSION['canary'])){
            $this->destructSessions();
            //Não há uma session
            echo "
                <script>
                    alert('Você não está logado');
                    window.location.href='".DIRPAGE."login';
                </script>
            ";
        }elseif($restrito){
            if(!$_SESSION['admin']){
                //Não é um administrador ou a página é restrita
                echo "
                <script>
                    alert('Você não tem acesso a este conteúdo!');
                    window.location.href='".DIRPAGE."login';
                </script>
                ";
            }
        }

    }

    #Destruir as sessions existentes
    public function destructSessions()
    {
        foreach (array_keys($_SESSION) as $key) {
            unset($_SESSION[$key]);
        }
    }

}
