<?php
    require("../App/autoload.php");
    use DB\Conexao as Banco;
    $conexao = Banco::getInstance();

    $id = $_GET["id"];

    $pdo = $conexao;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SET FOREIGN_KEY_CHECKS = 0;";
    $sql .= "DELETE FROM cliente where cliente_id = ?";
    $sql .= ";SET FOREIGN_KEY_CHECKS = 1;";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    header("Location: index.php");