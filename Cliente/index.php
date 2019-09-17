<?php
    /*
    date_default_timezone_set("America/Fortaleza");
    $data_criacao = date("d-m-Y H:i:s");
    echo $data_criacao;
    */


    require("../App/autoload.php");

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
    

    $sql_query = "SELECT * FROM cliente LIMIT $inicio, $qnt_result_pg";

    $q = $conexao->prepare($sql_query);
   
    //Banco::desconectar();
?>


<html>
    <head>
        <meta name="viewport" content="width-device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="../styles/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="../styles/bootstrap/js/jquery-3.4.1.min.js" </script>
        <script type="text/javascript" src="../styles/bootstrap/js/bootstrap.min.js" </script>
    </head>
    <body style='background: #454d55'>  
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
                        <tr>
                            <th scope='col'>cliente_id</th>
                            <th scope='col'>loja_id</th>
                            <th scope='col'>primeiro_nome</th>
                            <th scope='col'>ultimo_nome</th>
                            <th scope='col'>email</th>
                            <th scope='col'>endereco_id</th>
                            <th scope='col'>ativo</th>
                            <th scope='col'>data_criacao</th>
                            <th scope='col'>ultima_atualizacao</th>
                            <th scope='col'>Ações</th>
                        </tr>
                        
                    </thead>
                
                    <tbody>
                    ";
                    while($linha = $q->fetch(PDO::FETCH_ASSOC)){
                    //die($linha);
                        $id = $linha['cliente_id'];
                        echo "
                            <tr>
                                <td>".$linha['cliente_id']."
                                </td>
                            
                                <td>".$linha['loja_id']."
                                </td>

                                <td>".$linha['primeiro_nome']."
                                </td>

                                <td>".$linha['ultimo_nome']."
                                </td>

                                <td>".$linha['email']."
                                </td>

                                <td>".$linha['endereco_id']."
                                </td>

                                <td>".$linha['ativo']."
                                </td>
                                
                                <td>".$linha['data_criacao']."
                                </td>
                                
                                <td>".$linha['ultima_atualizacao']."
                                </td>
                                <td>
                                    <input type='button'  
                                        onclick=location.href='deleteCliente.php?id=$id' 
                                        class='btn btn-danger'
                                        value='DELETE' 
                                        style='margin-bottom: 5px;
                                                width: 87px'
                                    />
                                    <input type='button'  
                                        onclick=location.href='FORMcliente.php?id=$id&action=1'
                                        class='btn btn-warning' 
                                        value='UPDATE' 
                                        style='width: 87px'
                                    />
                                </td>
                            </tr>
                        ";
                    }
                    echo "</tbody>
                        </table>";
                }
            ?>  
            <?php
                echo "
                    <input type='button' class='btn btn-secondary btn-lg btn-block' onclick=location.href='index.php?pagina=$previus_pg'; value='Anterior' />
                    <input type='button' class='btn btn-secondary btn-lg btn-block' onclick=location.href='index.php?pagina=$next_pg'; value='Proxima' />
                    "
            ?>
        </div>
    </body>
</html>