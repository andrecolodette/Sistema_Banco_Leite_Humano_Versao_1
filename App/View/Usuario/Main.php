<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor">

        <p class="pagTexto">
        <?php
        if($this->DadosDB != NULL){
            foreach($this->DadosDB as $use){
                $nome = $use['nome'];
                $usuario = $use['usuario'];

                echo "Nome: $nome <br/><br/>";
                echo "Usuário: $usuario <br/><br/>";

                if($use['administrador'] == '1'){
                    echo "Tipo: Administrador <br/><br/>";
                }else{
                    echo "Tipo: Comum <br/><br/>";
                }
            }
        }else{}
        ?>
        </p>
        <div class="divForm wp100 floatL">
            <form class="Form" id="formNovaSenha" name="formNovaSenha" action="<?php echo DIRPAGE."ControllerUsuario/atualizar"; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="divFormCorpo">
                    <div class="divFormColuna wp33 floatL">
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Senha Atual
                                <input class="campoForm" type="password" id="formUsuarioSenhaAtual" name="formUsuarioSenhaAtual">
                            </label>
                        </div>
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Nova Senha
                                <input class="campoForm" type="password" id="formUsuarioSenhaNova" name="formUsuarioSenhaNova">
                            </label>
                        </div>
                        <div class="divCamposForm wp100">
                            <label class="labelForm">Confirme a Nova Senha
                                <input class="campoForm" type="password" id="formUsuarioSenhaConfirme" name="formUsuarioSenhaConfirme">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="divFormBotoes">
                    <ul class="actions">
                        <li><input class="buttonBasico" type="submit" value="Salvar!"></li>
                        <li><a class="buttonBasico" href="<?php echo DIRPAGE."home"; ?>">Cancelar!</a></li>
                    </ul>
                </div>
            </form>
        </div>

    </div>
</div>


<div class="DivPosicaoConteudo"></div>
