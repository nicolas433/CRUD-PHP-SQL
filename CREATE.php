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
            echo $linha[$id];
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

    echo $data_criacao;
    die();k


    if($q->execute()){
        while($linha = $q->fetch(PDO::FETCH_ASSOC)){
            /*
            if($linha['COLUMN_NAME'] == $id){
                array_push($data, $id_disponivel);
            }else if($linha['COLUMN_NAME'] == "ultima_atualizacao"){
                array_push($data_criacao);
            }else if($linha['COLUMN_NAME'] == "data_criancao"){
                array_push($data_criacao);
            }else{*/
                $input_name = $linha['COLUMN_NAME'];
                if (isset($_POST[$nome]) ){
                    $nome = $_POST[$nome];
                }

                $nome = Validate::__e($nome);

                /*
                if($linha['DATA_TYPE'] == "char" OR
                    $linha['DATA_TYPE'] == "varchar" OR
                    $linha['DATA_TYPE'] == "text" OR
                    $linha['DATA_TYPE'] == "nchar" OR
                    $linha['DATA_TYPE'] == "nvarchar" OR
                    $linha['DATA_TYPE'] == "ntext" OR
                    $linha['DATA_TYPE'] == "binary" OR
                    $linha['DATA_TYPE'] == "varbinary" OR
                    $linha['DATA_TYPE'] == "image"         
                  ){
                      if(is_string ($nome)==false){
                        echo  "<script>alert('Objeto informado no campo ".$linha['COLUMN_NAME']."deveria ser uma string.');</script>";
                        //header("Location: index.php");
                      }
                  }

                  if($linha['DATA_TYPE'] == "bit" OR
                    $linha['DATA_TYPE'] == "tinybit" OR
                    $linha['DATA_TYPE'] == "smallint" OR
                    $linha['DATA_TYPE'] == "int" OR
                    $linha['DATA_TYPE'] == "bigint" OR
                    $linha['DATA_TYPE'] == "decimal" OR
                    $linha['DATA_TYPE'] == "numeric" OR
                    $linha['DATA_TYPE'] == "smallmoney" OR
                    $linha['DATA_TYPE'] == "float" OR
                    $linha['DATA_TYPE'] == "real"                         
                  ){
                      if(is_float($nome) == false AND
                         is_double($nome) == false AND
                         is_countable($nome) == false AND
                         is_integer($nome) == false AND 
                         is_int($nome) == false){
                        echo  "<script>alert('Objeto informado no campo ".$linha['COLUMN_NAME']."deveria ser um número.);</script>";
                        //header("Location: index.php");
                      }
                  }*/
                array_push($data, $nome);
            }

            $sql .= $linha['COLUMN_NAME'].", ";
            $count .= "?,";
        }
    }


    $sql = substr($sql, 0, -2);
    $count = substr($count, 0, -1);
    $count .= ')"';
    $sql .= $count;



    $stmt= $conexao->prepare($sql);

    foreach($data as $chave => $valor){
        echo "$chave: $valor \n";
    }
    


    /*
    $stmt->execute([$id, $loja_id, $primeiro_nome, $ultimo_nome, $email, 5, 1, $data_criacao, $data_criacao]);
    */