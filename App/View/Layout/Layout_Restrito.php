<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo $this->getAuthor(); ?>">
    <meta name="description" content="<?php echo $this->getDescription(); ?>">
    <meta name="keywords" content="<?php echo $this->getKeywords(); ?>">

    <title><?php echo $this->getTitle(); ?></title>

    <link rel="shortcut icon" href="<?php echo DIRIMG."arte/logo_favicon.ico"; ?>">

    <link rel="stylesheet" href="<?php echo DIRCSS.'Style.css' ?>">
    <link rel="stylesheet" href="<?php echo DIRCSS.'MenuVertical.css' ?>">

    <?php echo $this->addHead(); ?>

</head>

<body>

    <!--Header-->
    <header class="Header">

        <?php
        require_once(DIRREQ.'App/View/Layout/Header_Layout.php');
        ?>

        <?php echo $this->addHeader(); ?>

    </header>

    <!--Nav-->
    <nav class="NavPrincipal">
        <ul class="nb4">
            <li class=""><a href="<?php echo DIRPAGE."home"; ?>">Home</a></li>
            <li class=""><a href=""> </a></li>
            <li class=""><a href="<?php echo DIRPAGE."usuario"; ?>">Usuário</a></li>
            <li class=""><a href="<?php echo DIRPAGE."ControllerLogin/logout"; ?>">Sair</a></li>
        </ul>
    </nav>

    <!--NavMap-->
    <div class="NavMap">
        <?php
        $BreadCrumb = new Src\Classes\ClassBreadcrumb();
        $BreadCrumb->addBreadcrumb();
        ?>
    </div>

    <!--Corpo da Página-->
    <section class="Corpo">

        <!--Menu Vertical-->
        <nav class="NavVertical">
            <ul>
                <li><a href="<?php echo DIRPAGE."doadora"; ?>">Doadora</a></li>
                <li><a href="<?php echo DIRPAGE."doacao"; ?>">Doação</a></li>
                <li><a href="<?php echo DIRPAGE."lote"; ?>">Lote e Pasteurização</a></li>
                <li><a href="">Não Conformidade</a>
                    <ul>
                        <li><a href="<?php echo DIRPAGE."conformidade"; ?>">Conformidade</a></li>
                        <li><a href="<?php echo DIRPAGE."naoconformidade"; ?>">Não Conformidade</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo DIRPAGE."funcionario"; ?>">Funcionario</a></li>
                <li><a href="<?php echo DIRPAGE."slideshow"; ?>">Slide Show</a></li>
                <li><a href="<?php echo DIRPAGE."postagem"; ?>">Postagem</a></li>
            </ul>
        </nav>

        <!--Conteudo/Main-->
        <section class="Main">
            <div class="DivMensagemAlerta" id="DivMensgemAlerta"></div>
            <?php echo $this->addMain(); ?>
            <div class="DivPosicaoConteudo"></div>
        </section>

    </section>

    <!--Footer-->
    <footer class="Footer">

        <?php echo $this->addFooter(); ?>

        <?php
        require_once(DIRREQ.'App/View/Layout/Footer_Layout.php');
        ?>

    </footer>

    <script src="<?php echo DIRPAGE.'Public/js/jquery.min.js' ?>"></script>
    <script src="<?php echo DIRPAGE.'Public/js/vanilla-masker.min.js' ?>"></script>
    <script src="<?php echo DIRPAGE.'Public/js/JavaScript.js' ?>"></script>

</body>

</html>
