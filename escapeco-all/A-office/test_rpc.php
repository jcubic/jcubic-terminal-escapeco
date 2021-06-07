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
  function logs($token, $choice = null) {
    $this->valid_token($token);
    switch ($choice) {
      case null:
<<<<<<< HEAD
        return '[[ send "1. hello\n 2. Password::logs" ]]';
=======
        return '[[ send "1. hello; 2. Password::logs" ]]';
>>>>>>> ac6fc94709459de0f182c9034d9993b9b714f161
      case 1:
        return '[[ send "this is hello as 1::logs::1000" ]]';
      case 2:
        return '[[ send "his password is secret::logs::1000" ]]';
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
