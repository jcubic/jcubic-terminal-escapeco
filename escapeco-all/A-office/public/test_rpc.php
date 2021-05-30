<?php
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
  ?>