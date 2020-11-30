<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."slideshow/cadastro"; ?>">Novo</a></li>
            <li class=""><a href="<?php echo DIRPAGE."slideshow"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">

        <?php
        $form = "formCadastro";
        $controle = DIRPAGE."ControllerSlideShow";
        $action = $controle."/cadastrar";
        $id = 0;
        $imgAnt = "";
        $titulo = "";
        //$imagem = "";
        $link = "";
        $imgReq = "required";

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
                $id = $dados['id_slide_show'];
                $imgAnt = $dados['imagem'];
                $titulo = $dados['titulo'];
                //$imagem = "";
                $link = $dados['link'];
            }
            $form = "formAtualizar";
            $action = $controle."/atualizar";
            $imgReq = "";
        }
        ?>

        <div class="divForm">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formSlideId" name="formSlideId" value="<?php echo $id; ?>">
                <input type="hidden" id="formSlideImgAnt" name="formSlideImgAnt" value="<?php echo $imgAnt; ?>">

                <div class="divFormCorpo">

                    <div class="divFormColuna wp50 floatL">

                        <div class="divCamposForm wp100">
                            <label class="labelForm">Título do Slide
                                <input class="campoForm" type="text" id="formSlideTitulo" name="formSlideTitulo" value="<?php echo $titulo; ?>">
                            </label>
                        </div>
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Link do Slide
                                <input class="campoForm" type="url" id="formSlideLink" name="formSlideLink" value="<?php echo $link; ?>">
                            </label>
                        </div>
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Imagem do Slide
                                <input class="campoForm" type="file" id="formSlideImagem" name="formSlideImagem" value="" <?php echo $imgReq; ?>>
                            </label>
                        </div>

                    </div>

                    <div class="divFormColuna wp50 floatL">
                        <div class="divFormImgPrevia" id="divFormImgPrevia">
                            <?php
                            if($this->DadosDB != NULL){
                                echo "<img src='".DIRIMG."slide/$imgAnt'>";
                            }
                            ?>
                        </div>
                    </div>

                </div>

                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li>
                        <?php
                        if($this->DadosDB != NULL){
                            echo "<a class='buttonBasico' href='".DIRPAGE."slideshow'>Cancelar!</a> ";
                        }else{
                            echo "<input class='buttonBasico' type='reset', value='Limpar!'> ";
                        }
                        ?>
                        </li>
                    </ul>
                </div>

            </form>
        </div>

    </div>
</div>
