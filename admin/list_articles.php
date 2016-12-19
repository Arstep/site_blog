


<?php //if ( isset( $results['errorMessage'] ) ) { ?>
<!--    <div class="errorMessage">--><?php //echo $results['errorMessage'] ?><!--</div>-->
<?php //} ?>
<!---->
<!---->
<?php //if ( isset( $results['statusMessage'] ) ) { ?>
<!--    <div class="statusMessage">--><?php //echo $results['statusMessage'] ?><!--</div>-->
<?php //} ?>

<section>
    <h1>Администрирование сайта</h1>
    <h5>Вы вошли как </h5>
    <h2>Все статьи</h2>
    <table>
        <tr>
            <th>Дата публикации</th>
            <th>Название</th>
            <th>Сноска</th>
        </tr>

        <?php foreach ($this->listArticles as $article => $instance) { ?>

            <tr onclick="location='admin.php?action=editArticle&id=<?php echo $instance['id']?>'">
                <td><?php echo $instance['pubdate']?></td>
                <td>
                    <?php echo $instance['title']?>
                </td>
                <td>
                    <?php echo $instance['subtitle']?>
                </td>
            </tr>

        <?php } ?>

    </table>

    <h5>Всего статей:  </h5>

    <a href="admin.php?action=newArticle">Добавить статью</a>
</section>
