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

    <a href="admin.php?action=newArticle">Добавить статью</a>
</section>
