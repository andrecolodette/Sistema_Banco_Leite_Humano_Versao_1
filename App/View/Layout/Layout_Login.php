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
    <link rel="stylesheet" href="<?php echo DIRCSS.'TelaLogin.css' ?>">

    <?php echo $this->addHead(); ?>

</head>

<body>

    <section class="FundoTelaLogin">

        <div class="DivLogin">

            <div class="DivLoginLogo">
                <a href="<?php echo DIRPAGE; ?>">
                    <img src="<?php echo DIRIMG."arte/logo_imagem.png"; ?>" alt="Logo">
                </a>
            </div>

            <div class="DivMensagemAlerta" id="DivMensgemAlerta"></div>

            <div class="DivLoginForm">

                <form class="Form" id="formLogin" name="formLogin" action="<?php echo DIRPAGE."ControllerLogin/logar" ?>" method="post" autocomplete="off">
                    <div class="campoLogin">
                        <input class="campoForm" type="text" id="formLoginUsuario" name="formLoginUsuario" value="" placeholder="Login" required>
                    </div>
                    <div class="campoLogin">
                        <input class="campoForm" type="password" id="formLoginSenha" name="formLoginSenha" value="" placeholder="Senha" required>
                    </div>
                    <div class="campoLogin">
                        <ul class="nb2">
                            <li><input class="buttonBasico" type="submit" value="Entrar"></li>
                            <li><a class="buttonBasico" href="<?php echo DIRPAGE; ?>">Voltar</a></li>
                        </ul>
                    </div>
                </form>

            </div>

        </div>

    </section>

    <script src="<?php echo DIRPAGE.'Public/js/jquery.min.js' ?>"></script>
    <script src="<?php echo DIRPAGE.'Public/js/jquery.form.min.js' ?>"></script>
    <script src="<?php echo DIRPAGE.'Public/js/JavaScript.js' ?>"></script>

</body>

</html>
