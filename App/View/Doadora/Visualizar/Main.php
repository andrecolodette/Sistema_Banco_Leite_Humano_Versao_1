<?php

use App\Controller\ControllerList\ControllerListDoadora;
$lista = new ControllerListDoadora();

use Src\Classes\ClassString;
$string = new ClassString();

$id_doadora = $this->ID_Doadora;
//foreach($this->DoadoraDB as $doadora){
    //$id_doadora = $doadora['id_doadora'];
//}

?>

<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."doadora"; ?>">Listagem</a></li>
            <li class=""><a href="<?php echo DIRPAGE."gestacao/cadastro/$id_doadora"; ?>">Nova Gestação</a></li>
            <li class=""><a href="<?php echo DIRPAGE."doacao/cadastro/$id_doadora"; ?>">Nova Doação</a></li>
        </ul>
    </nav>
</div>

<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">

        <fieldset class="campoDivisaoTexto">
            <legend><b>DOADORA</b></legend>
            <div>
            <?php
            foreach($this->DoadoraDB as $doadora){
                echo "<div> <p>\n";
                echo "    ".$doadora['nome']."<br/> \n";
                echo "    RG: ".$doadora['rg']."<br/> \n";
                echo "    CPF: ".$string->mascara_string("###.###.###-##",$doadora['cpf'])."<br/> \n";
                echo "    Cartão do SUS: ".$string->mascara_string("### #### #### ####",$doadora['cartao_sus'])."<br/> \n";
                $data = new DateTime($doadora['data_nasc']);
                echo "    Data de Nascimento: ".$data->format('d/m/Y')."<br/> \n";
                echo "    Celular: ".$string->mascara_string("(##) #####-####",$doadora['celular'])."<br/> \n";
                $data = new DateTime($doadora['data_registro']);
                echo "    Data do Cadastro: ".$data->format('d/m/Y')."<br/> \n";
                echo "</p> </div> \n";

                echo "<div> <p>\n";
                echo "    Estado: ".$doadora['estado']."<br/> \n";
                echo "    Cidade: ".$doadora['cidade']."<br/> \n";
                echo "    Bairro: ".$doadora['bairro']."<br/> \n";
                echo "    CEP: ".$string->mascara_string("##.###-###",$doadora['cep'])."<br/> \n";
                echo "    Endereço: ".$doadora['endereco']."<br/> \n";
                if($doadora['status_doando'] == 'S'){
                    echo "    <b>Status: Doando</b></br>";
                }else{
                    echo "    <b>Status: Inativa</b></br>";
                }

                echo "<a class='buttonBasico floatL' href='".DIRPAGE."doadora/atualizar/".$doadora['id_doadora']."'>Atualizar!</a> \n";
                echo "</p> </div> \n";
            }
            ?>
            </div>
        </fieldset>
        <br/>
        <fieldset class="campoDivisaoTexto">
            <legend><b>GESTAÇÃO</b></legend>
            <?php
            $qtdGestacao = $this->GestacaoDB->rowCount();
            foreach($this->GestacaoDB as $gestacao){
                echo "<div> \n";
                echo "<div> <p> \n";
                echo "    Local do Pré-Natal: ".$gestacao['loc_pre_natal']."<br/> \n";
                echo "    Número de Consultas: ".$gestacao['num_consultas']."<br/> \n";
                echo "    Peso no Início da Gestação: ".$gestacao['peso_gest_inicio']."<br/> \n";
                echo "    Peso no Final da Gestação: ".$gestacao['peso_gest_final']."<br/> \n";
                $data = new DateTime($gestacao['data_parto']);
                echo "    Data do Parto: ".$data->format('d/m/Y')."<br/> \n";
                echo "    Local do Parto: ".$gestacao['loc_parto']."<br/> \n";
                if($gestacao['pre_natal_vdrl'] == 'I'){
                    echo "    Pré-Natal VDRL: Indisponivel<br/> \n";
                }elseif($gestacao['pre_natal_vdrl'] == 'I'){
                    echo "    Pré-Natal VDRL: Sim<br/> \n";
                }else{
                    echo "    Pré-Natal VDRL: Não<br/> \n";
                }
                if($gestacao['pre_natal_hbsag'] == 'I'){
                    echo "    Pré-Natal HBSAG: Indisponivel<br/> \n";
                }elseif($gestacao['pre_natal_hbsag'] == 'I'){
                    echo "    Pré-Natal HBSAG: Sim<br/> \n";
                }else{
                    echo "    Pré-Natal HBSAG: Não<br/> \n";
                }
                echo "    Pré-Natal HB: ".$gestacao['pre_natal_hb']."<br/> \n";
                echo "    Pré-Natal HT: ".$gestacao['pre_natal_ht']."<br/> \n";
                if($gestacao['transf_sang_5_anos'] == 'I'){
                    echo "    Transfusão de Sangue (Últimos 5 anos): Indisponivel<br/> \n";
                }elseif($gestacao['transf_sang_5_anos'] == 'I'){
                    echo "    Transfusão de Sangue (Últimos 5 anos): Sim<br/> \n";
                }else{
                    echo "    Transfusão de Sangue (Últimos 5 anos): Não<br/> \n";
                }
                echo "</p> </div> \n";

                echo "<div> <p>\n";
                if($gestacao['etilismo'] == 'I'){
                    echo "    Etilismo: Indisponivel<br/> \n";
                }elseif($gestacao['etilismo'] == 'I'){
                    echo "    Etilismo: Sim<br/> \n";
                }else{
                    echo "    Etilismo: Não<br/> \n";
                }
                echo "    Drogas: ".$gestacao['drogas']."<br/> \n";
                echo "    Medicamentos Atuais: ".$gestacao['medicamentos_atuais']."<br/> \n";
                echo "    Intercorrências no Pré-Natal: ".$gestacao['interc_pre_natal']."<br/> \n";
                echo "    Tratamento das Intercorrências no Pré-Natal: ".$gestacao['interc_trat_intern_pre_natal']."<br/> \n";
                echo "    Observações: ".$gestacao['obs_gestacao']."<br/> \n";
                if($gestacao['aprovada'] == 'S'){
                    echo "    <b>Aprovada</b><br/> \n";
                }else{
                    echo "    <b>Reprovada</b><br/> \n";
                }

                echo "<a class='buttonBasico floatL' href='".DIRPAGE."gestacao/atualizar/".$gestacao['id_gestacao']."'>Atualizar!</a> \n";
                echo "</p> </div> \n";
                echo "</div> \n";

                $qtdGestacao -= 1;
                if($qtdGestacao > 0){
                    echo "<hr> \n";
                }
            }
            ?>
        </fieldset>
        <br/>
        <fieldset class="campoDivisaoTexto">
            <legend><b>DOAÇÕES</b></legend>

                <div>
                    <table class='tableListagem'>
                        <col class='colN'>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class=''>
                        <col class='colAcaoes nb1'>
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>ID</th>
                                <th>Data Doação</th>
                                <th>Volume (mL)</th>
                                <th>Acidez Dornic Média</th>
                                <th>Média S C</th>
                                <th>Média C</th>
                                <th>Calorias</th>
                                <th>Aprovado</th>
                                <th>Não Conformidade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            foreach($this->DoacaoDB as $doacao){
                                $n++;
                                echo "<tr> \n";
                                echo "    <td>$n</td> \n";
                                echo "    <td>".$doacao['id_doacao']."</td> \n";
                                $data = date("d/m/Y", strtotime($doacao['data_doacao']));
                                echo "    <td>".$data."</td> \n";
                                echo "    <td>".$doacao['volume']."</td> \n";
                                echo "    <td>".$doacao['ac_dornic_media']."</td> \n";
                                echo "    <td>".$doacao['media_s_c']."</td> \n";
                                echo "    <td>".$doacao['media_c']."</td> \n";
                                echo "    <td>".$doacao['caloria']."</td> \n";
                                $aprovado = $doacao['aprovado'];
                                if($aprovado == "S"){
                                    echo "    <td>Aprovada</td> \n";
                                }elseif($aprovado == "N"){
                                    echo "    <td>Reprovada</td> \n";
                                }else{
                                    echo "    <td>Analizando</td> \n";
                                }
                                $nao_conformidade = $doacao['nao_conformidade'];
                                $nao_conformidade = str_replace(", ", ",", $nao_conformidade);
                                $nao_conformidade = str_replace(",", ", ", $nao_conformidade);
                                echo "    <td>$nao_conformidade</td> \n";
                                echo "    <td> \n";
                                echo "        <a class='buttonBasico buttonAcao' href='".DIRPAGE."doacao/atualizar/".$doacao['id_doacao']."'> \n";
                                echo "            <img class='iconAcao' src='".DIRIMG."icon/edite_16.png"."' alt='Editar'> \n";
                                echo "        </a> \n";
                                echo "    </td> \n";
                                echo "</tr> \n";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

        </fieldset>
        <br/><br/>

    <div>
</div>

<div class="DivPosicaoConteudo"></div>
