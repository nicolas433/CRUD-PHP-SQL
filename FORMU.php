<?php
    require("App/autoload.php"); 
    use DB\Conexao as Banco;
    $conexao = Banco::getInstance();

    if(!isset($_GET["id"])){
        echo "<center><h1>Página não encontrada!</h1></center>";
        die();
    }
    if(!isset($_GET["tabela"])){
        echo "<center><h1>Página não encontrada!</h1></center>";
        die();
    }

    $tabela = $_GET["tabela"];
    $id = $_GET["id"];

    $idd = $tabela."_id";

    $sqlid_query = "SELECT * FROM $tabela WHERE $idd = $id";
    $q = $conexao->prepare($sqlid_query);


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
                        foreach($linha as $chave => $valor){
                            echo "<label for=".$chave.">".$chave.": 
                                <input value='".$valor."' type='text' class='form-control form-control-lg' name=".$chave."/>" ;
                            echo "</br>";
                        }






                        /*if(
                           $linha['COLUMN_NAME']!= "data_criacao" and
                           $linha['COLUMN_NAME']!= "ultima_atualizacao" and
                           $linha['COLUMN_NAME']!= "ativo" and
                           $linha['COLUMN_NAME']!= $tabela."_id" ){
                               echo "<label for=".$linha['COLUMN_NAME'].">".$linha['COLUMN_NAME'].": 
                               <input value='' type='text' class='form-control form-control-lg' name=".$linha['COLUMN_NAME']."/>" ;
                               
                           }*/

                    }
                }
                echo "<input type='hidden' name='tabela' value='$tabela'>";
            ?>
            
            <input type='submit' value='CREATE'>
        </form>
    </body>
</html>
