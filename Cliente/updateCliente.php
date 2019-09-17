<?php
    require("../App/autoload.php");
    date_default_timezone_set("America/Fortaleza");

    use DB\Conexao as Banco;
    use Validations\Validate;
    
    $conexao = Banco::getInstance();

    $ID = $_GET["id"];
    echo $ID;


    /*
    $data_criacao = date("d-m-Y H:i:s");


    $sql = "INSERT INTO cliente (cliente_id, loja_id, primeiro_nome, ultimo_nome, email, endereco_id, ativo, data_criacao, ultima_atualizacao) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt= $conexao->prepare($sql);
    $stmt->execute([$id, $loja_id, $primeiro_nome, $ultimo_nome, $email, 5, 1, $data_criacao, $data_criacao]);

    header("Location: index.php");
    */









                            /*if(
                           $linha['COLUMN_NAME']!= "data_criacao" and
                           $linha['COLUMN_NAME']!= "ultima_atualizacao" and
                           $linha['COLUMN_NAME']!= "ativo" and
                           $linha['COLUMN_NAME']!= $tabela."_id" ){*/








