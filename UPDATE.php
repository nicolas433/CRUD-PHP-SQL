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
    if (isset($_POST["id"] ) ){
        $id = $_POST["id"];
    }else{
        header("Location: index.php");
    }




    $idd = $tabela."_id";


    $sqlid_query = "SELECT * FROM $tabela WHERE $idd = $id";
    $q = $conexao->prepare($sqlid_query);


    $update_vector = [];

    $sql = "UPDATE users SET ";

    if($q->execute()){
        while($linha = $q->fetch(PDO::FETCH_ASSOC)){
            foreach($linha as $chave => $valor){
                $teste = $_POST[$chave];
                array_push($update_vector, $teste);
                $sql .= "$chave=?, "; 
            }
        }
    }
    $sql = substr($sql, 0, -2); 
    $sql .= " WHERE id = ?";
    array_push($update_vector, $id);
    

    $stmt = $conexao->prepare($sql);
    $stmt->execute($update_vector);
    header("Location: index.php");

    //$dpo->prepare($sql)->execute($update_vector);



    
