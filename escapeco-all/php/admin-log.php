<?php

require('json-rpc.php');
session_start();

function valid_token($token) {
    if ($_SESSION['token'] != $token) {
      throw new Exception("Wrong token");
    }
}

class Commands {
    function login($username, $password) {
        if ($username == 'Warden-B22$' && $password == '3') {
          $_SESSION['token'] = md5($username . microtime());
          return $_SESSION['token'];
        }
    }
    
}

handle_json_rpc(new Commands());

?>