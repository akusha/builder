
<!DOCTYPE html>
<html>
    <head>
        <title>Рабочий стол</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta charset="utf-8">
        <meta name="description" content="Рабочий стол, Стартовая страница, Домашняя страница">
        <meta name="keywords" content="Рабочий стол, стартовая страница, доманшяя страница, пусани">
        <link rel="stylesheet" href="index.css">
        <script src="index.js"></script>
        <script src="jquery-3.1.1.js"></script>
    </head>
    <body> 
        <header class="header">
            <a href="http://localhost"><img src="image/logo_100_100.png" class="logo"/></a>            
		<nav>
            <ul class = "topmenu">
                <li>Рассказы
                    <ul class = "submenu">
                        <li>роман</li>
                        <li>рассказ</li>
                        <li>Стихи</li>
                    </ul>
                </li>
                <li><a href="https://ok.ru">odnok</a></li>
                <li><a href="https://www.youtube.com/">youtube</a></li>
                <li><a href="https://www.facebook.com/">facebook</a></li>
                <li><a href="https://vk.com">vk</a></li>
                <li><a href="https://www.hedbed.ru/check_in.html">skype</a></li>   
            </ul>
        </nav>
        </header>
        <?php
            if(isset($_COOKIE['log'])) echo "<div class='login'><a href='cabinet.php'>".$_COOKIE['log']."</a> </div>"; 
            else echo "<div class='login'><a href='login.php'> вход </a> </div>";
        ?>
        
        <!-- <script src="index.js" defer></script> -->
         <div class="container">
            <div class="leftcol">
                <li><span>..........</span></li>                        
                <li><a href="#g1">Глава1 <b>Встреча.</b></a></li>
                <li><a href="#g2">Глава2 <b>Знакомство.</b></a></li>
                <li><a href="#g3">Глава3 <b>Привязывание.</b></a></li>
                <li><a href="#g4">Глава4 <b>Горячка.</b></a></li>
                <li><a href="#g5">Глава5 <b>Любовь.</b></a></li>                     
                               
            </div>
            <div class="rightcol">                
                <h1>...........</h1>                
                <h2 class="rt" id = "g1">Встреча, (или самое начало)</h2>
                <p>Ничто ничего не предвещало, по крайней мере я так думаю...</p>
                <p>Так себе, еще один день... Замечательна она тем что я в тот день я повстречал мою любовь.</p>
                <p>Возвращаясь мысленно в то время, я не могу воскресить те чувства, что я тогда испытывал, не знаю почему... Если только 
                   восстановить картину по памяти, хотя и от него не много осталось...</p>
                <p id="text">Постараюсь быть предельно честым.. т.е. постараюсь на сколько это возможно не преукращивать внутренние картины.</p>
                <p>Первый раз когда я ее увидел, она мне напомнила кое кого, не знаю почему. Хотя я увидел ее из далека, и не мог рассмотреть.
                   Когда же нас познакомили, и я увидел ее вблизи, вот что я испытал... </p>
                <p>-Да все.... я сам не знаю что.... подумать надо, что б понять.. что б уяснить....</p>
                <p>Пожалуй она казалась необычной.. </p><p></p><p></p><p></p>
                <button type="button" onclick="fTest()">Изменить</button>
            </div>
        </div>
        <footer>
        <div>
            <a href="mailto:akusha260@gmail.com?subject=вопрос к администратору">&#9993 вопрос к админ.</a>
            Магомедов Магомед Кадиевич.
        </div>
        </footer>

    </body>
</html>