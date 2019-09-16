<?php
    require_once(__DIR__."/App/autoload.php");
    use DB\Conexao as Banco;
    $conexao = Banco::getInstance();

    $sql_query = "SELECT * FROM cliente";
    $q = $conexao->prepare($sql_query);




    $primeiro_nome = $_POST["primeiro_nome"];
    $ultimo_nome = $_POST["ultimo_nome"];
    $loja_id = $_POST["loja_id"];
    $email = $_POST["email"];
    $endereco_id = $_POST["endereco_id"];

    $data_criacao = date("d-m-Y H:i:s");
    $ultima_atualizacao = $data_criacao;  

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



    $insert = "INSERT INTO `cliente` VALUES ($id, $loja_id, '$primeiro_nome', '$ultimo_nome', '$email', 5, 1, '$data_criacao', '$data_criacao')"; 

    echo $insert;


    //INSERT INTO `cliente` VALUES (600, 1, 43efwgdfg, fdgsfg, ngrisoste@gmail.com, 5, 1, 16-09-2019 17:10:43, 16-09-2019 17:10:43)
    //INSERT INTO `cliente` VALUES (602, 1, 'MARY', 'SMITH', 'MARY.SMITH@sakilacustomer.org', 5, 1, '2006-02-14 22:04:36', '2006-02-15 07:57:20');