<?php

    class JogosUsados{
        
        private $conn;
        private $table = 'jogosusados';

        public $id;
        public $nome;
        public $preco;
        public $avaliacao;

        public function __construct($db){

            $this->conn = $db;
        }

        public function read(){

            $query = 'SELECT
                    p.id,
                    p.nome,
                    p.preco,
                    p.avaliacao
                FROM 
                ' . $this->table . ' p
                ORDER BY 
                    p.id DESC';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt; 

        }

        public function read_single() {
            
            $query = 'SELECT
                    p.id,
                    p.nome,
                    p.preco,
                    p.avaliacao
                FROM 
                ' . $this->table . ' p
                WHERE 
                    p.id = ? 
                LIMIT 0,1'; 

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(1, $this->id);

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->id = $row['id'];
                $this->nome = $row['nome'];
                $this->preco = $row['preco'];
                $this->avaliacao = $row['avaliacao'];
                

        }
    }