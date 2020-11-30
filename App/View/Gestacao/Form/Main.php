<!--Menu Secundário - de Opções-->
<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."gestacao/cadastro"; ?>">Novo</a></li>
            <li class=""><a href="<?php echo DIRPAGE."gestacao"; ?>">Listagem</a></li>
        </ul>
    </nav>
</div>

<!--Form-->
<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">

        <?php
        $controle = DIRPAGE."ControllerGestacao";
        /*Formulario*/
        $form = "formCadastro";
        $action = $controle."/cadastrar";
        /*Variáveis*/
        $id = 0;
        $id_doadora = "";
        $loc_pre_natal = "";
        $num_consultas = "";
        $peso_inicio = "";
        $peso_final = "";
        $data_parto = "";
        $loc_parto = "";
        $vdrl = "";
        $hbsag = "";
        $hb = "";
        $ht = "";
        $transfusao = "";
        $tabagismo = "";
        $etilismo = "";
        $drogas = "";
        $medicamentos = "";
        $intercorrencias = "";
        $tratamentos = "";
        $obs = "";
        $aprovada = "";

        $nome_doadora = "";

        if($this->doadoraDB != NULL){
            foreach($this->doadoraDB as $doadora){
                $id_doadora = $doadora['id_doadora'];
                $nome_doadora = $doadora['nome'];
            }
        }else{
            //ERRO não tem uma Gestacao associada
            $nome_doadora = "ERRO! Nenhuma doadora foi Selecionada!";
        }

        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $dados){
              $id = $dados['id_gestacao'];
              $id_doadora = $dados['doadora_id'];
              $loc_pre_natal = $dados['loc_pre_natal'];
              $num_consultas = $dados['num_consultas'];
              $peso_inicio = $dados['peso_gest_inicio'];
              $peso_final = $dados['peso_gest_final'];
              $data_parto = $dados['data_parto'];
              $loc_parto = $dados['loc_parto'];
              $vdrl = $dados['pre_natal_vdrl'];
              $hbsag = $dados['pre_natal_hbsag'];
              $hb = $dados['pre_natal_hb'];
              $ht = $dados['pre_natal_ht'];
              $transfusao = $dados['transf_sang_5_anos'];
              $tabagismo = $dados['tabagismo'];
              $etilismo = $dados['etilismo'];
              $drogas = $dados['drogas'];
              $medicamentos = $dados['medicamentos_atuais'];
              $intercorrencias = $dados['interc_pre_natal'];
              $tratamentos = $dados['interc_trat_intern_pre_natal'];
              $obs = $dados['obs_gestacao'];
              $aprovada = $dados['aprovada'];

              $nome_doadora = $dados['nome'];
            }
            /*Formulario*/
            $form = "formAtualizar";
            $action = $controle."/atualizar";
        }
        ?>

        <div class="divForm">
            <form class="Form" id="<?php echo $form; ?>" name="<?php echo $form; ?>" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                <input type="hidden" id="formGestacaoId" name="formGestacaoId" value="<?php echo $id; ?>">
                <input type="hidden" id="formGestacaoDoadoraID" name="formGestacaoDoadoraID" value="<?php echo $id_doadora; ?>">

                <div class="divFormCorpo">

                    <div class="divFormColuna wp100 floatL">

                        <div class="divCamposForm wp100">
                            <label class="labelForm">Nome
                                <input class="campoForm" type="text" id="formGestacaoDoadoraNome" name="formGestacaoDoadoraNome" value="<?php echo $nome_doadora; ?>" disabled>
                            </label>
                        </div>
                        <div class="divCamposForm wp50">
                            <label class="labelForm">Local do Pré Natal
                                <input class="campoForm" type="text" id="formGestacaoLocPreNatal" name="formGestacaoLocPreNatal" value="<?php echo $loc_pre_natal; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp50">
                            <label class="labelForm">Local do Parto
                                <input class="campoForm" type="text" id="formGestacaoLocParto" name="formGestacaoLocParto" value="<?php echo $loc_parto; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp25">
                            <label class="labelForm">Número de Consultas
                                <input class="campoForm" type="number" id="formGestacaoNumConsulta" name="formGestacaoNumConsulta" value="<?php echo $num_consultas; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Peso Início da Gestação
                                <input class="campoForm" type="number" id="formGestacaoPesoInicio" name="formGestacaoPesoInicio" value="<?php echo $peso_inicio; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Peso Final da Gestação
                                <input class="campoForm" type="number" id="formGestacaoPesoFinal" name="formGestacaoPesoFinal" value="<?php echo $peso_final; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp25">
                            <label class="labelForm">Data do Parto
                                <input class="campoForm" type="date" id="formGestacaoDataParto" name="formGestacaoDataParto" value="<?php echo $data_parto; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp20">
                            <label class="labelForm">HB
                                <input class="campoForm" type="number" id="formGestacaoHB" name="formGestacaoHB" value="<?php echo $hb; ?>" required>
                            </label>
                        </div>
                        <div class="divCamposForm wp20">
                            <label class="labelForm">HT
                                <input class="campoForm" type="number" id="formGestacaoHT" name="formGestacaoHT" value="<?php echo $ht; ?>" required>
                            </label>
                        </div>

                        <div class="divCamposForm wp15">
                            <label class="labelForm">VDRL
                                <select class="campoForm" id="formGestacaoVDRL" name="formGestacaoVDRL">
                                    <option value="I" <?php if($vdrl == 'I'){echo "selected";} ?>>Não disponivel</option>
                                    <option value="S" <?php if($vdrl == 'S'){echo "selected";} ?>>Sim</option>
                                    <option value="N" <?php if($vdrl == 'N'){echo "selected";} ?>>Não</option>
                                </select>
                            </label>
                        </div>
                        <div class="divCamposForm wp15">
                            <label class="labelForm">HBSAG
                                <select class="campoForm" id="formGestacaoHBSAG" name="formGestacaoHBSAG">
                                  <option value="I" <?php if($hbsag == 'I'){echo "selected";} ?>>Não disponivel</option>
                                  <option value="S" <?php if($hbsag == 'S'){echo "selected";} ?>>Sim</option>
                                  <option value="N" <?php if($hbsag == 'N'){echo "selected";} ?>>Não</option>
                                </select>
                            </label>
                        </div>
                        <div class="divCamposForm wp15">
                            <label class="labelForm">Transfusão
                                <select class="campoForm" id="formGestacaoTransfusao" name="formGestacaoTransfusao">
                                  <option value="I" <?php if($transfusao == 'I'){echo "selected";} ?>>Não disponivel</option>
                                  <option value="S" <?php if($transfusao == 'S'){echo "selected";} ?>>Sim</option>
                                  <option value="N" <?php if($transfusao == 'N'){echo "selected";} ?>>Não</option>
                                </select>
                            </label>
                        </div>
                        <div class="divCamposForm wp15">
                            <label class="labelForm">Tabagista
                                <select class="campoForm" id="formGestacaoTabagismo" name="formGestacaoTabagismo">
                                  <option value="I" <?php if($tabagismo == 'I'){echo "selected";} ?>>Não disponivel</option>
                                  <option value="S" <?php if($tabagismo == 'S'){echo "selected";} ?>>Sim</option>
                                  <option value="N" <?php if($tabagismo == 'N'){echo "selected";} ?>>Não</option>
                                </select>
                            </label>
                        </div>

                        <div class="divCamposForm wp33 hf150" style="height: 150px;">
                            <label class="labelForm">Etilismo
                                <textarea class="campoForm" id="formGestacaoEtilismo" name="formGestacaoEtilismo" maxlength="200" required><?php echo $etilismo; ?></textarea>
                            </label>
                        </div>
                        <div class="divCamposForm wp33 hf150" style="height: 150px;">
                            <label class="labelForm">Drogas
                                <textarea class="campoForm" id="formGestacaoDroga" name="formGestacaoDroga" maxlength="200" required><?php echo $drogas; ?></textarea>
                            </label>
                        </div>
                        <div class="divCamposForm wp33 hf150" style="height: 150px;">
                            <label class="labelForm">Medicamentos Atuais
                                <textarea class="campoForm" id="formGestacaoMedicamento" name="formGestacaoMedicamento" maxlength="200" required><?php echo $medicamentos; ?></textarea>
                            </label>
                        </div>

                        <div class="divCamposForm wp33 hf150" style="height: 150px;">
                            <label class="labelForm">Intercorrencias no Pré Natal
                                <textarea class="campoForm" id="formGestacaoIntercorrencia" name="formGestacaoIntercorrencia" maxlength="100" required><?php echo $intercorrencias; ?></textarea>
                            </label>
                        </div>
                        <div class="divCamposForm wp33 hf150" style="height: 150px;">
                            <label class="labelForm">Internação no Pré Natal
                                <textarea class="campoForm" id="formGestacaoTratamento" name="formGestacaoTratamento" maxlength="100" required><?php echo $tratamentos; ?></textarea>
                            </label>
                        </div>
                        <div class="divCamposForm wp33 hf150" style="height: 150px;">
                            <label class="labelForm">Observações
                                <textarea class="campoForm" id="formGestacaoObservacao" name="formGestacaoObservacao" maxlength="200" required><?php echo $obs; ?></textarea>
                            </label>
                        </div>

                    </div>

                    <div class="divFormColuna wp100 floatL">

                        <div class='marginAuto' style="margin: auto; width: 20%;">
                            <br/><label class="labelFormMarcar textCenter" style="font-size: 30px;">Aprovada</label><br/><br/>
                            <label class="campoMarcar wp50">
                                <input type="radio" id="formGestacaoAprovada" name="formGestacaoAprovada" value="S" <?php if($aprovada == 'S'){echo "checked";} ?>>
                                <p>Sim</p>
                            </label>
                            <label class="campoMarcar wp50">
                                <input type="radio" id="formGestacaoAprovada" name="formGestacaoAprovada" value="N" <?php if($aprovada == 'N'){echo "checked";} ?>>
                                <p>Não</p>
                            </label>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>

                </div>

                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li>
                        <?php
                        if($this->DadosDB != NULL){
                            echo "<a class='buttonBasico' href='".DIRPAGE."doadora/visualizar/$id_doadora'>Cancelar!</a> ";
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
