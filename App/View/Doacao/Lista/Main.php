<?php
use App\Controller\ControllerList\ControllerListDoacao;
$lista = new ControllerListDoacao();
?>

<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."doacao/cadastro"; ?>">Novo</a></li>
            <?php
            $lista->gerarMenuConfig();
            //$lista->gerarMenuData();
            $lista->gerarMenuFiltro();
            $lista->gerarMenuBusca("ID");
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
