<?php
include_once("Database.php");

//DB constants
define('CONNECTION',"mysql:host=localhost;dbname=prizes");
define('USER_NAME',"root");
define('PASSWORD' ,"099");

//Game constants
$constants = reset(Database::select('config'));

define("ROWS",  $constants['cells']);
define("GAMES", $constants['games']);
define("PRIZE", $constants['prize']);