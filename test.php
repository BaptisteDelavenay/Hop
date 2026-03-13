<?php

    // echo "bonjour";

    
    function randomCode(){
        $randomCode = "";
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i=0; $i < 4; $i++) { 
            $randomNumber = rand(0, strlen($caracteres)-1);
            $randomCode .= $caracteres[$randomNumber];
        }
        return $randomCode;
    }

    echo randomCode();

?>