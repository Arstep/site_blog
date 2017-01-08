<section id="contact">

    <div>
        <ul id="message" style='color: forestgreen'>
            <?php if (isset($result)) {
                echo $result;
            } ?>
        </ul>

        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method=post onsubmit="return validate(this)">
            <div align="center">
                <h4>Форма для связи с администратором</h4>
                Имя*<br/>
                <input type="text" name="name" size="40">
                <br/>Контактный email*<br/>
                <input type="text" name="email" size="40">
                <br/>Сообщение*<br/>
                <textarea rows="5" name="message" cols="40"></textarea>
                <br/><input type="submit" value="Отправить">
            </div>
        </form>
    </div>

    <div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d296876.16783075687!2d96.80495483724525!3d-12.135543563488588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1482767857306"
            width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

</section>

<div id="toadmin">
    <p>&copy;2016. All rights reserved.
        <a href="/admin/index" onclick="return confirm('Вы уверены что вы администратор?')">
            Тестовый вход для администратора</a>
    </p>
</div>