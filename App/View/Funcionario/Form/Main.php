<!--Menu Secundário - de Opções-->
<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."funcionario/cadastro"; ?>">Novo</a></li>
            <li class=""><a href="<?php echo DIRPAGE."funcionario"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<!--Form-->
<div class="DivPosicaoConteudo">
    <!--<div class="DivAreaConteudo conteudoCor">-->
    <div class="DivAreaConteudo">

        <?php
        $controle = DIRPAGE."ControllerFuncionario";
        /*Formulario*/
        $form = "formCadastro";
        $action = $controle."/cadastrar";
        /*Variáveis*/
        $id = 0;
        $nome = "";
        $usuario = "";
        $senha = "";
        $senhaConfirma = "";

        $administrador = "";
        $ativo = "";

        $disabledNome = "";
        $disabledUsuario = "";

        $wp = "wp33";

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
                $id = $dados['id_funcionario'];
                $nome = $dados['nome'];
                $usuario = $dados['usuario'];
                $administrador = $dados['administrador'];
                $ativo = $dados['ativo'];
            }

            if($administrador == "1"){ $adminCheck = "checked"; }
            if($ativo == "1"){ $ativoCheck = "checked"; }

            /*Formulario*/
            $form = "formAtualizar";
            $action = $controle."/atualizar";

            $wp = "wp50";
            $disabledNome = "disabled";
            $disabledUsuario = "disabled";
        }
        ?>

        <div class="divForm wp100 floatL">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formFuncionarioId" name="formFuncionarioId" value="<?php echo $id; ?>">

                <div class="divFormCorpo">

                    <div class="divFormColuna wp100 floatL">

                        <div class="divCamposForm wp50">
                            <label class="labelForm">Nome do Funcionário
                                <input class="campoForm" type="text" id="formFuncionarioNome" name="formFuncionarioNome" value="<?php echo $nome; ?>" required <?php echo $disabledNome; ?>>
                            </label>
                        </div>

                        <?php
                        if($this->DadosDB == NULL){
                            echo "<div class='divCamposForm wp50'> \n";
                            echo "    <label class='labelFormMarcar'></label> \n";
                            echo "    <label class='campoMarcar wp25'> \n";
                            echo "        <input type='checkbox' id='formFuncionarioAdministrador' name='formFuncionarioAdministrador' value='TRUE'> \n";
                            echo "        <p>Administrador</p>\n";
                            echo "    </label> \n";
                            echo "</div> \n";
                        }
                        ?>

                        <div class="divCamposForm <?php echo $wp; ?>">
                            <label class="labelForm">Usuário
                                <input class="campoForm" type="text" id="formFuncionarioUsuario" name="formFuncionarioUsuario" value="<?php echo $usuario; ?>" required <?php echo $disabledUsuario; ?>>
                            </label>
                        </div>

                        <?php
                        if($this->DadosDB == NULL){
                            echo "<div class='divCamposForm wp33'> \n";
                            echo "    <label class='labelForm'>Senha \n";
                            echo "        <input class='campoForm' type='password' id='formFuncionarioSenha' name='formFuncionarioSenha' required> \n";
                            echo "    </label> \n";
                            echo "</div> \n";

                            echo "<div class='divCamposForm wp33'> \n";
                            echo "    <label class='labelForm'>Confirme a Senha \n";
                            echo "        <input class='campoForm' type='password' id='formFuncionarioSenhaConfirme' name='formFuncionarioSenhaConfirme' required> \n";
                            echo "    </label> \n";
                            echo "</div> \n";
                        }else{
                            echo "<div class='divCamposForm wp50'> \n";
                            echo "    <label class='labelFormMarcar'></label> \n";
                            echo "    <label class='campoMarcar wp25'> \n";
                            echo "        <input type='checkbox' id='formFuncionarioAdministrador' name='formFuncionarioAdministrador' value='TRUE' $adminCheck> \n";
                            echo "        <p>Administrador</p>\n";
                            echo "    </label> \n";
                            echo "</div> \n";

                            echo "<div class='divCamposForm wp50'> \n";
                            echo "    <label class='labelFormMarcar'></label> \n";
                            echo "    <label class='campoMarcar wp25'> \n";
                            echo "        <input type='checkbox' id='formFuncionarioAtivo' name='formFuncionarioAtivo' value='TRUE' $ativoCheck> \n";
                            echo "        <p>Ativo</p>\n";
                            echo "    </label> \n";
                            echo "</div> \n";
                        }
                        ?>

                    </div>
                </div>

                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li>
                        <?php
                        if($this->DadosDB != NULL){
                            echo "<a class='buttonBasico' href='".DIRPAGE."funcionario'>Cancelar!</a> ";
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
