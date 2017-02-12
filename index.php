
<!DOCTYPE html>
<html>
    <head>
        <title>учет</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta charset="utf-8">
        <meta name="description" content="Учет рабочего времени, рабочий процесс">
        <meta name="keywords" content="работы, табель, часы, рабочий день, зарплата">
        <link rel="stylesheet" href="index.css">
        <script src="index.js"></script>        
    </head>
    <body> 
        <header>
            <div class="head"><span>Добро пожаловать на сайт учета работников.</span></div>   
            <?php
                if(isset($_COOKIE['log'])) echo "<div class='login'><a href='cabinet.php'>".$_COOKIE['log']."</a> </div>"; 
                else echo "<div class='login'><a href='login.php'> вход </a> </div>";
            ?>
        </header>
    </body>
</html>