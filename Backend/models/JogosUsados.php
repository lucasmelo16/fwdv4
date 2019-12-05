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

        public function create(){

            $query = 'INSERT INTO ' . $this->table . '
                SET 
                 id = :id,
                 nome = :nome,
                 preco = :preco,
                 avaliacao = :avaliacao';

            $stmt = $this->conn->prepare($query);

            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->preco = htmlspecialchars(strip_tags($this->preco));
            $this->avaliacao = htmlspecialchars(strip_tags($this->avaliacao));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->bindParam(':avaliacao', $this->avaliacao);

            if($stmt->execute()){
                return true;
          }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function uptade(){

            $query = 'UPDATE ' . $this->table . '
                SET 
                 id = :id,
                 nome = :nome,
                 preco = :preco,
                 avaliacao = :avaliacao
                WHERE
                 id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->preco = htmlspecialchars(strip_tags($this->preco));
            $this->avaliacao = htmlspecialchars(strip_tags($this->avaliacao));
            
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->bindParam(':avaliacao', $this->avaliacao);

            if($stmt->execute()){
                return true;
          }

            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }