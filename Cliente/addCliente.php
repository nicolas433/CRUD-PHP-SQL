<?php
    

    use DB\Conexao as Banco;
    use Validations\Validate;
    
    $conexao = Banco::getInstance();

    $sql_query = "SELECT * FROM cliente";
    $q = $conexao->prepare($sql_query);




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