<?php
    require("App/autoload.php"); 
    use DB\Conexao as Banco;
    $conexao = Banco::getInstance();

    $tabela = $_POST["tabela"];

    if($tabela == "Choose..."){
        $tabela = "cliente";
    }
    

    $sql_query = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tabela'";
    $q = $conexao->prepare($sql_query);

?>
<html>
    <head>
        <meta name= "viewport" content= "width-device-width, initial-scale=1.0" />
        <link rel= "stylesheet" type= "text/css" href= "styles/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="styles/bootstrap/js/jquery-3.4.1.min.js" </script>
        <script type="text/javascript" src="styles/bootstrap/js/bootstrap.min.js" </script>
    </head>
    <body style='background: #454d55;
                color: white'>  


        <form method='POST' action='CREATE.php'>
            <?php
                if($q->execute()){
                    while($linha = $q->fetch(PDO::FETCH_ASSOC)){
                        if(
                           $linha['COLUMN_NAME']!= "data_criacao" and
                           $linha['COLUMN_NAME']!= "ultima_atualizacao" and
                           $linha['COLUMN_NAME']!= "ativo" and
                           $linha['COLUMN_NAME']!= $tabela."_id" ){
                               echo "<label for=".$linha['COLUMN_NAME'].">".$linha['COLUMN_NAME'].": 
                               <input type='text' class='form-control form-control-lg' name=".$linha['COLUMN_NAME']."/>" ;
                               echo "</br>";
                           }

                    }
                }
                echo "<input type='hidden' name='tabela' value='$tabela'>";
            ?>
            
            <input type='submit' value='CREATE'>
        </form>
    </body>
</html>
