<?php

$result = array();

$file = fopen("config.txt", "r");

if ($file) {
    while (($line = fgets($file)) !== false) {
        if(strlen($line) > 2 && substr($line, 0, 1) != "#" && substr($line, 0, 1) != " ") {

            $str = explode("=", $line);
            $keys = $str[0];
            $value = $str[1];

            $keys = explode(".", $keys);
            $current = &$result;
            foreach ($keys as $key) {
                $current = &$current[$key];
            }
            $value = trim($value);
            $value = trim($value, '"');

            if(is_numeric($value))
                $value = $value+0;
            elseif ($value == "TRUE" || $value == "FALSE" || $value == "true" || $value == "false")
                $value = (bool) $value;

            $current = $value ;

        }
    }
    fclose($file);
} else {
    echo "File Not Found";
}

var_dump($result);