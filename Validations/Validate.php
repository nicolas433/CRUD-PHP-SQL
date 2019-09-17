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