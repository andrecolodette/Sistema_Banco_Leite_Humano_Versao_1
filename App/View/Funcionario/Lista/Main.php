<?php
use App\Controller\ControllerList\ControllerListFuncionario;
$lista = new ControllerListFuncionario();
?>

<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."funcionario/cadastro"; ?>">Novo</a></li>
            <?php
            $lista->gerarMenuConfig();
            $lista->gerarMenuFiltro();
            ?>
        </ul>
    </nav>
</div>

<div class="DivPosicaoConteudo">
    <div class="DivAreaConteudo conteudoCor" id="idDivTabelaListagem">
        <?php
        $lista->tabelaListagem();
        ?>
    <div>
</div>

<div class="DivPosicaoConteudo"></div>
