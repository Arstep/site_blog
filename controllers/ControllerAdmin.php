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

    public function editArticle()
    {
        $data = array();
        $data['formTitle'] = 'Редактирование статьи';
        $data['formAction'] = 'editArticle';

        if (isset($_POST['saveChanges'])) {

            // Админ уже заполнил форму редактирования статьи: сохраняем изменения
            try {
                $article = new Model_Article($_POST);
                $article->update();
                header("Location: admin.php?status=saved");
            }catch (Exception $e){
//                $e->getMessage();
                header("Location: admin.php?status=error");
            }


        } elseif (isset($_POST{'cancel'})) {

            // Админ отказался от результатов редактирования: возвращаемся к списку статей
            if (empty($_POST['title']) AND empty($_POST['description']) AND empty($_POST['content']))
            Model_Article::delete($_POST['id']);
            header("Location:" . $_SERVER['PHP_SELF']);

        } else {

            // Админ еще не получил форму редактирования: выводим форму
            $article = Model_Article::getArticleById((int)$_GET['id']);
            include_once 'admin/templates/header.php';
            include_once 'admin/edit_article.php';
        }
    }

    public function newArticle()
    {
        $id = Model_Article::insert();
        header('location: ' .$_SERVER['PHP_SELF']. '?action=editArticle&id=' .$id);
    }

    public function deleteArticle()
    {
        Model_Article::delete((int)$_GET['id']);
        header("Location: admin.php?status=deleted");
    }
}
























