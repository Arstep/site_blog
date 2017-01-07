
<h2>Редактирование статьи</h2>

<form action="/admin/editArticle" method="post" enctype='multipart/form-data'>

    <input type="hidden" name="id" value="<?php echo $article->id ?>"/>

    <ul>
        <li>
            <label for="pubdate">Дата публикации</label>
            <input class="pole" type="date" name="pubdate" placeholder="ГГГГ-MM-ДД"
                   required maxlength="10"
                   value="<?php echo $article->pubdate ?>">
        </li>
        <li>
            <label for="title">Название статьи</label>
            <input class="pole" type="text" name="title" placeholder="Какое-то название"
                   required autofocus maxlength="255" value="<?php echo htmlspecialchars($article->title) ?>">
        </li>
        <li>
            <label for="subtitle">Подзаголовок</label>
            <input class="pole" type="text" name="subtitle" placeholder="Сноска" required
                   maxlength="255" value="<?php echo htmlspecialchars($article->subtitle) ?>">
        </li>
        <li>
            <label for="description">Описание</label>
                <textarea name="description" id="description" placeholder="Краткое вступление" maxlength="100000"
                          required style="height: 5em"><?php echo htmlspecialchars($article->description) ?></textarea>
        </li>
        <li>
            <label for="content">Статья</label>
                <textarea name="content" placeholder="HTML содержание статьи. Теги разрешены." required
                          maxlength="100000" style="height: 60em"><?php echo $article->content ?></textarea>
        </li>
    </ul>

    <div class="picture">
        <div>
            <p>Главное фото</p><br>
            <input type="file" name="face">
        </div>
        <div>
            <?php if (isset($article->imgLink['face'])) { ?>
                <a class="delImg" href="/admin/deleteImg/id/<?php echo $article->id ?>/tooltip/face"
                   onclick="return confirm('Удалить картинку?')">
                    Удалить картинку
                </a>
                <img src="/<?php echo $article->imgLink['face'] ?>" alt="">
            <?php } ?>
        </div>
        <div style="clear: both"></div>
    </div>

    <div class="picture">
        <div>
            <p>Первое фото</p><br>
            <input type="file" name="first">
        </div>
        <div>
            <?php if (isset($article->imgLink['first'])) { ?>
                <a class="delImg" href="/admin/deleteImg/id/<?php echo $article->id ?>/tooltip/first"
                   onclick="return confirm('Удалить картинку?')">
                    Удалить картинку
                </a>
                <img src="/<?php echo $article->imgLink['first'] ?>" alt="">
            <?php } ?>
        </div>
        <div style="clear: both"></div>
    </div>

    <div class="picture">
        <div>
            <p>Второе фото</p><br>
            <input type="file" name="second">
        </div>
        <div>
            <?php if (isset($article->imgLink['second'])) { ?>
                <a class="delImg" href="/admin/deleteImg/id/<?php echo $article->id ?>/tooltip/second"
                   onclick="return confirm('Удалить картинку?')">
                    Удалить картинку
                </a>
                <img src="/<?php echo $article->imgLink['second'] ?>" alt="">
            <?php } ?>
        </div>
        <div style="clear: both"></div>
    </div>

    <div class="buttons">
        <input type="submit" name="saveChanges" value="Сохранить">
        <input type="submit" formnovalidate name="cancel" value="Отменить"
               onclick="return confirm('Выйти без сохранения?')">
    </div>

</form>

<?php if ( ! empty($article->title)) {?>
    <a href="/admin/deleteArticle/id/<?php echo $article->id ?>" onclick="return confirm('Удалить эту статью?')">
        Удалить эту статью
    </a>
<?php } ?>

</section>
