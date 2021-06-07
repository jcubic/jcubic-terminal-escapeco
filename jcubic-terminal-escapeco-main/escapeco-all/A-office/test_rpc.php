<?php
require('json-rpc.php');

$users = array(
  array(
    'user' => 'jon',
    'password' => 'secret'
  )
);

function get_user($username) {
  global $users;
  $arr = array_filter($users, function($user) use ($username) {
    return $user['user'] == $username;
  });
  if (count($arr) == 1) {
    return $arr[0];
  }
  return null;
}

session_start();

class Demo {
  function valid_user($username) {
    return get_user($username) != null;
  }
  // ---------------------------------------------------------------------------
  function login($username, $password) {
    $user = get_user($username);
    if ($user == null) {
      return false;
    }
    if ($user['password'] != $password) {
      return null;
    }
    $_SESSION['token'] = md5(time());
    return $_SESSION['token'];
  }
  // ---------------------------------------------------------------------------
  function valid_token($token) {
    if ($_SESSION['token'] != $token) {
      throw new Exception("Access Denied");
    }
  }
  // ---------------------------------------------------------------------------
  
  // ---------------------------------------------------------------------------
  function logs($token, $choice = null) {
    $this->valid_token($token);
    switch ($choice) {
      case null:
        return '[[ send "1. \\n2. \\n3. ::logs" ]]';
      case 1:
        return '[[ send " ::logs::10000" ]]';
      case 2:
        return '[[ send " ::logs::1000" ]]';
      case 'exit':
        return '[[ send ]]';
      case '__bug__':
        return '';
      default:
        throw new Error('Invalid choice');
    }
  }
  // ---------------------------------------------------------------------------
  function hello($token) {
    $this->valid_token($token);
    return "Welcome jon";
  }
}

handle_json_rpc(new Demo());

?>
