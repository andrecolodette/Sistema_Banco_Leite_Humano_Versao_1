<?php
use App\Controller\ControllerList\ControllerListDoadora;
$lista = new ControllerListDoadora();
?>

<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."doadora/cadastro"; ?>">Novo</a></li>
            <?php
            $lista->gerarMenuConfig();
            $lista->gerarMenuFiltro();
            $lista->gerarMenuBusca("Nome ou CPF");
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
