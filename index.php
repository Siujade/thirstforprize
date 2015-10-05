<?php
spl_autoload_register(function ($class) {
    include_once $class . ".php";
});

$player = new User($_SERVER['REMOTE_ADDR']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Икам да спечеля!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="misc/main.css"/>
</head>
<body>
   <?php if($player->games_left > 0){ ?>
    <div>
        <h1>Печалба днес: <span id="prize"><?= $player->amount ?></span>лв.</h1>
        <h1>Оставащи игри: <span id="games"><?= $player->games_left ?></span></h1>
    </div>
    <table>
        <?php
          echo draw::table(ROWS);
        ?>
    </table>
    <?php } else { ?>
       <div id="try-again">
           <h1>Нямаш повече опити за днес :(<br>Опитай пак утре!</h1>
           <h1>Печалба до момента: <span id="prize"><?= $player->amount ?></span>лв.</h1>
       </div>
    <?php die; } ?>
</body>
<script src="misc/gameLogic.js"></script>
</html>