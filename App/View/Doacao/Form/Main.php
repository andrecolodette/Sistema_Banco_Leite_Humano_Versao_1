<!--Menu Secundário - de Opções-->
<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."doacao/cadastro"; ?>">Novo</a></li>
            <li class=""><a href="<?php echo DIRPAGE."doacao"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<!--Form-->
<div class="DivPosicaoConteudo">
    <!--<div class="DivAreaConteudo conteudoCor">-->
    <div class="DivAreaConteudo">

        <?php
        $controle = DIRPAGE."ControllerDoacao";
        /*Formulario*/
        $form = "formCadastro";
        $action = $controle."/cadastrar";
        /*Variáveis*/
        $id = 0;
        $id_doadora = NULL;
        $data_daocao = date("Y-m-d");
        $volume = "300";

        $ac_dornic = "0";
        $media_sc = "0";
        $media_c = "0";
        $caloria = "0";
        $aprovado = "";

        $codigo = "";

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
                $id = $dados['id_doacao'];
                $id_doadora = $dados['doadora_id'];
                $data_daocao = $dados['data_doacao'];
                $volume = $dados['volume'];
                $ac_dornic = $dados['ac_dornic_media'];
                $media_sc = $dados['media_s_c'];
                $media_c = $dados['media_c'];
                $caloria = $dados['caloria'];
                $aprovado = $dados['aprovado'];
            }

            /*Formulario*/
            $form = "formAtualizar";
            $action = $controle."/atualizar";

            $codigo = $id;
        }
        ?>

        <div class="divForm wp100 floatL">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formDoacaoId" name="formDoacaoId" value="<?php echo $id; ?>">

                <div class="divFormCorpo">

                    <div class="divFormColuna wp100 floatL">

                      <div class="divCamposForm wp20">
                          <label class="labelForm">ID da Doação
                              <input class="campoForm" type="text" id="formDoacaoIdCadastrado" name="formDoacaoIdCadastrado" value="<?php echo $codigo; ?>" required disabled>
                          </label>
                      </div>

                        <div class="divCamposForm wp40">
                            <label class="labelForm">Doadora
                                <select class="campoForm" id="formDoacaoDoadora" name="formDoacaoDoadora" placeholder="Selecione uma Doadora!" required>
                                    <option value="">Selecione uma Doadora!</option>
                                    <?php
                                    foreach($this->DoadoraDB as $doadora){
                                        $doadora_id = $doadora['id_doadora'];
                                        $doadora_nome = $doadora['nome'];
                                        $doadora_selected = "";
                                        if($this->ID_Doadora == $doadora_id){$doadora_selected = "selected"; }
                                        if($id_doadora == $doadora_id){$doadora_selected = "selected"; }
                                        echo "<option value='$doadora_id' $doadora_selected>$doadora_nome</option> \n";
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>

                        <div class="divCamposForm wp20">
                            <label class="labelForm">Data da Doação
                                <input class="campoForm" type="date" id="formDoacaoData" name="formDoacaoData" value="<?php echo $data_daocao; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp20">
                            <label class="labelForm">Volume da Doação (mL)
                                <input class="campoForm" type="number" id="formDoacaoVolume" name="formDoacaoVolume" value="<?php echo $volume; ?>" required>
                            </label>
                        </div>

                    </div>

                    <div class="divFormColuna wp100 floatL">
                        <br/></br>

                        <div class="divCamposForm wp25">
                            <label class="labelForm">Média da Acidez Donic
                                <input class="campoForm" type="number" id="formDoacaoAcidez" name="formDoacaoAcidez" value="<?php echo $ac_dornic; ?>">
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Média S C
                                <input class="campoForm" type="number" id="formDoacaoMediaSC" name="formDoacaoMediaSC" value="<?php echo $media_sc; ?>">
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Média C
                                <input class="campoForm" type="number" id="formDoacaoMediaC" name="formDoacaoMediaC" value="<?php echo $media_c; ?>">
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Caloria
                                <input class="campoForm" type="number" id="formDoacaoCaloria" name="formDoacaoCaloria" value="<?php echo $caloria; ?>">
                            </label>
                        </div>

                    </div>

                    <div class="divFormColuna wp100 floatL">
                        <br/>

                        <div class='marginAuto' style="margin: auto; width: 30%;">
                            <label class="labelFormMarcar textCenter" style="font-size: 30px;">Aprovada</label>
                            <br/><br/>
                            <label class="campoMarcar wp33">
                                <input type="radio" id="formDoacaoAprovadaS" name="formDoacaoAprovada" value="S" <?php if($aprovado == 'S'){echo "checked";} ?> onclick="functionSelectNF()">
                                <p>Sim</p>
                            </label>
                            <label class="campoMarcar wp33">
                                <input type="radio" id="formDoacaoAprovadaN" name="formDoacaoAprovada" value="N" <?php if($aprovado == 'N'){echo "checked";} ?> onclick="functionSelectNF()">
                                <p>Não</p>
                            </label>
                            <label class="campoMarcar wp33">
                                <input type="radio" id="formDoacaoAprovadaA" name="formDoacaoAprovada" value="A" <?php if($aprovado == 'A'){echo "checked";} ?> onclick="functionSelectNF()">
                                <p>Analizando</p>
                            </label>
                        </div>

                    </div>

                    <div class="divFormColuna wp100 floatL">
                        <br/>

                        <div class="divCamposForm wp100" id="selectNC">

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                            <label class="labelForm">Não Conformidade
                                <div>
                                    <select class="campoForm select2 form-control" id="formDoacaoNaoConformidade" name="formDoacaoNaoConformidade[]" multiple="" tabindex="-1" style="display: none; width: 100%;">
                                        <?php
                                        $nao_conformidade = array();
                                        if($this->NaoConformidadeDB != NULL){
                                            foreach($this->NaoConformidadeDB as $n_confor){
                                                $nao_conformidade[] = $n_confor['conformidade_id'];
                                                echo $n_confor['conformidade_id'];
                                            }
                                        }

                                        foreach($this->ConformidadeDB as $conform){
                                            $id_conform = $conform['id_conformidade'];
                                            $descricao = $conform['descricao'];
                                            $selected = "";

                                            if(in_array($id_conform, $nao_conformidade)){
                                                $selected = "selected";
                                            }

                                            echo "<option value='$id_conform' $selected>$descricao</option> \n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </label>
                            <script>
                                $(".select2").select2();

                                function functionSelectNF(){
                                    var selectNC = document.getElementById('selectNC');
                                    if($("#formDoacaoAprovadaN").prop("checked")){
                                        selectNC.style.display="block";
                                    }else{
                                        selectNC.style.display="none";
                                    }
                                }
                                functionSelectNF();
                            </script>

                        </div>
                        <br/><br/>

                    </div>

                </div>

                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li>
                        <?php
                        if($this->DadosDB != NULL){
                            echo "<a class='buttonBasico' href='".DIRPAGE."doacao'>Cancelar!</a> ";
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
