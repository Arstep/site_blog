<?php

class Controller_Admin
{
    public $model;          // объект конкретной статьи
    public $listArticles;   //@param array - массив своих статей в меню на главной странице

    public function listArticles($limit)
    {
        $this->listArticles = Model_Article::getListArticles($limit);
        include_once 'admin/templates/header.php';
        include_once 'admin/list_articles.php';
    }

    public function editArticle()
    {
//        $data = array();

        if (isset($_POST['saveChanges'])) {

            // Админ уже заполнил форму редактирования статьи: сохраняем изменения
            try {
                $article = new Model_Article($_POST);
                $article->update();
                header("Location: " .$_SERVER['HTTP_REFERER']. "&status=saved");
            }catch (Exception $e){
                header("Location: " .$_SERVER['HTTP_REFERER']. "&status=error");
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

    /**
     * Добавление статьи путем образования пустой записи в базе и редактирование ее имеющимся методом editArticle().
     * Если редактирование отменили, для того, чтобы не плодить пустые записи - удаляем болванку из базы.
     */
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

    public function deleteImg()
    {
        if (isset($_GET['id']) AND $_GET['tooltip'])
            $reply = Model_Article::deleteImg((int)$_GET['id'], $_GET['tooltip']);
        if ($reply === true)
            header("Location: " .$_SERVER['HTTP_REFERER']);
        else echo $reply;
    }

    public function login()
    {
        if (isset($_POST['name']) AND isset($_POST['password'])){
            if ($_POST['name'] == ADMIN_NAME AND $_POST['password'] == ADMIN_PASSWORD) {
                $_SESSION['adminName'] = ADMIN_NAME;
                header("Location: " . $_SERVER['PHP_SELF']);
            }
            else{
                $result['error'] = 'Неверное имя пользователя или пароль';
                include_once 'admin/loginForm.php';
            }
        } else{
            include_once 'admin/loginForm.php';
        }
    }

    public function logout()
    {
        unset($_SESSION['adminName']);
        session_destroy();
        header("Location: " .$_SERVER['PHP_SELF']);
    }
}
