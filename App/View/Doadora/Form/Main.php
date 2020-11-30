<!--Menu Secundário - de Opções-->
<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."doadora/cadastro"; ?>">Novo</a></li>
            <li class=""><a href="<?php echo DIRPAGE."doadora"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<!--Form-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">

        <?php
        $controle = DIRPAGE."ControllerDoadora";
        /*Formulario*/
        $form = "formCadastro";
        $action = $controle."/cadastrar";
        /*Variáveis*/
        $id = 0;
        $nome = "";
        $rg = "";
        $cpf = "";
        $cartao_sus = "";
        $data_nasc = "";
        $celular = "";
        $estado = "";
        $cidade = "";
        $bairro = "";
        $cep = "";
        $endereco = "";
        $status = "";

        $statusChecked_S = "";
        $statusChecked_N = "";

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
              $id = $dados['id_doadora'];
              $nome = $dados['nome'];
              $rg = $dados['rg'];
              $cpf = $dados['cpf'];
              $cartao_sus = $dados['cartao_sus'];
              $data_nasc = $dados['data_nasc'];
              $celular = $dados['celular'];
              $estado = $dados['estado'];
              $cidade = $dados['cidade'];
              $bairro = $dados['bairro'];
              $cep = $dados['cep'];
              $endereco = $dados['endereco'];
              $status = $dados['status_doando'];
            }
            /*Formulario*/
            $form = "formAtualizar";
            $action = $controle."/atualizar";

            if($status == 'S'){
                $statusChecked_S = "checked";
            }else{
                $statusChecked_N = "checked";
            }
        }
        ?>

        <div class="divForm">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formDoadoraId" name="formDoadoraId" value="<?php echo $id; ?>">

                <div class="divFormCorpo">

                    <div class="divFormColuna wp100 floatL">

                        <div class="divCamposForm wp50">
                            <label class="labelForm">Nome
                                <input class="campoForm" type="text" id="formDoadoraNome" name="formDoadoraNome" value="<?php echo $nome; ?>" required >
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">RG
                                <input class="campoForm" type="text" id="formDoadoraRg" name="formDoadoraRg" value="<?php echo $rg; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">CPF
                                <input class="campoForm" type="text" id="formDoadoraCpf" name="formDoadoraCpf" value="<?php echo $cpf; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Cartão do SUS
                                <input class="campoForm" type="text" id="formDoadoraCartaoSus" name="formDoadoraCartaoSus" value="<?php echo $cartao_sus; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp20">
                            <label class="labelForm">Data de Nascimento
                                <input class="campoForm" type="date" id="formDoadoraNascimento" name="formDoadoraNascimento" value="<?php echo $data_nasc; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Celular
                                <input class="campoForm" type="text" id="formDoadoraCelular" name="formDoadoraCelular" value="<?php echo $celular; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp10">
                            <label class="labelForm">Estado
                                <input class="campoForm" type="text" id="formDoadoraEstado" name="formDoadoraEstado" value="<?php echo $estado; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp20">
                            <label class="labelForm">CEP
                                <input class="campoForm" type="text" id="formDoadoraCep" name="formDoadoraCep" value="<?php echo $cep; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp33">
                            <label class="labelForm">Cidade
                                <input class="campoForm" type="text" id="formDoadoraCidade" name="formDoadoraCidade" value="<?php echo $cidade; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp33">
                            <label class="labelForm">Bairro
                                <input class="campoForm" type="text" id="formDoadoraBairro" name="formDoadoraBairro" value="<?php echo $bairro; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp33">
                            <label class="labelForm">Endereço
                                <input class="campoForm" type="text" id="formDoadoraEndereco" name="formDoadoraEndereco" value="<?php echo $endereco; ?>" required>
                            </label>
                        </div>

                    </div>

                    <!--<div class="divFormColuna wp50 floatL"></div> -->

                    <?php
                    if($this->DadosDB != NULL){
                        echo "<div class='wp20 marginAuto hf150' style='height:150px; margin:auto;'> \n";
                        echo "    <div class='divCamposForm wp100 marginAuto hf150' style='height:150px; margin: auto;'> \n";
                        echo "        <br/><label class='labelFormMarcar textCenter' style='font-size: 30px;'>Status</label><br/><br/> \n";
                        echo "        <label class='campoMarcar wp50'> \n";
                        echo "            <input type='radio' id='formDoadoraStatus' name='formDoadoraStatus' value='S' $statusChecked_S> \n";
                        echo "            <p>Doando</p>";
                        echo "        </label> \n";
                        echo "        <label class='campoMarcar wp50'> \n";
                        echo "            <input type='radio' id='formDoadoraStatus' name='formDoadoraStatus' value='N' $statusChecked_N> \n";
                        echo "            <p>Inativa</p>";
                        echo "        </label> \n";
                        echo "</div> \n";
                    }
                    ?>
                    <!--
                    <div class="wp20 marginAuto hf150" style="height:150px; margin:auto;">
                    <div class="divCamposForm wp100 marginAuto hf150" style="height:150px; margin: auto;">
                        <br/><label class="labelFormMarcar textCenter" style="font-size: 30px;">Status</label><br/><br/>
                        <label class="campoMarcar wp50">
                            <input type="radio" id="formGestacaoAprovada" name="formGestacaoAprovada" value="1" <?php if($status == 1){echo "checked";} ?>>
                            <p>Doando</p>
                        </label>
                        <label class="campoMarcar wp50">
                            <input type="radio" id="formGestacaoAprovada" name="formGestacaoAprovada" value="0" <?php if($status == 0){echo "checked";} ?>>
                            <p>Inativa</p>
                        </label>
                    </div>
                    </div>
                    -->
                </div>

                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li>
                        <?php
                        if($this->DadosDB != NULL){
                            echo "<a class='buttonBasico' href='".DIRPAGE."doadora/visualizar/$id'>Cancelar!</a> ";
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
