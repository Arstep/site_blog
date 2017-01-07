<?php


class Controller_Index
{
    public $model;          // объект конкретной статьи
    public $listArticles;   //@param array - массив своих статей в меню на главной странице

    public function article()
    {
        // Метка для меню навигации в header.php
        $navMark = 'homepage';

        $router = Router::getInstance();
        $id_article = (int)$router->getParams()['id'];

        $this->model = Model_Article::getArticleById($id_article);

        include_once VIEWS_INDEX . 'templates' .DS. 'header.php';
        include_once VIEWS_INDEX . 'article.php';
        include_once VIEWS_INDEX . 'templates' .DS. 'footer.php';
    }

    public function resourses()
    {
        $navMark = 'resourses';

        $cbrSoap = new Model_Cbrsoap(SOAP_WDSL_CBR);
        $cursesArr = $cbrSoap->getCurses();

        include_once VIEWS_INDEX . 'templates' .DS. 'header.php';
        include_once VIEWS_INDEX . 'resourses.php';
        include_once VIEWS_INDEX . 'templates' .DS. 'footer.php';
    }

    public function contact()
    {
        $navMark = 'contact';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mail = new Model_Mail($_POST);
            $result = $mail->validate();

            if ($result == '') {
                $result = 'Письмо было отправлено';
                $mail->send();
            }
        }

        include_once VIEWS_INDEX . 'templates' .DS. 'header.php';
        include_once VIEWS_INDEX . 'contact.php';
        include_once VIEWS_INDEX . 'templates' .DS. 'footer.php';
    }

    // Страница поиска
    public function search()
    {
        $navMark = 'search';

        include_once VIEWS_INDEX . 'templates' .DS. 'header.php';
        include_once VIEWS_INDEX . 'search.php';
        include_once VIEWS_INDEX . 'templates' .DS. 'footer.php';
    }

    // Поиск по словам в статьях всего сайта
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
                    // Добаляем пробелы перед заменяемым словом, чтобы искать только целые слова, а не части других слов
                    $string = str_replace(' ' .$target. ' ', "<i> $mask </i>", $string);
                // Собираем массив фрагментов, содержащих совпадения в пределах статьи
                    $strings[] = $string;
                }
                // Собираем массив массивов фрагментов для всех статей (если их несколько)
                $all_strings[] = $strings;
            }

            include_once VIEWS_INDEX . 'showajax.php';
        }
    }

    public function index()
    {
        $navMark = 'homepage';

        $this->listArticles = Model_Article::getListArticles();
        
        include_once VIEWS_INDEX . 'templates' .DS. 'header.php';
        include_once VIEWS_INDEX . 'index.php';
        include_once VIEWS_INDEX . 'templates' .DS. 'footer.php';
    }
}