<?php 
    
    session_start();
   
    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = "";
        $_SESSION['nome'] = "";
        $_SESSION['tipo'] = "";
    }


    function cripto($senha) {
        $c = '';
        for ($pos = 0; $pos < strlen($senha); $pos++) {
            $letra = ord($senha[$pos]) + 1;     // ord =  mostra qual é o código de uma letra
            $c .= chr($letra);                  // chr = mostra qual é a letra de um código
        }
        return $c;
    }

    function gerarHash($senha) {
        $txt = cripto($senha);
        $hash = password_hash($txt, PASSWORD_DEFAULT);
        return $hash;
    }

    function testarHash($senha, $hash) {
        $verificando = password_verify(cripto($senha), $hash);
        return $verificando;
    }

    function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['nome']);
        unset($_SESSION['tipo']);
    }

    function is_logado() {
        if (empty($_SESSION['user'])) {
            return false;
        } else {
            return true;
        }
    }
    
    function is_admin() {
        $t = $_SESSION['tipo'] ?? null;
        if (is_null($t)) {
            return false;
        } else {
            if ($t == 'admin') {
                return true;
            } else {
                return false;
            }
        }
    }

    function is_editor() {
        $t = $_SESSION['tipo'] ?? null;
        if (is_null($t)) {
            return false;
        } else {
            if ($t == 'editor') {
                return true;
            } else {
                return false;
            }
        }
    }
?>