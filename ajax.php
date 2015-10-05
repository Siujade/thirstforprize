<?php
require('Database.php');

$games = filter_input(INPUT_POST, 'games', FILTER_SANITIZE_NUMBER_INT);
$amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_INT);
$ip = $_SERVER['REMOTE_ADDR'];

if(isset($games)) {
    echo Database::update('users', array('games_left'=>$games), array('ip'=>$ip));
}

if(isset($amount)) {
   echo Database::update('users', array('amount'=>$amount), array('ip'=>$ip));
}