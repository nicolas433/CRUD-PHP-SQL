<?php
    require("App/autoload.php"); 
    use DB\Conexao as Banco;
    $conexao = Banco::getInstance();


    if($tabela == "Choose..."){
        $tabela = "cliente";
    }
    $tabela = $_POST["tabela"];
    

    $sql_query = "SELECT * FROM $tabela LIMIT $inicio, $qnt_result_pg";
    $q = $conexao->prepare($sql_query);


    $gg = [];
    $gg[0] = "teste";
    $data_type;
    $gambcont = 1;
    $primeiro_elemento;


    if($q->execute()){
        while($linha = $q->fetch(PDO::FETCH_ASSOC)){
            foreach($linha as $chave => $valor){
                if($gambcont == 1){
                    $primeiro_elemento = $chave;
                    $gambcont++;
                    $gg[0] = $chave; 
                }
                if($chave == $primeiro_elemento and $gambcont > 2){
                    echo "saiu@!!@@";
                    break;
                }else{                  
                    $gambcont ++;
                    if($gambcont>3){
                        array_push($gg, $chave);
                    }
                }
            }
            break;
        }
    }

    













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


        <form method='POST' action='addCliente.php'>
            <p>Id da loja:</p>
            <label for="um">Um</label>
            <input type="radio" name="loja_id" id="um" value="1">
            <label for="dois">Dois</label>
            <input type="radio" name="loja_id" id="dois" value="2">
            <br>
            <br>

            <label for="primeiro_nome">primeiro_nome</label>
            <input type="text" name="primeiro_nome" id="primeiro_nome">
            <br>

            <label for="ultimo_nome">ultimo_nome</label>
            <input type="text" name="ultimo_nome" id="ultimo_nome">
            <br>

            <label for="email">email</label>
            <input type="email" name="email" id="email">
            <br>

            <!-- tenho que arrumar um create pra endereco_id tb -->
            <label for="endereco_id">Mah, se tu já tiver teu <br>
                            endereço cadastrado e souber <br> 
                            o id dele no BD, bota ai ashuashusa <br>
                            (se não, deixa em branco)</label>
            <input type="text" name="endereco_id" id="endereco_id">
            <br>

            <input type='submit' value='CREATE'>
        </form>
    </body>
</html>
