<?php
class Ficha {
 
    // database connection and table name
    private $conn;
    private $table_name = "ficha";
 
    // object properties
    public $id;
    public $nome;
    public $comunidade;
    public $data_nascimento;
    public $naturalidade;
    public $endereco;
    public $bairro;
    public $cep;
    public $telefone;
    public $email;
    public $estudante;
    public $colegio;
    public $batismo;
    public $eucaristia;
    public $data_batismo;
    public $paroquia_batismo;
    public $nome_pai;
    public $nome_mae;
    public $telefone_celular_pai;
    public $telefone_celular_mae;
    public $telefone_residencial;
    public $pais_casados_igreja;
    public $igreja_casamento;
    public $pais_vivem_juntos;
    public $frequentam_comunidade;
    public $ativos_paroquia;
    public $tipo_participacao;
    public $outra_paroquia;
    public $turma_atual;
    public $dia_da_semana;
    public $turno;
    public $ano_inicio_turma;
    public $catequista_1;
    public $catequista_2;
    public $catequista_3;
    public $catequizando_frequente;
    public $preenchimento_ficha;
    public $modificacao_ficha;
 
    public function __construct($db) {
        $this->conn = $db;
    }
 
    // create product
    function create() {
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nome=:nome, 
                    comunidade=:comunidade,
                    data_nascimento=:data_nascimento,
                    naturalidade=:naturalidade,
                    endereco=:endereco,
                    bairro=:bairro,
                    cep=:cep,
                    telefone=:telefone,
                    email=:email,
                    estudante=:estudante,
                    colegio=:colegio,
                    batismo=:batismo,
                    eucaristia=:eucaristia,
                    data_batismo=:data_batismo,
                    paroquia_batismo=:paroquia_batismo,
                    nome_pai=:nome_pai,
                    nome_mae=:nome_mae,
                    telefone_celular_pai=:telefone_celular_pai,
                    telefone_celular_mae=:telefone_celular_mae,
                    telefone_residencial=:telefone_residencial,
                    pais_casados_igreja=:pais_casados_igreja,
                    igreja_casamento=:igreja_casamento,
                    pais_vivem_juntos=:pais_vivem_juntos,
                    frequentam_comunidade=:frequentam_comunidade,
                    ativos_paroquia=:ativos_paroquia,
                    tipo_participacao=:tipo_participacao,
                    outra_paroquia=:outra_paroquia,
                    turma_atual=:turma_atual,
                    dia_da_semana=:dia_da_semana,
                    turno=:turno,
                    ano_inicio_turma=:ano_inicio_turma,
                    catequista_1=:catequista_1,
                    catequista_2=:catequista_2,
                    catequista_3=:catequista_3,
                    catequizando_frequente=:catequizando_frequente,
                    preenchimento_ficha=:preenchimento_ficha";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->data_nascimento = str_replace('/', '-', $this->data_nascimento);
        $this->data_nascimento = date('Y/m/d', strtotime($this->data_nascimento));
        $this->data_batismo = str_replace('/', '-', $this->data_batismo);
        $this->data_batismo = date('Y/m/d', strtotime($this->data_batismo));

        // bind values 
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":comunidade", $this->comunidade);
        $stmt->bindParam(":data_nascimento", $this->data_nascimento);
        $stmt->bindParam(":naturalidade", $this->naturalidade);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":estudante", $this->estudante);
        $stmt->bindParam(":colegio", $this->colegio);
        $stmt->bindParam(":batismo", $this->batismo);
        $stmt->bindParam(":eucaristia", $this->eucaristia);
        $stmt->bindParam(":data_batismo", $this->data_batismo);
        $stmt->bindParam(":paroquia_batismo", $this->paroquia_batismo);
        $stmt->bindParam(":nome_pai", $this->nome_pai);
        $stmt->bindParam(":nome_mae", $this->nome_mae);
        $stmt->bindParam(":telefone_celular_pai", $this->telefone_celular_pai);
        $stmt->bindParam(":telefone_celular_mae", $this->telefone_celular_mae);
        $stmt->bindParam(":telefone_residencial", $this->telefone_residencial);
        $stmt->bindParam(":pais_casados_igreja", $this->pais_casados_igreja);
        $stmt->bindParam(":igreja_casamento", $this->igreja_casamento);
        $stmt->bindParam(":pais_vivem_juntos", $this->pais_vivem_juntos);
        $stmt->bindParam(":frequentam_comunidade", $this->frequentam_comunidade);
        $stmt->bindParam(":ativos_paroquia", $this->ativos_paroquia);
        $stmt->bindParam(":tipo_participacao", $this->tipo_participacao);
        $stmt->bindParam(":outra_paroquia", $this->outra_paroquia);
        $stmt->bindParam(":turma_atual", $this->turma_atual);
        $stmt->bindParam(":dia_da_semana", $this->dia_da_semana);
        $stmt->bindParam(":turno", $this->turno);
        $stmt->bindParam(":ano_inicio_turma", $this->ano_inicio_turma);
        $stmt->bindParam(":catequista_1", $this->catequista_1);
        $stmt->bindParam(":catequista_2", $this->catequista_2);
        $stmt->bindParam(":catequista_3", $this->catequista_3);
        $stmt->bindParam(":catequizando_frequente", $this->catequizando_frequente);
        $stmt->bindParam(":preenchimento_ficha", $this->preenchimento_ficha);     

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
 
    }

    function readOne() { 
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->nome = $row['nome'];
        $this->comunidade = $row['comunidade'];
        $this->data_nascimento = $row['data_nascimento'];
        $this->naturalidade = $row['naturalidade'];
        $this->endereco = $row['endereco'];
        $this->bairro = $row['bairro'];
        $this->cep = $row['cep'];
        $this->telefone = $row['telefone'];
        $this->email = $row['email'];
        $this->estudante = $row['estudante'];
        $this->colegio = $row['colegio'];
        $this->batismo = $row['batismo'];
        $this->eucaristia = $row['eucaristia'];
        $this->data_batismo = $row['data_batismo'];
        $this->paroquia_batismo = $row['paroquia_batismo'];
        $this->nome_pai = $row['nome_pai'];
        $this->nome_mae = $row['nome_mae'];
        $this->telefone_celular_pai = $row['telefone_celular_pai'];
        $this->telefone_celular_mae = $row['telefone_celular_mae'];
        $this->telefone_residencial = $row['telefone_residencial'];
        $this->pais_casados_igreja = $row['pais_casados_igreja'];
        $this->igreja_casamento = $row['igreja_casamento'];
        $this->pais_vivem_juntos = $row['pais_vivem_juntos'];
        $this->frequentam_comunidade = $row['frequentam_comunidade'];
        $this->ativos_paroquia = $row['ativos_paroquia'];
        $this->tipo_participacao = $row['tipo_participacao'];
        $this->outra_paroquia = $row['outra_paroquia'];
        $this->turma_atual = $row['turma_atual'];
        $this->dia_da_semana = $row['dia_da_semana'];
        $this->turno = $row['turno'];
        $this->ano_inicio_turma = $row['ano_inicio_turma'];
        $this->catequista_1 = $row['catequista_1'];
        $this->catequista_2 = $row['catequista_2'];
        $this->catequista_3 = $row['catequista_3'];
        $this->catequizando_frequente = $row['catequizando_frequente'];
        $this->preenchimento_ficha = $row['preenchimento_ficha'];
        $this->modificacao_ficha = $row['modificacao_ficha'];
    }

    function readAll($from_record_num, $records_per_page) {
        $query = "SELECT
                    id, nome, data_nascimento, comunidade, turma_atual, turno, dia_da_semana, ano_inicio_turma
                FROM
                    " . $this->table_name . "
                ORDER BY
                    nome, turma_atual, dia_da_semana, turno ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    public function countAll() {
        $query = "SELECT id FROM " . $this->table_name . "";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $num = $stmt->rowCount();
     
        return $num;
    }

    function update() {
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    nome=:nome, 
                    comunidade=:comunidade,
                    data_nascimento=:data_nascimento,
                    naturalidade=:naturalidade,
                    endereco=:endereco,
                    bairro=:bairro,
                    cep=:cep,
                    telefone=:telefone,
                    email=:email,
                    estudante=:estudante,
                    colegio=:colegio,
                    batismo=:batismo,
                    eucaristia=:eucaristia,
                    data_batismo=:data_batismo,
                    paroquia_batismo=:paroquia_batismo,
                    nome_pai=:nome_pai,
                    nome_mae=:nome_mae,
                    telefone_celular_pai=:telefone_celular_pai,
                    telefone_celular_mae=:telefone_celular_mae,
                    telefone_residencial=:telefone_residencial,
                    pais_casados_igreja=:pais_casados_igreja,
                    igreja_casamento=:igreja_casamento,
                    pais_vivem_juntos=:pais_vivem_juntos,
                    frequentam_comunidade=:frequentam_comunidade,
                    ativos_paroquia=:ativos_paroquia,
                    tipo_participacao=:tipo_participacao,
                    outra_paroquia=:outra_paroquia,
                    turma_atual=:turma_atual,
                    dia_da_semana=:dia_da_semana,
                    turno=:turno,
                    ano_inicio_turma=:ano_inicio_turma,
                    catequista_1=:catequista_1,
                    catequista_2=:catequista_2,
                    catequista_3=:catequista_3,
                    catequizando_frequente=:catequizando_frequente,
                    preenchimento_ficha=:preenchimento_ficha                   
                WHERE
                    id=:id";
     
        $stmt = $this->conn->prepare($query);
     
        // posted values
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->data_nascimento = str_replace('/', '-', $this->data_nascimento);
        $this->data_nascimento = date('Y/m/d', strtotime($this->data_nascimento));
        $this->data_batismo = str_replace('/', '-', $this->data_batismo);
        $this->data_batismo = date('Y/m/d', strtotime($this->data_batismo));

        // bind values 
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":comunidade", $this->comunidade);
        $stmt->bindParam(":data_nascimento", $this->data_nascimento);
        $stmt->bindParam(":naturalidade", $this->naturalidade);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":bairro", $this->bairro);
        $stmt->bindParam(":cep", $this->cep);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":estudante", $this->estudante);
        $stmt->bindParam(":colegio", $this->colegio);
        $stmt->bindParam(":batismo", $this->batismo);
        $stmt->bindParam(":eucaristia", $this->eucaristia);
        $stmt->bindParam(":data_batismo", $this->data_batismo);
        $stmt->bindParam(":paroquia_batismo", $this->paroquia_batismo);
        $stmt->bindParam(":nome_pai", $this->nome_pai);
        $stmt->bindParam(":nome_mae", $this->nome_mae);
        $stmt->bindParam(":telefone_celular_pai", $this->telefone_celular_pai);
        $stmt->bindParam(":telefone_celular_mae", $this->telefone_celular_mae);
        $stmt->bindParam(":telefone_residencial", $this->telefone_residencial);
        $stmt->bindParam(":pais_casados_igreja", $this->pais_casados_igreja);
        $stmt->bindParam(":igreja_casamento", $this->igreja_casamento);
        $stmt->bindParam(":pais_vivem_juntos", $this->pais_vivem_juntos);
        $stmt->bindParam(":frequentam_comunidade", $this->frequentam_comunidade);
        $stmt->bindParam(":ativos_paroquia", $this->ativos_paroquia);
        $stmt->bindParam(":tipo_participacao", $this->tipo_participacao);
        $stmt->bindParam(":outra_paroquia", $this->outra_paroquia);
        $stmt->bindParam(":turma_atual", $this->turma_atual);
        $stmt->bindParam(":dia_da_semana", $this->dia_da_semana);
        $stmt->bindParam(":turno", $this->turno);
        $stmt->bindParam(":ano_inicio_turma", $this->ano_inicio_turma);
        $stmt->bindParam(":catequista_1", $this->catequista_1);
        $stmt->bindParam(":catequista_2", $this->catequista_2);
        $stmt->bindParam(":catequista_3", $this->catequista_3);
        $stmt->bindParam(":catequizando_frequente", $this->catequizando_frequente);
        $stmt->bindParam(":preenchimento_ficha", $this->preenchimento_ficha);
        $stmt->bindParam(":id", $this->id);
     
        // execute the query
        if ($stmt->execute()) {
            return true;
        }
     
        return false;
         
    }

    // delete the product
    function delete() {
     
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
         
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
     
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // read products by search term
    public function search($search_term, $from_record_num, $records_per_page){
     
        // select query
        $query = "SELECT
                    id, nome, data_nascimento, 
                FROM
                    " . $this->table_name . "
                WHERE
                    nome LIKE ?
                ORDER BY
                    nome, turma_atual, dia_da_semana, turno ASC
                LIMIT
                    ?, ?";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
     
        // execute query
        $stmt->execute();
     
        // return values from database
        return $stmt;
    }

    public function countAll_BySearch($search_term) {
 
        // select query
        $query = "SELECT
                    COUNT(*) as total_rows
                FROM
                    " . $this->table_name . "                    
                WHERE
                    nome LIKE ?";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
     
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row['total_rows'];
    }
}
?>