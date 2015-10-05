<?php
$username = filter_input(INPUT_POST, 'user');
$password = filter_input(INPUT_POST, 'password');

if($username == 'shade' && $password == "099") {
    session_start();
    $_SESSION['username'] = $username;
}

if(empty($_SESSION['username'])) {
    if($username || $password) { ?>
        <span style="color:#f40">невалиден вход!</span>
   <? } ?>
    <form id="login-form" method="POST">
        <label>
            <input name="user" type="text"/>
            <input name="password" type="password"/>
            <button type="submit">вход</button>
            <button type="reset">изтрий</button>
        </label>
    </form>
<? die(); } ?>