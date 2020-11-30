<?php
use App\Controller\ControllerList\ControllerListConformidade;
$lista = new ControllerListConformidade();
?>

<div class="DivPosicaoConteudo">
    <nav class="navMenuOpcao">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."conformidade/cadastro"; ?>">Novo</a></li>
            <?php
            $lista->gerarMenuConfig();
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
