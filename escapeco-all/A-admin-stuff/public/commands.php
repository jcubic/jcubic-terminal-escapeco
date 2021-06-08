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
      if ($username == 'agent') {
         if ($password == 'secret') {
          $_SESSION['token'] = md5($username . microtime());
          return $_SESSION['token'];

        }
      } else {
return null;
      }}}
      

handle_json_rpc(new Commands());

?>