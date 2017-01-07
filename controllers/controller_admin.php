<?php

class Controller_Admin
{
    public $model;          // объект конкретной статьи
    public $listArticles;   //@param array - массив своих статей в меню на главной странице
    public $adminName;

    public function __construct()
    {
        session_start();

        $this->adminName = isset($_SESSION['adminName']) ? $_SESSION['adminName'] : false;
        if ( ! $this->adminName){
            $this->login();
            exit();
        }
    }

    public function listArticles($limit = 1000)
    {
        // Берем экземпляр роутера и используем из него $_params
        $router = Router::getInstance();
        if (isset($router->getParams()['status']))
            $status = $router->getParams()['status'];
        
        $this->listArticles = Model_Article::getListArticles($limit);
        include_once VIEWS_ADMIN . 'templates' .DS. 'header.php';
        include_once VIEWS_ADMIN . 'list_articles.php';
    }

    public function editArticle()
    {

        if (isset($_POST['saveChanges'])) {

            // Админ уже заполнил форму редактирования статьи: сохраняем изменения
            try {
                $article = new Model_Article($_POST);
                $article->update();
                header("Location: /admin/listArticles/status/saved");
            }catch (Exception $e){
                header("Location: /admin/listArticles/status/error");
            }

        } elseif (isset($_POST{'cancel'})) {

            // Админ отказался от результатов редактирования: возвращаемся к списку статей
            if (empty($_POST['title']) AND empty($_POST['description']) AND empty($_POST['content']))
            Model_Article::delete($_POST['id']);
            header("Location: /admin/listArticles");

        } else {

            // Админ еще не получил форму редактирования: выводим форму

            // Берем экземпляр роутера и используем из него $_params
            $router = Router::getInstance();
            
            $article = Model_Article::getArticleById((int)$router->getParams()['id']);
            include_once VIEWS_ADMIN . 'templates' .DS. 'header.php';
            include_once VIEWS_ADMIN . 'edit_article.php';
        }
    }

    /**
     * Добавление статьи путем образования пустой записи в базе и редактирование ее имеющимся методом editArticle().
     * Если редактирование отменили, для того, чтобы не плодить пустые записи - удаляем болванку из базы.
     */
    public function newArticle()
    {
        $id = Model_Article::insert();
        header('location: /admin/editArticle/id/' .$id);
    }

    public function deleteArticle()
    {
        // Берем экземпляр роутера и используем из него $_params
        $router = Router::getInstance();

        Model_Article::delete((int)$router->getParams()['id']);

        header("Location: /admin/listArticles/status/deleted");
    }

    public function deleteImg()
    {
        // Берем экземпляр роутера и используем из него $_params
        $router = Router::getInstance();

        if (isset($router->getParams()['id']) AND isset($router->getParams()['tooltip']))
            Model_Article::deleteImg((int)$router->getParams()['id'], $router->getParams()['tooltip']);
        
        header("Location: /admin/editArticle/id/" . $router->getParams()['id']);
    }

    public function login()
    {
        if (isset($_POST['name']) AND isset($_POST['password'])){
            if ($_POST['name'] == ADMIN_NAME AND $_POST['password'] == ADMIN_PASSWORD) {
                $_SESSION['adminName'] = ADMIN_NAME;
                header("Location: " . $_SERVER['REQUEST_URI']);
            }
            else{
                $result['error'] = 'Неверное имя пользователя или пароль';
                include_once VIEWS_ADMIN . 'loginForm.php';
            }
        } else{
            include_once VIEWS_ADMIN . 'loginForm.php';
        }
    }

    public function logout()
    {
        unset($_SESSION['adminName']);
        session_destroy();
        header("Location: /");
    }
}
