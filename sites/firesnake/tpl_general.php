<!doctype html>
<html>
<head>
    <title>FireSnake Game</title>
    <meta charset="utf-8">
    <meta name="keywords" content="змея, змейка, игра змейка, играть в змейку, змейка онлайн, змейка online, играть в змейку онлайн, играть в змейку online, snake, play snake, play snake online">
    <meta name="description" content="играть в змейку, игры в интернете, играть в интернете, игры онлайн, игры online, игры на html5, игра html5, canvas">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="image/x-icon" rel="icon" href="img/icon.ico">
    <link type="image/x-icon" rel="shortcut icon" href="img/icon.ico">
    <script language="javascript" type="text/javascript" src="js/jquery-2.0.2.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/snake-min.js"></script>
</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter25762580 = new Ya.Metrika({id:25762580,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25762580" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<div id="main" class="center">
	<div id="banner">
        <img src="img/logo.png" width="600px" alt="FireSnake Game. Игра Змейка.">
    </div>
    <br>
    <div id="matrix" class="center">
        <canvas id="canvas2d" width="600px" height="450px">
            <div>К сожалению Ваш браузер не поддерживает HTML5 Canvas. Обновите браузер до последней версии.</div>
        </canvas>
    </div>
    <br>
    <div id="contentBlock" class="blockPadding">
        <?=$content?>
    </div>
    <br>
    <div id="rules" class="blockPadding">
        <h3>Правила игры</h3>
        <table>
            <tr>
                <td></td>
                <td>Управление змейкой осуществляется клавишами: "вверх", "вниз", "вправо", "влево".</td>
            </tr>
            <tr>
                <td></td>
                <td>При столкновении со стенками змейка умирает.</td>
            </tr>
            <tr>
                <td></td>
                <td>Змейка ползает по полю и есть фрукты. При поедании каждого фрукта увеличивается ее тело и количество очков. Количество очков, добавляемых при съедании фрукта, зависит от уровня.</td>
            </tr>
            <tr>
                <td></td>
                <td>По полю бегают ножницы, которые при пересечении со змейкой, уменьшают уровень ее жизни на некоторое значение, которое зависит от уровня. Есть два вида ножниц: серые бегают сами по себе, а красные следят за змейкой, когда тело змейки и ножницы находятся в соседних клетках. Таким образом, красные ножницы будут следовать за телом змейки.</td>
            </tr>
            <tr>
                <td></td>
                <td>На поле периодически появляется фрукт в виде красного креста, который позволяет лечить змею.</td>
            </tr>
            <tr>
                <td></td>
                <td>Змея может отстреливаться от ножниц. Выстрел осуществляется клавишей "пробел". Пуля летит в направлении текущего движения змейки. При выстреле тело змейки уменьшается.</td>
            </tr>
            <tr>
                <td></td>
                <td>Игра заканчивается, когда вы набираете 100 очков.</td>
            </tr>
        </table>
    </div>
    <br><br>
</div>
</body>
</html>