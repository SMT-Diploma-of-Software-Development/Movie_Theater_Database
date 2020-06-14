<?php
session_start();
// if session holds account information
if(isset($_SESSION['account'])){
  // verify account
  $account = authCheck($_SESSION['account']['username'], $_SESSION['account']['password']);
  if(isset($account)){
    // login succeed
    $login = true;
    // store account information to session
    $_SESSION['account'] = $account;
  } else {
    // login failed
    $login = false;
    // dispose session
    unset($_SESSION['account']);
  }
// if session does not hold account information
} else {
  // login failed
  $login = false;
}
?>