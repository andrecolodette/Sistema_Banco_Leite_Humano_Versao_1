<?php
namespace Src\Classes;

class ClassRender{

    #Propriedades
    private $Dir;
    private $Title;
    private $Description;
    private $Keywords;
    private $Author;

    private $Layout = "Layout_Basico";

    public function getDir() { return $this->Dir; }
    public function setDir($Dir) { $this->Dir = $Dir; }
    public function getTitle() { return $this->Title; }
    public function setTitle($Title) { $this->Title = $Title; }
    public function getDescription() { return $this->Description; }
    public function setDescription($Description) { $this->Description = $Description; }
    public function getKeywords() { return $this->Keywords; }
    public function setKeywords($Keywords) { $this->Keywords = $Keywords; }
    public function getAuthor() { return $this->Author; }
    public function setAuthor($Author) { $this->Author = $Author; }

    public function getLayout() { return $this->Layout; }
    public function setLayout($Layout) { $this->Layout = $Layout; }

    #Método responsável por renderizar todos o layout
    public function renderLayout()
    {
        if(file_exists(DIRREQ."App/View/Layout/{$this->getLayout()}.php")){
            include(DIRREQ."App/View/Layout/{$this->getLayout()}.php");
        }else {
            include_once(DIRREQ."App/View/Layout/Layout.php");
        }
    }

    #Adiciona características específicas no head
    public function addHead()
    {
        if(file_exists(DIRREQ."App/View/{$this->getDir()}/Head.php")){
            include(DIRREQ."App/View/{$this->getDir()}/Head.php");
        }
    }

    #Adiciona características específicas no header
    public function addHeader()
    {
        if(file_exists(DIRREQ."App/View/{$this->getDir()}/Header.php")){
            include(DIRREQ."App/View/{$this->getDir()}/Header.php");
        }
    }

    #Adiciona características específicas no main
    public function addMain()
    {
        if(file_exists(DIRREQ."App/View/{$this->getDir()}/Main.php")){
            include(DIRREQ."App/View/{$this->getDir()}/Main.php");
        }
    }

    #Adiciona características específicas no footer
    public function addFooter()
    {
        if(file_exists(DIRREQ."App/View/{$this->getDir()}/Footer.php")){
            include(DIRREQ."App/View/{$this->getDir()}/Footer.php");
        }
    }

}
