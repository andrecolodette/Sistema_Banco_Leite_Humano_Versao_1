<!--Menu Secundário - de Opções-->
<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."postagem"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<!--Form-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">

        <?php
        $controle = DIRPAGE."ControllerPostagem";
        /*Formulario*/
        $form = "formCadastro";
        $action = $controle."/cadastrar";
        /*Variáveis*/
        $id = 0;
        $titulo = "";
        $descricao = "";
        $imgAnt = "";
        /*Campos Obrigatórios*/
        $imgReq = "required";
        $arqReq = "required";

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
                $id = $dados['id_postagem'];
                $titulo = $dados['titulo'];
                $descricao = $dados['descricao'];
                $imgAnt = $dados['imagem'];
            }
            /*Formulario*/
            $form = "formAtualizar";
            $action = $controle."/atualizar";
            /*Campos Obrigatórios*/
            $imgReq = "";
            $arqReq = "";
        }
        ?>

        <div class="divForm">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formPostagemId" name="formPostagemId" value="<?php echo $id; ?>">
                <input type="hidden" id="formPostagemImgAnt" name="formPostagemImgAnt" value="<?php echo $imgAnt; ?>">

                <div class="divFormCorpo">

                    <div class="divFormColuna wp50 floatL">

                        <div class="divCamposForm wp100">
                            <label class="labelForm">Título da Postagem
                                <input class="campoForm" type="text" id="formPostagemTitulo" name="formPostagemTitulo" value="<?php echo $titulo; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp100 hf150" style="height: 150px;">
                            <label class="labelForm">Breve Descrição
                                <textarea class="campoForm" id="formPostagemDescricao" name="formPostagemDescricao" maxlength="200" required></textarea>
                            </label>
                        </div>
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Arquivo da Postagem
                                <input class="campoForm" type="file" id="formPostagemArquivo" name="formPostagemArquivo" value="" <?php echo $arqReq; ?>>
                            </label>
                        </div>

                    </div>

                    <div class="divFormColuna wp50 floatL">
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Imagem da Postagem
                                <input class="campoForm" type="file" id="formPostagemImagem" name="formPostagemImagem" value="" <?php echo $imgReq; ?>>
                            </label>
                        </div>
                        <div class="divFormImgPrevia" id="divFormImgPrevia">
                            <?php
                            if($this->DadosDB != NULL){
                                echo "<img src='".DIRIMG."Postagem/$imgAnt'>";
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
                            echo "<a class='buttonBasico' href='".DIRPAGE."Postagemshow'>Cancelar!</a> ";
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
