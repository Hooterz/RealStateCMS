<?php
    declare(strict_types=1);
    namespace controller\tools;

    class RequestChecker{

        public static function CheckEmpty(array &$args): bool|array{
            if(empty($args)) return false;
            foreach($args as &$value)
                $value = htmlspecialchars($value);
            return $args;
        }


    }
?>