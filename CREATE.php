<?php 
    require("App/autoload.php"); 
    use DB\Conexao as Banco;
    use Validations\Validate;

    date_default_timezone_set("America/Fortaleza");

    $conexao = Banco::getInstance();

    $tabela = $_POST["tabela"];


    $sql_query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tabela'";
    $q = $conexao->prepare($sql_query);
    
    $sql = '"INSERT INTO $tabela (';
    $count = ") VALUES (";
    $data = [];

    if($q->execute()){
        while($linha = $q->fetch(PDO::FETCH_ASSOC)){

            //AQUI
            $nomee = $linha['COLUMN_NAME'];
            $nome = $_POST($nome);
            echo $nome;
            array_push($data, $nome);
            //ATÉ AQUI

            $sql .= $linha['COLUMN_NAME'].", ";
            $count .= "?,";
        }
    }


    $sql = substr($sql, 0, -2);
    $count = substr($count, 0, -1);
    $count .= ')"';
    $sql .= $count;

    $ultima_atualizacao = date("d-m-Y H:i:s"); 
    $data_criacao = date("d-m-Y H:i:s");

    $stmt= $conexao->prepare($sql);

    foreach($data as $chave => $valor){
        echo "$chave: $valor \n";
    }

    


    /*
    $stmt->execute([$id, $loja_id, $primeiro_nome, $ultimo_nome, $email, 5, 1, $data_criacao, $data_criacao]);
    */