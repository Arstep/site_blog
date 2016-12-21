<h2><?php echo $data['formTitle']?></h2>

    <form action="admin.php?action=<?php echo $data['formAction']?>" method="post" enctype='multipart/form-data'>

        <input type="hidden" name="id" value="<?php echo $article->id ?>"/>

<!--        --><?php //if ( isset( $results['errorMessage'] ) ) { ?>
<!--            <div class="errorMessage">--><?php //echo $results['errorMessage'] ?><!--</div>-->
<!--        --><?php //} ?>

        <ul>
            <li>
                <label for="pubdate">Дата публикации</label>
                <input class="pole" type="date" name="pubdate" placeholder="ГГГГ-MM-ДД"
                       required maxlength="10"
                       value="<?php echo $article->pubdate?>">
            </li>
            <li>
                <label for="title">Название статьи</label>
                <input class="pole" type="text" name="title" placeholder="Какое-то название"
                       required autofocus maxlength="255" value="<?php echo htmlspecialchars($article->title)?>">
            </li>
            <li>
                <label for="subtitle">Подзаголовок</label>
                <input class="pole" type="text" name="subtitle" placeholder="необязательный"
                       maxlength="255" value="<?php echo htmlspecialchars($article->subtitle)?>">
            </li>
            <li>
                <label for="description">Описание</label>
                <textarea name="description" id="description" placeholder="Краткое вступление" maxlength="100000"
                          required style="height: 5em"><?php echo htmlspecialchars( $article->description )?></textarea>
            </li>
            <li>
                <label for="content">Статья</label>
                <textarea name="content" placeholder="HTML содержание статьи. Теги разрешены." required
                          maxlength="100000" style="height: 60em"><?php echo $article->content?></textarea>
            </li>
            <li>
                <label for="face">Главное фото</label>
                <input type="file" name="face">
                <img src="<?php echo $article->imgLink['face']?>" alt="<?php echo $article->imgLink['face']?>"
                     width=40%>
<!--                <button onclick="--><?php //echo $_SERVER['PHP_SELF']. '?delete=face'?><!--">Удалить</button>-->
            </li>
            <li>
                <label for="first">Первое фото</label>
                <input type="file" name="first">
                <img src="<?php echo $article->imgLink['first']?>" alt="<?php echo $article->imgLink['face']?>"
                     width=40%>
            </li>
            <li>
                <label for="second">Второе фото</label>
                <input type="file" name="second">
                <img src="<?php echo $article->imgLink['second']?>" alt="<?php echo $article->imgLink['face']?>"
                     width=40%>
            </li>
        </ul>

        <div class="buttons">
            <input type="submit" name="saveChanges" value="Сохранить">
            <input type="submit" formnovalidate name="cancel" value="Отменить">
        </div>

    </form>

</section>
