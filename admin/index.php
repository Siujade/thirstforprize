<?php
  require_once('auth.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
     header{
         width:100%;
     }
     h1{
         text-align: center;
     }
     nav{
         margin: 0 auto;
         width:410px;
     }
     header nav ul li{
         list-style: none;
         display: inline;
         width:200px;
     }
    </style>
</head>
<body>
<header>
    <h1>
        Admin Panel
    </h1>
    <nav>
        <ul>
            <li><a href="config">натройки</a></li>
            <li><a href="winners">печалби</a></li>
        </ul>
    </nav>
</header>

</body>
</html>