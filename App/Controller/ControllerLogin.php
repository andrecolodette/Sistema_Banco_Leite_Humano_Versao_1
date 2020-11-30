<?php

namespace App\Controller;

use App\Model\ClassCRUD;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;
use Src\Classes\ClassPassword;
use Src\Classes\ClassSessions;

class ControllerLogin
{
    /*Atributos*/
    private $crud;
    private $validate;
    private $msgAlerta;
    private $password;
    private $session;

    private $usuario, $hashSenha;
    private $senha = NULL;

    /*Métods*/
    //Construtor
    public function __construct()
    {
        $this->crud = new ClassCrud();

        $this->validate = new ClassValidateCampos();
        $this->msgAlerta = new ClassMensagemAlerta();
        $this->password = new ClassPassword();
        $this->session = new ClassSessions();
    }

    //Receber Variaveis Form
    private function recVariableForm()
    {
        if(isset($_POST["formLoginUsuario"])){
            $this->usuario = filter_input(INPUT_POST,"formLoginUsuario",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->usuario = NULL;
        }
        if(isset($_POST['formLoginSenha'])){
            $this->senha = $_POST['formLoginSenha'];
            $this->hashSenha = $this->password->passwordHash($this->senha);
        }else{
            $this->hashSenha = NULL;
        }
    }

    //Validar Variaveis
    private function validarCampos()
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(array($this->usuario, $this->senha))){
            $erro = "Preencha todos os campos!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }else{
            return TRUE;
        }
    }

    //Logar
    public function logar()
    {
        if($this->validarCampos()){

            $reg = $this->crud->selectDB(
                "*",
                "funcionario",
                "WHERE usuario = ? AND ativo != 0",
                array($this->usuario));

            if(!($reg->rowCount()) == 1){
                $erro = "Usuário ou Senha incorreto!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }else{
                foreach($reg as $funcionario){
                    if(!$this->password->verifyHash($this->senha, $funcionario['senha'])){
                        $erro = "Usuário ou Senha incorreto!";
                        $this->msgAlerta->setSucesso(FALSE);
                        $this->msgAlerta->setMensagem($erro);
                    }else{
                        $msg = "Login Realizado";
                        $this->msgAlerta->setSucesso(TRUE);
                        $this->msgAlerta->setMensagem($msg);
                        $url = DIRPAGE."home";
                        $this->msgAlerta->setURL($url);

                        $admin = FALSE;
                        if($funcionario['administrador'] == "1"){
                            $admin = TRUE;
                        }

                        $this->session->setSessions(
                            $funcionario['nome'],
                            $funcionario['id_funcionario'],
                            $funcionario['usuario'],
                            $admin);

                        //header("Location: ".DIRPAGE."slideshow");
                        //die();
                    }
                }
            }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    public function logout(){
        $this->session->destructSessions();
        echo "
            <script>
                alert('Você efetuou o logout!');
                window.location.href='".DIRPAGE."';
            </script>
          ";
    }

}
