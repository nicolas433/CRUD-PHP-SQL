<?php

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
