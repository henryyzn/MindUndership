<?php

 //Em seguida após a DAO, vou para controller DO PHP (último apsso referente ao back-end)

//loja.controler.js -> Enviando o conteudo dela para LojaController.class.php
//Essa LojaController, pode pegar qualquer coisa vindo de outras plataformas
//criarRota -> Vem do controller
//_DIR_ ->Sintaxe do PHP Representa a pasta que estou trabalhando
//Extends -> Conceito de POO, Herança, herdando tudo o que a controller tem
//Init() -> Função para método ''construtor'', achar todos os controler e procurar em cada um deles, toda essa função para inicialização
//$this -> Este
//criarRota -> Função que representa o router como um todo, dizendo para onde vai meu conteudo
//Funtion ''inserir()'' -> Função que eu criei
// $loja = new Loja($this->dados) - >
//LojaDAO::inserir($loja);
 //public static function listar() return LojaDAO::listar();
// -> Função usada na view, pegando os dados e mandando para view, static (mais utilizado para não ficar dando new)


    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/Loja.class.php");
    require_once(__DIR__ . "/../model/dao/LojaDAO.class.php");
    require_once(__DIR__."/../model/Estado.class.php");
    require_once(__DIR__."/../model/dao/EstadoDAO.class.php");
    require_once(__DIR__."/../model/Cidade.class.php");
    require_once(__DIR__."/../model/dao/CidadeDAO.class.php");


    class LojaController extends Controller {
        public function init() {
            $this->criarRota("POST", "loja/inserir", "inserir");
            $this->criarRota("GET", "cidade/select/{idEstado}", "listarCidade");
            $this->criarRota("GET", "loja/excluir/{id}", "excluirDado");
            $this->criarRota("GET", "loja/ativar/{id}", "ativarItem");
            //Post porque estou passandod ados de formulario
            $this->criarRota("POST", "loja/editar/{id}", "editarInformacao");
            $this->criarRota("GET", "loja/selecionar/{id}", "selecionar");

        }

        public function inserir() {
            $loja = new Loja($this->dados);
            //:: -> static
            LojaDAO::inserir($loja);
        }

        public static function listar() {
            return LojaDAO::listar();

        }

        //Public static -> quando posso chamar um método sem dar um new
        //Exemplo: DAO = new...
        public static function listarEstado(){
            return EstadoDAO::listar();
        }

        //Não terá static porque será uma ROTA
        public function listarCidade($idEstado){
            //Chamando DAO
            $select = CidadeDAO::listar($idEstado);
            $this->api->enviarResultado($select);

        }

        public function excluirDado($id){
            LojaDAO::excluir($id);
        }

        public function ativarItem($id){
            LojaDAO::ativar($id);
        }

        public function editarInformacao($id){
            $informacao = new Loja($this->dados);
            LojaDAO::editar($id, $informacao);
        }

        public function selecionar($id){
            //Chamando a LojaDAO
            $loja = LojaDAO::selecionar($id);
            //Enviando resultado para Tela
            $this->api->enviarResultado($loja);
        }

    }
?>
