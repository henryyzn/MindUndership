<?php
    require_once("../../controller/FuncionarioController.class.php");
    $funcionario = FuncionarioController::getFuncionarioAtual();
    if (!$funcionario) {
        header("location:login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Food 4fit - CMS</title>
        <link rel="icon" type="image/png" href="../assets/images/icons/favicon.png" />
	    <link rel="stylesheet" href="../assets/public/css/jquery.toast.min.css">
        <link rel="stylesheet" href="../assets/public/css/sceditor.theme.min.css">
	    <link rel="stylesheet" href="../assets/css/font-style.css">
        <link rel="stylesheet" href="../assets/css/bases.css">
        <link rel="stylesheet" href="../assets/css/sizes.css">
        <link rel="stylesheet" href="../assets/css/align.css">
        <link rel="stylesheet" href="../assets/css/keyframes.css">
        <link rel="stylesheet" href="../assets/css/cms/stylesheet-cms.css">
	    <script src="../assets/public/js/jquery-3.3.1.min.js"></script>
	    <script src="../assets/public/js/jquery.toast.min.js"></script>
        <script src="../assets/public/js/jquery.sceditor.xhtml.min.js"></script>
	    <script src="../assets/public/js/jquery.mask.min.js"></script>
	    <script src="../assets/public/js/jquery.tmpl.min.js"></script>
	    <script src="../assets/js/util.js"></script>
	    <script src="../assets/js/cms/main.js"></script>
	    <script src="../assets/js/cms/crud.controller.js"></script>
	    <script src="../assets/js/cms/home.controller.js"></script>
	    <script src="../assets/js/cms/sobreempresa.controller.js"></script>
	    <script src="../assets/js/cms/categoriaingrediente.controller.js"></script>
	    <script src="../assets/js/cms/categoriaprato.controller.js"></script>
	    <script src="../assets/js/cms/ingrediente.controller.js"></script>
	    <script src="../assets/js/cms/loja.controller.js"></script>
	    <script src="../assets/js/cms/vantagemcomidafitness.controller.js"></script>
	    <script src="../assets/js/cms/porquecomidafitness.controller.js"></script>
	    <script src="../assets/js/cms/dicassaude.controller.js"></script>
	    <script src="../assets/js/cms/dicasfitness.controller.js"></script>
        <script src="../assets/js/cms/personalfitness.controller.js"></script>
        <script src="../assets/js/cms/faleconosco.controller.js"></script>
        <script src="../assets/js/cms/prato.controller.js"></script>
    </head>
    <body>
        <section id="main" data-controller="HomeController">
            <?php require_once("./components/sidebar.php") ?>
            <div id="main-content">
                <header class="animate fast fadeInDown">
                    <span id="titulo-pagina"></span>
                    <div>
                        <input type="search" placeholder="Pesquise por algo">
                        <img src="../assets/images/cms/icons/pesquisa.svg" alt="Pesquisar">
                    </div>
                    <div>
                        <span id="ultimas-interacoes">Últimas Interações</span>
                        <div id="notificacoes">
                            <img src="../assets/images/cms/icons/notificacoes.svg" alt="Notificações">
                            <span>12</span>
                        </div>
                        <img class="btn-logout" src="../assets/images/cms/icons/sair-navbar.svg" alt="Sair">
                    </div>
                </header>
                <div id="page-content">
                </div>
            </div>
            <?php require_once("./components/modal.html") ?>
        </section>
    </body>
</html>
