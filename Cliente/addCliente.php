<?php
    require("../App/autoload.php");
    date_default_timezone_set("America/Fortaleza");

    use DB\Conexao as Banco;
    use Validations\Validate;
    
    $conexao = Banco::getInstance();

    $sql_query = "SELECT * FROM cliente";
    $q = $conexao->prepare($sql_query);

    $primeiro_nome = Validate::__e($_POST["primeiro_nome"]);
    $ultimo_nome = Validate::__e($_POST["ultimo_nome"]);
    $loja_id = Validate::__e($_POST["loja_id"]);
    $email = Validate::__e($_POST["email"]);
    $endereco_id = Validate::__e($_POST["endereco_id"]);

    $data_criacao = date("d-m-Y H:i:s");
    echo $data_criacao;


    $id = 1;

    if($q->execute()){
        while($linha = $q->fetch(PDO::FETCH_ASSOC)){
            if($linha['cliente_id'] != $id){
                break;
            }else{
                $id++;
            }
        }
    }


    $sql = "INSERT INTO cliente (cliente_id, loja_id, primeiro_nome, ultimo_nome, email, endereco_id, ativo, data_criacao, ultima_atualizacao) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt= $conexao->prepare($sql);
    $stmt->execute([$id, $loja_id, $primeiro_nome, $ultimo_nome, $email, 5, 1, $data_criacao, $data_criacao]);

    //header("Location: index.php");