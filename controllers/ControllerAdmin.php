<?php
class Controller_Admin
{
    public $model;          // объект конкретной статьи
    public $listArticles;   //@param array - массив своих статей в меню на главной странице
    public $links;          //@param array - массив ссылок на внешние статьи в меню на главной странице

    public function __construct()
    {

    }

    public function listArticles($limit)
    {
        $this->listArticles = Model_Article::getListArticles($limit);
        include_once 'admin/templates/header.php';
        include_once 'admin/list_articles.php';
    }
}