<?php
    namespace Validations;

    class Validate{
        public static function __e($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    }







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