<section id="first">
    <div id="sliderBack" data-counter="0">
        <img src="/views/img/slider3.jpg">
        <img src="/views/img/slider4.jpg">
        <img src="/views/img/slider2.jpg">
        <img src="/views/img/slider1.jpg">
    </div>

    <article>
        <h1>Самостоятельные походы<br>на парусных яхтах</h1>
        <p>Самостоятельные походы на парусных яхтах</p>
        <p>Статьи о переходах и жизни на борту</p>
        <p>Матчасть, навигация, чартеры</p>
    </article>

    <a href="#" id="toTop">&Lambda;</a>
</section>



<section id="second">
    <article>
        <div id="gallery">
            <?php foreach ($this->listArticles as $article => $instance) { ?>
            <a href="<?php echo 'index/article/id/' .$instance['id']?>"
               style="background-image: url( <?php echo $instance['face']?> )">
                <div class="hide">
                    <p> <?php echo $instance['description']?> </p>
                    <img src="/views/ico/wheela.png" alt="">
                    <h3> <?php echo $instance['title']?> </h3>
                    <strong> <?php echo $instance['subtitle']?> </strong>
                </div>
            </a>
            <?php } ?>
            <div style="clear: both"></div>
        </div>
    </article>
    <article>
        <div id="category">
            <a href="#"><img src="views/ico/book.png" alt="p"><h3>Обучение</h3><p>Система яхтенной квалификации International Yacht Training</p></a>
            <a href="#"><img src="/views/ico/anchor.png" alt="p"><h3>Чартер яхт</h3><p>Аренда яхт в Турции, Греции, Таиланде, Канарах, Хорватии, Сейшелах</p></a>
            <a href="#"><img src="/views/ico/map.png" alt="p"><h3>Маршруты</h3><p>Регионы плавания и условия пребывания в маринах</p></a>
            <a href="#"><img src="/views/ico/sailboat.png" alt="p"><h3>Матчасть</h3><p>Устройство парусной яхты. Управление яхтой</p></a>
            <div style="clear: both"></div>
        </div>
    </article>
</section>







<section id="third" data-type="parallax" data-speed="5">
    <div class="note">
        <a href="http://vodabereg.ru/event/kamchatskiy-moryak-poteryalsya-v-tihom-ok/">
            <h4>Камчатский моряк потерялся в Тихом океане, доверившись экстрасенсам</h4>
            <div class="border"></div>
            <p>56-летний моряк с Камчатки 15 сентября пропал с борта рыболовного траулера в Тихом океане</p>
        </a>
        <a href="http://www.yachtrussia.com/news/2016/04/19/news_5918.html">
            <h4>От Тотьмы до Устюга</h4>
            <div class="border"></div>
            <p>В Великом Устюге 4 июля завершилась молодежная исследовательская географическая экспедиция «Сухона-2016», проведенная клубом «Корабелы Прионежья»</p>
        </a>
    </div>
    <div class="note">
        <a href="http://www.novate.ru/blogs/020614/26555">
            <h4>Лучшие эко-яхты мира</h4>
            <div class="border"></div>
            <p>Для обычного человека расходы на владение яхтой просто астрономические. Решением проблемы является разработка новых гибридных моторов и альтернативных видов видов энергии</p>
        </a>
        <a href="http://www.yachtrussia.com/news/2016/04/19/news_5918.html">
            <h4>Парус – это серьезно</h4>
            <div class="border"></div>
            <p>Согласно этому исследованию яхтинг по смертности превосходит почти все экстремальные занятия</p>
        </a>
    </div>
    <div class="note">
        <a href="http://vodabereg.ru/blog/valerijj-berezhinskijj-filosofiya-parus/">
            <h4>Валерий Бережинский: Философия парусного бродяги</h4>
            <div class="border"></div>
            <p>В очередной колонке Валерия – о маньяне, аскетизме и семейных командах в море</p>
        </a>
        <a href="http://yacht-com.ru/news/soloveckaja-regata-2016.html">
            <h4>Соловецкая регата 2016</h4>
            <div class="border"></div>
            <p>1 августа из Архангельска в сорок второй раз стартовала традиционная Соловецкая регата</p>
        </a>
    </div>

</section>





<section id="forty">
    <article>
        <h6>Периодические издания по интересующей теме</h6>
        <a href="http://www.yachtrussia.com//"><img src="/views/img/press_Yacht_87_7.jpg" alt="p"></a>
        <a href="http://www.yachting.su/"><img src="/views/img/press_yahtingSu.jpg" alt="p"></a>
        <a href="http://katera.ru/"><img src="/views/img/press_KaY.jpg" alt="p"></a>
        <a href="http://www.classicboat.co.uk/"><img src="/views/img/press_classic-boat.jpg" alt="p"></a>
        <a href="http://www.mby.ru/"><img src="/views/img/press_motorBoat.jpg" alt="p"></a>
        <a href="http://www.sailmagazine.com/"><img src="/views/img/press_sail.jpg" alt="p"></a>
        <a href="http://www.boatinternational.ru/"><img src="/views/img/press_Boat.jpg" alt="p"></a>
        <a href="http://www.pbo.co.uk/"><img src="/views/img/press_PBO.jpg" alt="p"></a>
        <div style="clear: both"></div>
    </article>
</section>








