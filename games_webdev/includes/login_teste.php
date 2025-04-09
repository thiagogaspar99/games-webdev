<?php 

    function cripto($senha) {
        $c = '';
        for ($pos = 0; $pos < strlen($senha); $pos++) {
            $letra = ord($senha[$pos]) + 1;
            $c .= chr($letra);
        }
        return $c;
    }

    function gerarHash($senha) {
        $txt = cripto($senha);
        $hash  = password_hash($txt, PASSWORD_DEFAULT);
        return $hash;
    }

    function testarHash($senha, $hash) {
        $verificando = password_verify(cripto($senha), $hash);
        return $verificando;
    }

    echo gerarHash('teste');


?>