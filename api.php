<?php
    require_once("model/dao/Database.class.php");
    require_once("controller/APIController.class.php");
    require_once("controller/FuncionarioController.class.php");
    require_once("controller/SobreNosController.class.php");
    require_once("controller/IngredienteController.class.php");
    require_once("controller/CategoriaIngredienteController.class.php");
    require_once("controller/CategoriaPratoController.class.php");
    require_once("controller/LojaController.class.php");
    require_once("controller/UsuarioController.class.php");
    require_once("controller/VantagemComidaFitnessController.class.php");
    require_once("controller/PersonalFitnessController.class.php");
    require_once("controller/PorQueComidaFitnessController.class.php");
    require_once("controller/DicasSaudeController.class.php");
    require_once("controller/DicasFitnessController.class.php");
    require_once("controller/UnidadeMedidaController.class.php");
    require_once("controller/FaleConoscoController.class.php");

    /* Cria uma nova instância da classe APIController e inicializa todas as rotas */
    new APIController();
?>
