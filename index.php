<?php
    /*
    date_default_timezone_set("America/Fortaleza");
    $data_criacao = date("d-m-Y H:i:s");
    echo $data_criacao;
    */


    require("App/autoload.php");
    $tabela = "cliente";
    $tabela = $_POST["tabela"];

    use DB\Conexao as Banco;
    
    $conexao = Banco::getInstance();

    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    $qnt_result_pg = 20;
    $inicio = ($qnt_result_pg * $pagina)-$qnt_result_pg;

    if($pagina_atual==0){
        $previus_pg=0;    
    }else{
        $previus_pg=$pagina_atual-1;
    }

    if($pagina_atual==32){
        $next_pg=32;    
    }else{
        $next_pg=$pagina_atual+1;
    }
    
    

    $sql_query = "SELECT * FROM $tabela LIMIT $inicio, $qnt_result_pg";

    $q = $conexao->prepare($sql_query);
   
    $gg = [];
    $gg[0] = "teste";
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

    $id = $gg[0];
    
    //Banco::desconectar();
    
?>


<html>
    <head>
        <meta name="viewport" content="width-device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="styles/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="styles/bootstrap/js/jquery-3.4.1.min.js" </script>
        <script type="text/javascript" src="styles/bootstrap/js/bootstrap.min.js" </script>
    </head>
    <body style='background: #454d55'> 
    <div>
            <form method="POST" action="READ.php">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="submit">Button</button>
                    </div>
                        <select name="tabela" class="custom-select" id="inputGroupSelect03">
                            <option selected>Choose...</option>
                            <option value="aluguel">aluguel</option>
                            <option value="ator">ator</option>
                            <option value="categoria">categoria</option>
                            <option value="cidade">cidade</option>
                            <option value="cliente">cliente</option>
                            <option value="endereco">endereco</option>
                            <option value="filme">filme</option>
                            <option value="filme_ator">filme_ator</option>
                            <option value="filme_categoria">filme_categoria</option>
                            <option value="filme_texto">filme_texto</option>
                            <option value="funcionario">funcionario</option>
                            <option value="idioma">idioma</option>
                            <option value="inventario">inventario</option>
                            <option value="loja">loja</option>
                            <option value="pagamento">pagamento</option>
                            <option value="pais">pais</option>
                    </select>
                </div>
            </form>
        </div> 
        <div id = 'add-container'>
            <form action='FORMcliente.php' 
                  method='GET'>
                               
                <input  class="btn btn-success" 
                        type='submit' 
                        value='CREATE'
                        style=' width: 100%;
                               margin-top: 5px'
                >
                </input>
            </form>
        </div>
        <div id = 'main-container'>
            <?php          
                if($q->execute()){
                    echo "
                    <table class='table table-dark'>
                        <thead>
                            <tr>";
                            foreach($gg as $chave => $valor){
                                echo "<th scope='col'>$valor</th>";
                            }
                        echo "
                            <th>
                                Ações
                            </th>   
                            </tr>
                        </thead> 
                        <tbody>
                        ";
                            
                    while($linha = $q->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                            foreach($gg as $chave => $valor){
                                echo "<td>$linha[$valor]</td>";
                            }
                    }
                    echo "</tr>
                    </table>
                        ";
                }
                    echo "
                        <input type='button' class='btn btn-secondary btn-lg btn-block' onclick=location.href='READ.php?pagina=$previus_pg'; value='Anterior' />
                        <input type='button' class='btn btn-secondary btn-lg btn-block' onclick=location.href='READ.php?pagina=$next_pg'; value='Proxima' />
                        ";
            ?>
        </div>
    </body>
</html>