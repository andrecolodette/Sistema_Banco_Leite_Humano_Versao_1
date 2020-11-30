<!--Menu Secundário - de Opções-->
<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."conformidade/cadastro"; ?>">Novo</a></li>
            <li class=""><a href="<?php echo DIRPAGE."conformidade"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<!--Form-->
<div class="DivPosicaoConteudo">
    <!--<div class="DivAreaConteudo conteudoCor">-->
    <div class="DivAreaConteudo">

        <?php
        $controle = DIRPAGE."ControllerConformidade";
        /*Formulario*/
        $form = "formCadastro";
        $action = $controle."/cadastrar";
        /*Variáveis*/
        $id = 0;
        $codigo = "";
        $data = "";
        $pasteurizacao = "";
        $funcionario = "";

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
            }

            /*Formulario*/
            $form = "formAtualizar";
            $action = $controle."/atualizar";
        }
        ?>

        <div class="divForm wp100 floatL">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formLoteId" name="formLoteId" value="<?php echo $id; ?>">

                <div class="divFormCorpo">
                    <div class="divFormColuna wp100 floatL">

                        <div class="divCamposForm wp25">
                            <label class="labelForm">Código do Lote
                                <input class="campoForm" type="text" id="formLoteCodigo" name="formLoteCodigo" value="<?php echo $codigo; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp25">
                            <label class="labelForm">Data do Lote
                                <input class="campoForm" type="date" id="formLoteCodigo" name="formLoteCodigo" value="<?php echo $codigo; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp50">
                            <label class="labelForm">Funcionário
                                <input class="campoForm" type="text" id="formLoteCodigo" name="formLoteCodigo" value="<?php echo $codigo; ?>" required>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li>
                        <?php
                        if($this->DadosDB != NULL){
                            echo "<a class='buttonBasico' href='".DIRPAGE."conformidade'>Cancelar!</a> ";
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
