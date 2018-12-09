<div id="sidebar">
    <div id="sidebar-header">
        <h1>FOOD 4FIT<br><span>CMS</span></h1>
        <a href="#" id="sidebar-collapse">
            <img src="../assets/images/icons/menu-lateral.svg" alt="Menu Lateral">
        </a>
    </div>
    <div class="separator"></div>
    <div id="perfil">
        <?php if ($funcionario->getAvatar()) { ?>
            <figure id="avatar">
                <img src="../assets/images/<?= $funcionario->getAvatar() ?>" alt="">
            </figure>
        <?php } else { ?>
            <figure id="avatar" data-siglas="<?= $funcionario->getIniciaisNome(); ?>"></figure>
        <?php } ?>
        <div id="informacoes">
            <div id="informacoes-content">
                <span id="nome"><?= $funcionario->getNome() ?> <?= $funcionario->getSobrenome() ?></span>
                <span id="email"><?= $funcionario->getEmail() ?></span>
                <a href="#" id="dropdown"></a>
            </div>
        </div>
    </div>
    <div class="separator"></div>
    <nav>
        <a href="#" data-page-load="dashboard" data-page-controller="DashboardController">
            <span class="image"><img src="../assets/images/cms/icons/pagina-inicial.svg" alt="Dashboard"></span>
            <span class="label">Dashboard</span>
        </a>
        <a href="#" data-page-load="diario-bordo">
            <span class="image"><img src="../assets/images/cms/icons/diario-de-bordo.svg" alt="Diário de Bordo"></span>
            <span class="label">Diário de Bordo</span>
        </a>
        <a href="#" data-page-load="pratos" data-page-controller="PratoController">
            <span class="image"><img src="../assets/images/cms/icons/pratos.svg" alt="Pratos"></span>
            <span class="label">Pratos</span>
        </a>
        <a href="#" data-page-load="ingredientes" data-page-controller="IngredienteController">
            <span class="image"><img src="../assets/images/cms/icons/ingredientes.svg" alt="Ingredientes"></span>
            <span class="label">Ingredientes</span>
        </a>
        <a href="#" data-page-load="categorias-prato" data-page-controller="CategoriaPratoController">
            <span class="image"><img src="../assets/images/cms/icons/categorias.svg" alt="Categorias de Pratos"></span>
            <span class="label">Categorias de Pratos</span>
        </a>
        <a href="#" data-page-load="categorias-ingredientes" data-page-controller="CategoriaIngredienteController">
            <span class="image"><img src="../assets/images/cms/icons/categorias.svg" alt="Categorias de Ingredientes"></span>
            <span class="label">Categorias de Ingredientes</span>
        </a>
        <a href="#">
            <span class="image"><img src="../assets/images/cms/icons/marketing.svg" alt="Marketing"></span>
            <span class="label">Marketing p/ E-Mail</span>
        </a>
        <a href="#">
            <span class="image"><img src="../assets/images/cms/icons/clientes.svg" alt="Clientes"></span>
            <span class="label">Clientes</span>
        </a>
        <a href="#">
            <span class="image"><img src="../assets/images/cms/icons/niveis-de-acesso.svg" alt="Níveis de Acesso"></span>
            <span class="label">Níveis de Acesso</span>
        </a>
        <a href="#">
            <span class="image"><img src="../assets/images/cms/icons/pedidos.svg" alt="Pedidos"></span>
            <span class="label">Pedidos<span class="badge">12</span></span>
        </a>
        <a href="#" data-page-load="fit-session">
            <span class="image"><img src="../assets/images/cms/icons/fit-session.svg" alt="Fit Session"></span>
            <span class="label">Fit Session</span>
        </a>
        <a href="#" data-page-load="parceiros">
            <span class="image"><img src="../assets/images/cms/icons/parceiros.svg" alt="Parceiros"></span>
            <span class="label">Parceiros</span>
        </a>
    </nav>
    <div class="separator"></div>
    <nav>
        <a href="#" data-page-load="perfil">
            <span class="image"><img src="../assets/images/cms/icons/meu-perfil.svg" alt="Meu perfil"></span>
            <span class="label">Meu perfil</span>
        </a>
        <a href="#" data-page-load="contato" data-page-controller="FaleConoscoController">
            <span class="image"><img src="../assets/images/cms/icons/fale-conosco.svg" alt="Fale Conosco"></span>
            <span class="label">Fale Conosco<span class="badge">12</span></span>
        </a>
        <a href="#" data-page-load="sobre" data-page-controller="SobreEmpresaController">
            <span class="image"><img src="../assets/images/cms/icons/sobre-empresa.svg" alt="Sobre a Empresa"></span>
            <span class="label">Sobre a Empresa</span>
        </a>
        <a href="#">
            <span class="image"><img src="../assets/images/cms/icons/outras-funcoes.svg" alt="Outras Funções"></span>
            <span class="label">Outras Funções</span>
        </a>
        <a href="#" data-page-load="lojas" data-page-controller="LojaController">
            <span class="image"><img src="../assets/images/cms/icons/diario-de-bordo.svg" alt="Diário de Bordo"></span>
            <span class="label">Nossas Lojas</span>
        </a>
        <a href="#">
            <span class="image"><img src="../assets/images/cms/icons/ajuda.svg" alt="Ajuda"></span>
            <span class="label">Ajuda</span>
        </a>
        <a href="#" class="btn-logout">
            <span class="image"><img src="../assets/images/cms/icons/sair.svg" alt="Sair"></span>
            <span class="label">Sair</span>
        </a>
    </nav>
    <div id="tooltip"></div>
</div>
