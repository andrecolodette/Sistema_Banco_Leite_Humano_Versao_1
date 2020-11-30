<?php
namespace Src\Classes;

class ClassFile
{
    //Atributos
    private $File = NULL;
    private $FileExt;
    private $Formatos = array();
    private $Pasta; //Local para o Upload
    private $NewName = null;

    private $HaFile = FALSE;

    public function getFormatos(){ return $this->Formatos; }
    public function setFormatos($Formatos){ $this->Formatos = $Formatos; }
    public function getPasta(){ return $this->Pasta; }
    public function setPasta($Pasta){ $this->Pasta = $Pasta; }
    public function getNewNames(){ return $this->NewName; }
    public function setNewName($NewName){ $this->NewName = $NewName; }

    public function getFileExt(){ return $this->FileExt; }

    public function getHaFile(){ return $this->HaFile; }

    //Recebe o arquivo do formulário
    public function receberFile($filePost)
    {
        if(is_uploaded_file($_FILES[$filePost]['tmp_name']))
        {
            $this->File = $_FILES[$filePost];
            $this->FileExt = pathinfo($this->File['name'], PATHINFO_EXTENSION);
            $this->HaFile = TRUE;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Verifica se o arquivo possui a extenção esperada
    public function verificarExtencao()
    {
        if(in_array($this->FileExt, $this->Formatos))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Verifica se na Pata existe um arquivo com o mesmo nome
    // Se exixtir -> retorna TRUE
    public function existeArquivo($arquivo = NULL)
    {
        if($arquivo == NULL){
            if(file_exists("$this->Pasta$this->NewName.$this->FileExt"))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }else{
            if(file_exists("$this->Pasta$arquivo"))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }

    //Envia o Arquivo (Upload) para sua $Pasta
    public function enviarArquivo()
    {
        if(move_uploaded_file($this->File['tmp_name'], "$this->Pasta$this->NewName.$this->FileExt"))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Remove o arquivo da pasta
    public function removerArquivo($arquivo = NULL)
    {
        if($arquivo == NULL){
            if(unlink("$this->Pasta$this->NewName.$this->FileExt"))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }else{
            if(unlink("$this->Pasta$arquivo"))
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }

}
