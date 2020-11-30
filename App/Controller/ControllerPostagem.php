<?php

namespace App\Controller;

$session = new \Src\Classes\ClassSessions();
$session->verifyInsideSession(false);

use App\Model\ClassCRUD;
use Src\Classes\ClassFile;
use Src\Classes\ClassValidateCampos;
use Src\Classes\ClassMensagemAlerta;

class ControllerPostagem
{
    /*Atributos*/
    private $crud;
    private $file_img;
    private $file_arq;
    private $validate;
    private $msgAlerta;

    private $id, $titulo, $descricao, $arquivo, $imagem;
    private $arqAnt, $imgAnt;

    /*Métods*/
    //Construtor
    public function __construct()
    {
        $this->crud = new ClassCrud();

        $this->file_img = new ClassFile();
        $this->file_img->setFormatos(array("jpg", "png", "jpeg", "gif"));
        $this->file_img->setPasta(DIRREQ."Public/img/postagem/");
        $this->file_img->setNewName("postagem_");

        $this->file_arq = new ClassFile();
        $this->file_arq->setFormatos(array("pdf"));
        $this->file_arq->setPasta(DIRREQ."Public/file/postagem/");
        $this->file_arq->setNewName("postagem_");

        $this->validate = new ClassValidateCampos();
        $this->msgAlerta = new ClassMensagemAlerta();
    }

    //Receber Variaveis Form
    private function recVariableForm()
    {
        if(isset($_POST['formPostagemId'])){
            $this->id = $_POST['formPostagemId'];
        }else{
            $this->id = 0;
        }
        if(isset($_POST["formPostagemTitulo"])){
            $this->titulo = filter_input(INPUT_POST,"formPostagemTitulo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->titulo = NULL;
        }
        if(isset($_POST["formPostagemDescricao"])){
            $this->descricao = filter_input(INPUT_POST,"formPostagemDescricao",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else{
            $this->descricao = NULL;
        }
    }

    //Validar Variaveis
    private function validarCampos($atualizar = FALSE)
    {
        $this->recVariableForm();

        if(!$this->validate->validateFields(array($this->titulo, $this->descricao))){
            $erro = "Preencha todos os campos!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }elseif(!$this->validate->validateTamanhoMaximoTexto($this->descricao, 200)){
            $erro = "Descrição altrapassa o limite de 200 caracteres!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
            return FALSE;
        }

        if(!$atualizar){
            if(!$this->file_img->receberFile("formPostagemImagem")){
                $erro = "É necessário uma imagem!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }elseif(!$this->file_arq->receberFile("formPostagemArquivo")){
                $erro = "É necessário um arquivo!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
                return FALSE;
            }else{
                if(!$this->file_img->verificarExtencao()){
                    $erro = "Imagem com formato não permitido!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                    return FALSE;
                }elseif(!$this->file_arq->verificarExtencao()){
                    $erro = "Arquivo com formato não permitido!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                    return FALSE;
                }else{
                    //Imagem
                    $nome = "postagem_";
                    $num = 1;
                    $this->file_img->setNewName($nome.$num);
                    while($this->file_img->existeArquivo()){
                        $num++;
                        $this->file_img->setNewName($nome.$num);
                    }
                    $ext = $this->file_img->getFileExt();
                    $this->imagem = $nome.$num.".".$ext;

                    //Arquivo
                    $nome = "postagem_";
                    $num = 1;
                    $this->file_arq->setNewName($nome.$num);
                    while($this->file_arq->existeArquivo()){
                        $num++;
                        $this->file_arq->setNewName($nome.$num);
                    }
                    $ext = $this->file_arq->getFileExt();
                    $this->arquivo = $nome.$num.".".$ext;

                    return TRUE;
                }
            }
        }else{/*Atualização*/
            /*Nova Imagem*/
            if($this->file_img->receberFile("formPostagemImagem")){
                if(!$this->file_img->verificarExtencao()){
                    $erro = "Imagem com formato não permitido!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                    return FALSE;
                }else{
                    $nome = "postagem_";
                    $num = 1;
                    $this->file_img->setNewName($nome.$num);
                    while($this->file_img->existeArquivo()){
                        $num++;
                        $this->file_img->setNewName($nome.$num);
                    }
                    $ext = $this->file_img->getFileExt();
                    $this->imagem = $nome.$num.".".$ext;
                }
            }

            /*Novo Arquivo*/
            if($this->file_arq->receberFile("formPostagemArquivo")){
                if(!$this->file_arq->verificarExtencao()){
                    $erro = "Arquivo com formato não permitido!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                    return FALSE;
                }else{
                    $nome = "postagem_";
                    $num = 1;
                    $this->file_arq->setNewName($nome.$num);
                    while($this->file_arq->existeArquivo()){
                        $num++;
                        $this->file_arq->setNewName($nome.$num);
                    }
                    $ext = $this->file_arq->getFileExt();
                    $this->arquivo = $nome.$num.".".$ext;
                }
            }

            return TRUE;
        }

    }

    //Cadastrar
    public function cadastrar()
    {

        if($this->validarCampos(FALSE)){
            if(!$this->file_img->enviarArquivo()){
                $erro = "Falha ao enviar a imagem!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }elseif(!$this->file_arq->enviarArquivo()){
                $this->file_img->removerArquivo();
                $erro = "Falha ao enviar o arquivo!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }elseif($this->crud->insertDB(
                "postagem",
                "?,?,?,?,?",
                array(
                  $this->id,
                  $this->titulo,
                  $this->descricao,
                  $this->imagem,
                  $this->arquivo,
                ))){

                    $msg = "Cadastro Realizado!";
                    $this->msgAlerta->setSucesso(TRUE);
                    $this->msgAlerta->setMensagem($msg);

            }else{
                $this->file_img->removerArquivo();
                $this->file_arq->removerArquivo();

                $erro = "Falha ao cadastrar no Banco de Dados!";
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

            $postagem = $this->buscar($this->id);
            foreach($postagem as $post){
                $this->imgAnt = $post['imagem'];
                $this->arqAnt = $post['arquivo'];
            }

            if(!$this->file_img->getHaFile()){
                $this->imagem = $this->imgAnt;
            }elseif(!$this->file_img->enviarArquivo()){
                $erro = "Falha ao enviar a imagem!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }elseif($this->file_img->existeArquivo($this->imgAnt)){
                if(!$this->file_img->removerArquivo($this->imgAnt)){
                    $erro = "Falha ao remover a imagem antiga!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }

            if(!$this->file_arq->getHaFile()){
                $this->arquivo = $this->arqAnt;
            }elseif(!$this->file_arq->enviarArquivo()){
                $erro = "Falha ao enviar o arquivo!";
                $this->msgAlerta->setSucesso(FALSE);
                $this->msgAlerta->setMensagem($erro);
            }elseif($this->file_arq->existeArquivo($this->arqAnt)){
                if(!$this->file_arq->removerArquivo($this->arqAnt)){
                    $erro = "Falha ao remover o arquivo antigo!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }

            if($this->crud->updateDB(
                "postagem",
                "titulo = ?, descricao = ?, imagem = ?, arquivo = ?",
                "id_postagem = ?",
                array(
                    $this->titulo,
                    $this->descricao,
                    $this->imagem,
                    $this->arquivo,
                    $this->id
                )
              )){
                  $msg = "Sucesso na Atualização!";
                  $this->msgAlerta->setSucesso(TRUE);
                  $this->msgAlerta->setMensagem($msg);
              }else{
                  $this->file_img->removerArquivo();
                  $this->file_arq->removerArquivo();
                  $erro = "Falha na atualização no Banco de Dados!";
                  $this->msgAlerta->setSucesso(FALSE);
                  $this->msgAlerta->setMensagem($erro);
              }

        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Excluir
    public function excluir($ID)
    {
        $postagem = $this->buscar($ID);
        foreach($postagem as $post){
            $this->imgAnt = $post['imagem'];
            $this->arqAnt = $post['arquivo'];
        }

        if(!$this->crud->deleteDB(
            "postagem",
            "id_postagem = ?",
            array($ID)
        )){
            $erro = "Falha ao excluir!";
            $this->msgAlerta->setSucesso(FALSE);
            $this->msgAlerta->setMensagem($erro);
        }else{
            if($this->file_img->existeArquivo($this->imgAnt)){
                if(!$this->file_img->removerArquivo($this->imgAnt)){
                    $erro = "Falha ao remover a imagem antiga!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }
            if($this->file_arq->existeArquivo($this->arqAnt)){
                if(!$this->file_arq->removerArquivo($this->arqAnt)){
                    $erro = "Falha ao remover o arquivo antigo!";
                    $this->msgAlerta->setSucesso(FALSE);
                    $this->msgAlerta->setMensagem($erro);
                }
            }

            $msg = "Sucesso ao Excluir!";
            $this->msgAlerta->setSucesso(TRUE);
            $this->msgAlerta->setMensagem($msg);
        }

        $this->msgAlerta->validateFinalMensagem();
    }

    //Listar
    public function listar()
    {
        return $this->crud->selectDB(
            "*",
            "postagem",
            "",
            array());
    }

    //Buscar
    public function buscar($ID)
    {
        return $this->crud->selectDB(
            "*",
            "postagem",
            "WHERE id_postagem = ?",
            array($ID));
    }
}
