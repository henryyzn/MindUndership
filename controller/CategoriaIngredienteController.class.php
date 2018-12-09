<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/CategoriaIngrediente.class.php");
    require_once(__DIR__ . "/../model/dao/CategoriaIngredienteDAO.class.php");

    class CategoriaIngredienteController extends Controller {
        /* Inicializa todas as rotas que serão tratadas */
        public function init() {
            $this->criarRota("GET", "categoria-ingrediente", "listar");
            $this->criarRota("POST", "categoria-ingrediente", "inserir");
            $this->criarRota("GET", "categoria-ingrediente/arvore", "getArvoreCategorias");
            $this->criarRota("GET", "categoria-ingrediente/{id}", "selecionarItem");
            $this->criarRota("PUT", "categoria-ingrediente/{id}", "atualizar");
            $this->criarRota("PUT", "categoria-ingrediente/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "categoria-ingrediente/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(CategoriaIngredienteDAO::listar());
        }

        public function inserir() {
            $categoria = new CategoriaIngrediente($this->dados);
            try {
                $categoria->startUpload("assets/images/categorias");
                if (CategoriaIngredienteDAO::inserir($categoria)) {
                    $this->api->enviarResultado($categoria);
                } else {
                    $this->api->enviarStatus(500, "Não foi possível inserir.");
                }

            } catch (Exception $erro) {
                $this->api->enviarStatus(500, $erro->getMessage());
            }
        }

        public function selecionarItem($id) {
            $categoria = CategoriaIngredienteDAO::selecionar($id);
            if ($categoria) {
                $this->api->enviarResultado($categoria);
            } else {
                $this->api->enviarStatus(404, "Categoria não encontrada");
            }
        }

        public function atualizar($id) {
            $categoria = new CategoriaIngrediente($this->dados);
            try {
                $categoria->startUpload("assets/images/categorias");
                if (CategoriaIngredienteDAO::atualizar($id, $categoria)) {
                    $this->api->enviarResultado($categoria);
                } else {
                    $this->api->enviarStatus(404, "Categoria não encontrada");
                }

            } catch (Exception $erro) {
                $this->api->enviarStatus(500, $erro->getMessage());
            }
        }

        public function ativar($id) {
            if (CategoriaIngredienteDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Categoria não encontrada");
            }
        }

        public function excluir($id) {
            try {
                if (CategoriaIngredienteDAO::excluir($id)) {
                    $this->api->enviarStatus(204);
                } else {
                    $this->api->enviarStatus(404, "Categoria não encontrada");
                }

            } catch (PDOException $error) {
                if ($error->getCode()) {
                    $this->api->enviarStatus(403, "Você não pode excluir esta categoria, pois ela possui ingredientes atrelados á ela.");
                } else {
                    throw $error;
                }
            }
        }

        public function getArvoreCategorias() {
            $this->api->enviarResultado(array(
                "select" => self::montarSelectCategorias()
            ));
        }

        public static function listarCategorias() {
            return CategoriaIngredienteDAO::listar();
        }

        public static function montarSelectCategorias() {
            $resultado = "";
            $categorias = self::listarCategorias();
            foreach ($categorias as $categoria) {
                if (!$categoria->getParent()) {
                    $resultado .= "<option value='{$categoria->getId()}'>{$categoria->getTitulo()}</option>";
                    self::recursiveSelect($categorias, 1, $categoria->getId(), $resultado);
                }
            }

            return $resultado;
        }

        private static function recursiveSelect($categorias, $indent, $parent, &$resultado) {
            foreach ($categorias as $categoria) {
                if ($categoria->getParent() == $parent) {
                    $space = str_repeat("&emsp;", $indent);
                    $resultado .= "<option value='{$categoria->getId()}'>{$space}{$categoria->getTitulo()}</option>";
                    self::recursiveSelect($categorias, $indent + 1, $categoria->getId(), $resultado);
                }
            }
        }
    }
?>
