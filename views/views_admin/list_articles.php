<?php if (isset($status) && $status == 'error')
    echo '<h3 class="error">При сохранении статьи возникли ошибки</h3>'; ?>
<?php if (isset($status) && $status == 'saved')
    echo '<h3 class="saved">Изменения сохранены</h3>'; ?>
<?php if (isset($status) && $status == 'deleted')
    echo '<h3 class="saved">Статья была удалена</h3>'; ?>


<h2>Все статьи</h2>
    <table>
        <tr>
            <th>Дата публикации</th>
            <th>Название</th>
            <th>Сноска</th>
        </tr>

        <?php foreach ($this->listArticles as $num => $article) { ?>

            <tr onclick="location='/admin/editArticle/id/<?php echo $article['id']?>'">
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

    <a href="/admin/newArticle">Добавить статью</a>
</section>
