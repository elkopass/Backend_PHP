<?php
    function prepareMessage($text){
        return json_encode(["message" => $text]);
    }
?>