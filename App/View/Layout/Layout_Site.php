<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo $this->getAuthor(); ?>">
    <meta name="description" content="<?php echo $this->getDescription(); ?>">
    <meta name="keywords" content="<?php echo $this->getKeywords(); ?>">

    <title><?php echo $this->getTitle(); ?></title>

    <!--<link rel="icon" type="imagem/png" href="<?php echo DIRIMG."arte/logo_favicon.ico"; ?>">-->
    <link rel="shortcut icon" href="<?php echo DIRIMG."arte/logo_favicon.ico"; ?>">

    <link rel="stylesheet" href="<?php echo DIRCSS.'Style.css'; ?>">
    <link rel="stylesheet" href="<?php echo DIRCSS.'SlideShow.css'; ?>">

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
            <li classe=""><a href="<?php echo DIRPAGE.'login' ?>" target="_blank">Login</a></li>
            <li class=""><a href="#">Contato</a></li>
            <li class=""><a href="#">Open Data</a></li>
            <li class=""><a href="#">Link 1</a></li>
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

        <!--Conteudo/Main-->
        <section class="Main">
            <?php echo $this->addMain(); ?>
        </section>

    </section>

    <!--Footer-->
    <footer class="Footer">

        <?php echo $this->addFooter(); ?>

        <script src="<?php echo DIRPAGE.'Public/js/SlideShow.js' ?>"></script>

        <?php
        require_once(DIRREQ.'App/View/Layout/Footer_Layout.php');
        ?>

    </footer>


</body>

</html>
