<?php
class Usuario {
 
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
 
    // object properties
    public $id;
    public $nome;
    public $sobrenome;
    public $email;
    public $telefone_fixo;
    public $telefone_celular;
    public $endereco;
    public $senha;
    public $status;
    public $criado;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // check if given email exist in the database
    function emailExists() {
     
        // query to check if email exists
        $query = "SELECT id, nome, sobrenome, senha, status
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";
     
        // prepare the query
        $stmt = $this->conn->prepare( $query );
     
        // sanitize
        $this->email = htmlspecialchars(strip_tags($this->email));
     
        // bind given email value
        $stmt->bindParam(1, $this->email);
     
        // execute the query
        $stmt->execute();
     
        // get number of rows
        $num = $stmt->rowCount();
     
        // if email exists, assign values to object properties for easy access and use for php sessions
        if ($num>0) {
     
            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
            // assign values to object properties
            $this->id = $row['id'];
            $this->nome = $row['nome'];
            $this->sobrenome = $row['sobrenome'];
            $this->senha = $row['senha'];
            $this->status = $row['status'];
     
            // return true because email exists in the database
            return true;
        }
     
        // return false if email does not exist in the database
        return false;
    }

    // create new user record
    function create() {
     
        // to get time stamp for 'created' field
        $this->criado = date('Y-m-d H:i:s');
     
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nome=:nome,
                    sobrenome=:sobrenome,
                    email=:email,
                    telefone_fixo=:telefone_fixo,
                    telefone_celular=:telefone_celular,
                    endereco=:endereco,
                    senha=:senha,
                    status=:status,
                    criado=:criado";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->sobrenome = htmlspecialchars(strip_tags($this->sobrenome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->status = htmlspecialchars(strip_tags($this->status));
     
        // bind the values
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':sobrenome', $this->sobrenome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':telefone_fixo', $this->telefone_fixo);
        $stmt->bindParam(':telefone_celular', $this->telefone_celular);
        $stmt->bindParam(':endereco', $this->endereco);
     
        // hash the password before saving to database
        $password_hash = password_hash($this->senha, PASSWORD_BCRYPT);
        $stmt->bindParam(':senha', $password_hash);
     
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':criado', $this->criado);
     
        // execute the query, also check if query was successful
        if($stmt->execute()) {
            return true;
        } else {            
            return false;
        }
     
    }
}
?>