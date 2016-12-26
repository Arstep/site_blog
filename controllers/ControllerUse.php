<?php


class Controller_Use
{
    public $model;          // объект конкретной статьи
    public $listArticles;   //@param array - массив своих статей в меню на главной странице

    //public $links;          //@param array - массив ссылок на внешние статьи в меню на главной странице

    public function getArticle()
    {
        $id_article = (int)$_GET['id'];

        $this->model = Model_Article::getArticleById($id_article);

        include_once VIEWS_SITE . 'templates/header.php';
        include_once VIEWS_SITE . 'article.php';
        include_once VIEWS_SITE . 'templates/footer.php';
    }

    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mail = new Model_Mail($_POST);
            $result = $mail->validate();

            if ($result == '') {                
                /*
                 * $mail->send();
                 */
                $result = 'Письмо было отправлено';
            }
        }

        include_once VIEWS_SITE . 'templates/header.php';
        include_once VIEWS_SITE . 'contact.php';
        include_once VIEWS_SITE . 'templates/footer.php';
    }

    public function homepage()
    {
        $this->listArticles = Model_Article::getListArticles();
        include_once VIEWS_SITE . 'templates/header.php';
        include_once VIEWS_SITE . 'homepage.php';
        include_once VIEWS_SITE . 'templates/footer.php';
    }
}