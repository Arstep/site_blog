<?php if (isset($_GET['status']) && $_GET['status'] == 'error')
    echo '<h3 class="error">При сохранении статьи возникли ошибки</h3>'; ?>
<?php if (isset($_GET['status']) && $_GET['status'] == 'saved')
    echo '<h3 class="saved">Изменения сохранены</h3>'; ?>


<h2>Редактирование статьи</h2>

<form action="admin.php?action=editArticle" method="post" enctype='multipart/form-data'>

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
                          maxlength="100000" style="height: 20em"><?php echo $article->content ?></textarea>
        </li>
        <li>
            <label for="face">Главное фото</label>
            <input type="file" name="face">
    <?php if (isset($article->imgLink['face'])) { ?>
            <a class="delImg" href="admin.php?action=deleteImg&id=<?php echo $article->id ?>&tooltip=face"
        onclick="return confirm('Удалить картинку?')">
                Удалить картинку
            </a>
        <img src="<?php echo $article->imgLink['face'] ?>" alt="" width=40%>
    <?php } ?>
        </li>
        <li>
            <label for="first">Первое фото</label>
            <input type="file" name="first">
    <?php if (isset($article->imgLink['first'])) { ?>
            <a class="delImg" href="admin.php?action=deleteImg&id=<?php echo $article->id ?>&tooltip=first"
        onclick="return confirm('Удалить картинку?')">
                Удалить картинку
            </a>
        <img src="<?php echo $article->imgLink['first'] ?>" alt="" width=40%>
    <?php } ?>
        </li>
        <li>
            <label for="second">Второе фото</label>
            <input type="file" name="second">
    <?php if (isset($article->imgLink['second'])) { ?>
            <a class="delImg" href="admin.php?action=deleteImg&id=<?php echo $article->id ?>&tooltip=second"
               onclick="return confirm('Удалить картинку?')">
                Удалить картинку
            </a>
        <img src="<?php echo $article->imgLink['second'] ?>" alt="" width=40%>

    <?php } ?>
        </li>
    </ul>

    <div class="buttons">
        <input type="submit" name="saveChanges" value="Сохранить">
        <input type="submit" formnovalidate name="cancel" value="Отменить" onclick="return confirm('Отменить?')">
    </div>

</form>

<?php if ( ! empty($article->title)) {?>
    <a href="admin.php?action=deleteArticle&id=<?php echo $article->id ?>" onclick="return confirm('Удалить эту статью?')">
        Удалить эту статью
    </a>
<?php } ?>

</section>
