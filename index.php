<?php
    /*
    date_default_timezone_set("America/Fortaleza");
    $data_criacao = date("d-m-Y H:i:s");
    echo $data_criacao;
    */

    //Pagina selecionada (da pra melhorar)
    $tabela = isset( $_POST["tabela"] ) ? $_POST["tabela"] : "cliente";
    if($tabela == "Choose..."){
        $tabela = "cliente";
    }

    //Conexões
    require("App/autoload.php");
    use DB\Conexao as Banco;
    $conexao = Banco::getInstance();

    //Paginação (meia boca)
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
    
    

    //QUERY
    $sql_query = "SELECT * FROM $tabela LIMIT $inicio, $qnt_result_pg";
    $q = $conexao->prepare($sql_query);
   


    //Pegar nomes das colunas das tabelas (gambiarra)
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

    $id_name = $tabela."_id";

    //echo $id_name;
    
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
            <form method="POST" action="index.php">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-light" type="submit">SELECIONAR TABELA</button>
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


        <form method="POST" action="FORMC.php">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-light" type="submit">CREATE</button>
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
                                if($valor == $id_name){
                                    $id = $linha[$valor];
                                }

                                echo "<td>$linha[$valor]</td>";
                            }
                                echo "
                                        <td>
                                            <input type='button'  
                                                onclick=location.href='DELETE.php?id=$id&tabela=$tabela' 
                                                class='btn btn-danger'
                                                value='DELETE' 
                                                style='margin-bottom: 5px;
                                                        width: 87px'
                                            />
                                            <input type='button'  
                                                onclick=location.href='FORMU.php?id=$id&tabela=$tabela'
                                                class='btn btn-warning' 
                                                value='UPDATE' 
                                                style='width: 87px'
                                            />
                                        </td>
                                
                                
                                ";
                    }
                    echo "</tr>
                    </table>
                        ";
                }

                    //Preciso arrumar isso
                    echo "
                        <input type='button' class='btn btn-secondary btn-lg btn-block' onclick=location.href='index.php?pagina=$previus_pg'; value='Anterior' />
                        <input type='button' class='btn btn-secondary btn-lg btn-block' onclick=location.href='index.php?pagina=$next_pg'; value='Proxima' />
                        ";
            ?>
        </div>
    </body>
</html>