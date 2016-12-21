<?php
/*
 * Класс для отображения контента на любых страницах
 */

class Controller_Use
{
    public $model;          // объект конкретной статьи
    public $listArticles;   //@param array - массив своих статей в меню на главной странице
    public $links;          //@param array - массив ссылок на внешние статьи в меню на главной странице

    public function getArticle()
    {
        $id_article = (int)$_GET['id'];

        $this->model = Model_Article::getArticleById($id_article);

        include_once 'views/templates/header.php';
        include_once 'views/article.php';
        include_once 'views/templates/footer.php';
    }

    public function contact()
    {
        include_once 'views/templates/header.php';
        include_once 'views/contact.php';
        include_once 'views/templates/footer.php';
    }

    public function homepage()
    {
        $this->listArticles = Model_Article::getListArticles();
        include_once 'views/templates/header.php';
        include_once 'views/homepage.php';
        include_once 'views/templates/footer.php';
    }
}