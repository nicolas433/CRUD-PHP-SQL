<?php
    require_once(__DIR__."/App/autoload.php");
    use DB\Conexao as Banco;

    $conexao = Banco::getInstance();

    $sql_query = "SELECT * FROM cliente WHERE cliente_id>30 limit 30";

    $q = $conexao->prepare($sql_query);
   

    //Banco::desconectar();





?>


<html>
    <head>
    </head>
    <body>  
            <div>
                <?php                
                    if($q->execute()){
                    echo "
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>nome</th>
                            </tr>
                            
                        </thead>
                    
                        <tbody>
                        ";
                        while($linha = $q->fetch(PDO::FETCH_ASSOC)){
                        // die($linha);
                            
                            echo "
                                <tr>
                                    <td>".$linha['cliente_id']."
                                    </td>
                                
                                    <td>".$linha['primeiro_nome']."
                                    </td>
                                    
                                </tr>
                            ";
                        }
                        echo "</tbody>
                                </table>";
                    }
                ?>

            <table>
                
                
            </table>        
        </div>
    </body>
</html>