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
                $result = 'Письмо было отправлено';
                $mail->send();
            }
        }

        include_once VIEWS_SITE . 'templates/header.php';
        include_once VIEWS_SITE . 'contact.php';
        include_once VIEWS_SITE . 'templates/footer.php';
    }

    public function search()
    {
        include_once VIEWS_SITE . 'templates/header.php';
        include_once VIEWS_SITE . 'search.php';
        include_once VIEWS_SITE . 'templates/footer.php';
    }

    public function findAjax()
    {
        // Санируем данные из ajax-а, т.к. будем вставлять этот фрагмент в ответ клиенту
        if ( isset($_POST['data'])){
            $mask = htmlentities($_POST['data']);
            /*
             * Получаем двумерный массив статей где встречается фрагмент.
             * Каждый подмассив - это массив из полей id, title, content одной статьи
             * */
            $result = Model_Article::findAjaxContent($mask);

            if (empty($result)) {
                echo 'Ничего не найдено';
                return;
            }
            /*
             * Приводим поисковый запрос $mask и $content статьи в нижний регистр,
             * иначе получается регистрозависимый поиск.
             * */
            $target = mb_convert_case($mask, MB_CASE_LOWER, "UTF-8");
            // Перебираем все статьи, в которой были совпадения
            $all_strings = array();
            foreach ($result as $article){
                $content = strip_tags($article['content']);
                $content = mb_convert_case($content, MB_CASE_LOWER, "UTF-8");

                // В каждой статье перебираем все места совпадений и формируем фрагменты, содержащие совпадения
                $strings = array();
                $start = 0;
                while ($pos = mb_strpos($content, $target, $start)){
                    $start = $pos + 1;
                    if ($pos <= 100)
                        $pos = 0;
                    else $pos -= 100;
                    $string = mb_substr($content, $pos, mb_strlen($target) + 200);
                    $string = str_replace($target, "<i>$mask</i>", $string);
                // Собираем массив фрагментов, содержащих совпадения в пределах статьи
                    $strings[] = $string;
                }
                // Собираем массив массивов фрагментов для всех статей (если их несколько)
                $all_strings[] = $strings;
            }

            include_once VIEWS_SITE . 'showajax.php';
        }
    }

    public function homepage()
    {
        $this->listArticles = Model_Article::getListArticles();
        
        include_once VIEWS_SITE . 'templates/header.php';
        include_once VIEWS_SITE . 'homepage.php';
        include_once VIEWS_SITE . 'templates/footer.php';
    }
}