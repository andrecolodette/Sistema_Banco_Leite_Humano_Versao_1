<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassFile;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;

class ControllerSlideShow
{
    /*Atributos*/
    private $crud;
    private $file;
    private $validate;
    private $msgAlerta;

    private $id, $titulo, $imagem, $link;
    private $imgAnt;

    /*Métods*/
    //Construtor
    public function __construct()
    {
        $this->crud = new ClassCrud();
        $this->file = new ClassFile();
        $this->file->setFormatos(array("jpg", "png", "jpeg", "gif"));
        $this->file->setPasta(DIRREQ."Public/img/slide/");
        $this->file->setNewName("slide_");
        $this->validate = new ClassValidateCampos();
        $this->msgAlerta = new ClassMensagemAlerta();
    }

    //Receber Variaveis Form
    private function recVariableForm()
    {
        if(isset($_POST['formSlideId'])){
            $this->id = $_POST['formSlideId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST["formSlideTitulo"])){
            $this->titulo = filter_input(INPUT_POST,"formSlideTitulo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->titulo = NULL;
        }
        if(isset($_POST["formSlideLink"])){
            $this->link = filter_input(INPUT_POST,"formSlideLink",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->link = NULL;
        }

        if(isset($_POST['formSlideImgAnt'])){
            $this->imgAnt = $_POST['formSlideImgAnt'];
        }else{
            $this->imgAnt = NULL;
        }
    }

    //Validar Variaveis
    private function validarCampos($atualizar = FALSE)
    {
        $this->recVariableForm();

        if(!$atualizar){
            if(!$this->file->receberFile("formSlideImagem")){
                $erro = "É necessário uma imagem!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }else{
                if($this->file->verificarExtencao()){
                    $nome = "slide_";
                    $num = 1;
                    $this->file->setNewName($nome.$num);
                    while ($this->file->existeArquivo()){
                        $num++;
                        $this->file->setNewName($nome.$num);
                    }
                    $ext = $this->file->getFileExt();
                    $this->imagem = $nome.$num.".".$ext;
                    return TRUE;
                }else{
                    $erro = "Imagem com formato não permitido!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                    return FALSE;
                }
            }
        }else{
            if($this->file->receberFile("formSlideImagem")){
                if($this->file->verificarExtencao()){
                    $nome = "slide_";
                    $num = 1;
                    $this->file->setNewName($nome.$num);
                    while ($this->file->existeArquivo()){
                        $num++;
                        $this->file->setNewName($nome.$num);
                    }
                    $ext = $this->file->getFileExt();
                    $this->imagem = $nome.$num.".".$ext;
                    return TRUE;
                }else{
                    $erro = "Imagem com formato não permitido!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                    return FALSE;
                }
            }else{
                $this->imagem = $this->imgAnt;
                return TRUE;
            }
        }
    }

    //Cadastrar
    public function cadastrar()
    {
        if($this->validarCampos(FALSE)){
            if($this->file->enviarArquivo()){
                if($this->crud->insertDB(
                    "slide_show",
                    "?,?,?,?",
                    array(
                      $this->id,
                      $this->titulo,
                      $this->imagem,
                      $this->link
                    ))){
                      $msg = "Cadastro Realizado!";
                      $this->msgAlerta->setSucesso(TRUE);
                      $this->msgAlerta->setMensagem($msg);

                }else{
                    $this->file->removerArquivo();
                    $erro = "Falha ao cadastrar no Banco de Dados!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }else{
                $erro = "Falha ao enviar a imagem!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Atualizar
    public function atualizar()
    {
        if($this->validarCampos(TRUE)){
            if($this->file->getHaFile()){
                if($this->file->enviarArquivo()){
                    if($this->crud->updateDB(
                        "slide_show",
                        "titulo = ?, imagem = ?, link = ?",
                        "id_slide_show = ?",
                        array(
                            $this->titulo,
                            $this->imagem,
                            $this->link,
                            $this->id,
                        )
                    )){

                        if($this->file->existeArquivo($this->imgAnt)){
                            if(!$this->file->removerArquivo($this->imgAnt)){
                                $erro = "Falha ao remover a imagem antiga!";
                                $this->msgAlerta->setSucesso(FALSE);
                                $this->msgAlerta->setMensagem($erro);
                            }
                        }

                        $msg = "Sucesso na Atualização!";
                        $this->msgAlerta->setSucesso(TRUE);
                        $this->msgAlerta->setMensagem($msg);

                    }else{
                        $this->file->removerArquivo();
                        $erro = "Falha na atualização no Banco de Dados!";
                        $this->msgAlerta->setSucesso(FALSE);
                        $this->msgAlerta->setMensagem($erro);
                    }
                }else{
                    $erro = "Falha ao enviar a imagem!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }else{
                if($this->crud->updateDB(
                    "slide_show",
                    "titulo = ?, imagem = ?, link = ?",
                    "id_slide_show = ?",
                    array(
                        $this->titulo,
                        $this->imagem,
                        $this->link,
                        $this->id,
                    )
                )){

                    $msg = "Sucesso na Atualização!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($msg);

                }else{
                    $erro = "Falha na atualização no Banco de Dados!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Excluir
    public function excluir($ID)
    {
        $slide = $this->buscar($ID);
        $img = "";
        foreach($slide as $registro){
            $img = $registro['imagem'];
        }

        if($this->crud->deleteDB(
            "slide_show",
            "id_slide_show = ?",
            array($ID)
          )){
              if($this->file->existeArquivo($img)){
                  if(!$this->file->removerArquivo($img)){
                      $erro = "Falha ao remover a imagem antiga!";
                      $this->msgAlerta->setSucesso(FALSE);
                      $this->msgAlerta->setMensagem($erro);
                  }
              }
              $msg = "Sucesso ao Excluir!";
              $this->msgAlerta->setSucesso(TRUE);
              $this->msgAlerta->setMensagem($msg);
          }else{
              $erro = "Falha ao excluir!";
              $this->msgAlerta->setSucesso(FALSE);
              $this->msgAlerta->setMensagem($erro);
          }

          $this->msgAlerta->validateFinalMensagem();
    }

    //Listar
    public function listar()
    {
        return $this->crud->selectDB(
            "*",
            "slide_show",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "slide_show",
            "WHERE id_slide_show = ?",
            array($ID));
    }
}
