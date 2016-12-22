<?php //if (isset($_GET['status']) && $_GET['status'] == 'error')
//            echo '<h3 class="error">При сохранении статьи возникли ошибки</h3>';?>
<?php //if (isset($_GET['status']) && $_GET['status'] == 'saved')
//    echo '<h3 class="saved">Изменения сохранены</h3>';?>

<h2>Все статьи</h2>
    <table>
        <tr>
            <th>Дата публикации</th>
            <th>Название</th>
            <th>Сноска</th>
        </tr>

        <?php foreach ($this->listArticles as $num => $article) { ?>

            <tr onclick="location='admin.php?action=editArticle&id=<?php echo $article['id']?>'">
                <td><?php echo $article['pubdate']?></td>
                <td>
                    <?php echo $article['title']?>
                </td>
                <td>
                    <?php echo $article['subtitle']?>
                </td>
            </tr>

        <?php } ?>

    </table>

    <h5>Всего статей:  </h5>

    <a href="admin.php?action=newArticle">Добавить статью</a>
</section>
