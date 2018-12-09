<?php
    /*
    * Classe abstrata, ou seja, não pode ser inicializada, apenas extendida
    * Serve como base para classes modelo, com um método construtor que transforma um array em propriedades do objeto
    */
    abstract class Model implements JsonSerializable {
        public $uploadData;
        /*
        * Método construtor
        * @param $classe Classe modelo que o json será descarregado (__CLASS no escopo de uma classe modelo)
        * @param $dados Array de dados para serem descarregados na classe
        */
        public function __construct($array = null) {
            // Verifica se o array não é nulo
            if ($array) {
                if (gettype($array) === "array") {
                    $array = Model::convertArray($array);
                }

                // Faz um loop em todas as propriedades do array
                foreach ($array as $propriedade => $valor) {
                    // Verifica se o mesmo nome da propriedade do array existe na classe modelo
                    if (property_exists($this, $propriedade)) {
                        $type = $this->getType($propriedade);
                        if ($type) {
                            $this->{$propriedade} = new $type($valor);
                        } else {
                            // Define a propriedade na classe, recebendo como valor o que veio do array
                            $this->{$propriedade} = $valor;
                        }
                    }
                }
            }
        }

        public function jsonSerialize() {
            return get_object_vars($this);
        }

        public function getType($propriedade) {
            return null;
        }

        private static function convertName($string) {
            $str = str_replace(" ", "", ucwords(str_replace("_", " ", $string)));
            $str[0] = strtolower($str[0]);
            return $str;
        }

        public static function convertArray($array) {
            $resultado = array();
            foreach ($array as $propriedade => $valor) {
                if (strpos($propriedade, ".") !== false) {
                    Model::explodePath($resultado, $propriedade, $valor);
                } else {
                    $resultado[Model::convertName($propriedade)] = $valor;
                }
            }

            return $resultado;
        }

        private static function explodePath(&$array, $path, $value) {
            $keys = explode(".", $path);
            foreach ($keys as $key) {
                $array = &$array[$key];
            }

            $array = $value;
        }

        public function startUpload($path) {
            if ($this->uploadData) {
                $data = $this->uploadData->fileData;
                if (preg_match("/^data:image\/(\w+);base64,/", $data, $extensao)) {
                    $data = substr($data, strpos($data, ",") + 1);
                    $extensao = strtolower($extensao[1]);

                    if (!in_array($extensao, ["jpg", "jpeg", "png"])) {
                        throw new Exception("Extensão do arquivo não suportada");
                    }

                    $data = base64_decode($data);
                    if ($data === false) {
                        throw new Exception("Não foi possível decodificar os dados do arquivo");
                    }

                    $nomeCriptografado = md5($this->uploadData->fileName . uniqid()) . "." . $extensao;
                    $caminhoArquivo = $path . "/" . $nomeCriptografado;
                    if (!@file_put_contents($caminhoArquivo, $data)) {
                        throw new Exception("Não foi possível concluir o upload do arquivo");
                    }

                    $this->foto = $caminhoArquivo;

                } else {
                    throw new Exception("URI do arquivo incorreto");
                }

                $this->uploadData = null;
            }
        }
    }
?>
