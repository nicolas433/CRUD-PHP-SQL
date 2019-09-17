<?php 
    require("App/autoload.php"); 
    use DB\Conexao as Banco;
    use Validations\Validate;

    date_default_timezone_set("America/Fortaleza");

    $conexao = Banco::getInstance();

    if (isset($_POST["tabela"] ) ){
        $tabela = $_POST["tabela"];
    }else{
        header("Location: index.php");
    }
    $id = $tabela."_id";


    $sql_query = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tabela'";
    $sql_idquery = "SELECT $id FROM $tabela";
    
    $q = $conexao->prepare($sql_query);

    $q_id = $conexao->prepare($sql_idquery);
    
    $id_disponivel = 1;

    if($q_id->execute()){
        while($linha = $q_id->fetch(PDO::FETCH_ASSOC)){
            if($id_disponivel!=$linha[$id]){
                break;
            }
            $id_disponivel++;
        }
    }
    $sql = '"INSERT INTO $tabela (';
    $count = ") VALUES (";
    $data = [];
    $data_criacao = date("d-m-Y H:i:s");
    strval( $data_criacao );

    if($q->execute()){
        while($linha = $q->fetch(PDO::FETCH_ASSOC)){
                $test = $linha['COLUMN_NAME'];
                $nome = $_POST[$test];

                $nome = Validate::__e($nome);
                array_push($data, $nome);
                $sql .= $linha['COLUMN_NAME'].", ";
                $count .= "?,";
            } 
        }


    $sql = substr($sql, 0, -2);
    $count = substr($count, 0, -1);
    $count .= ')"';
    $sql .= $count;


    foreach($data as $chave => $valor){
        echo "$chave: $valor \n";
    }

    $stmt = $conexao->prepare($sql);

    $stmt->execute($data);
    
    
    