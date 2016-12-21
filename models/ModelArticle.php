<?php

class Model_Article
{
    public $id = null;
    public $pubdate = null;
    public $title = null;
    public $subtitle = null;
    public $description = null;
    public $content = null;
    public $imgLink = null; //@массив картинок, на позиции ['face'] - картинка background к меню на главную страницу

    public function __construct($data = array())
    {
        if (isset($data['id']))
            $this->id = (int)$data['id'];
        if (isset($data['pubdate']))
            $this->pubdate = $data['pubdate']; //посмотреть в каком виде будет поступать из админки и выбрать формат и очистку
        if (isset($data['title']))
            $this->title = htmlentities($data['title']);
        if (isset($data['subtitle']))
            $this->subtitle = htmlentities($data['subtitle']);
        if (isset($data['description']))
            $this->description = htmlentities($data['description']);
        if (isset($data['content']))
            $this->content = $data['content'];
        if (isset($data['imgLinks']))
            $this->imgLink = $data['imgLinks'];
    }

    public static function insert()
    {
        global $dbPdo;

        $dbPdo->query("INSERT INTO `articles`(`id`) VALUES (NULL)");
        return $dbPdo->lastInsertId();
    }
    
    public static function delete($id)
    {
        
    }

    public static function getArticleById($id)
    {
        global $dbPdo;

        $sql = "SELECT * FROM articles WHERE id = :id";
        $stm = $dbPdo->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT tooltip, link FROM img WHERE id_article = :id";
        $stm = $dbPdo->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        while ($row = $stm->fetch(PDO::FETCH_ASSOC))
            $data['imgLinks'][$row['tooltip']] = $row['link'];

        return new Model_Article($data);
    }

    public static function getListArticles($limit = LOT_ARTICLES)
    {
        global $dbPdo;
        /*Достаем данные по шести последним статьям*/
        $sql = "SELECT * FROM articles ORDER BY pubdate DESC LIMIT $limit";
        $result = $dbPdo->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            /*Достаем титульную картинку соответствующую текущей статье.. */
            $sql = "SELECT tooltip, link FROM img WHERE id_article =" . $row['id'] . " AND tooltip='face'";
            $result_img = $dbPdo->query($sql);
            $img = $result_img->fetch(PDO::FETCH_ASSOC);
            $row[$img['tooltip']] = $img['link'];
            /*.. и добавляем ее в массив данных статьи*/
            $articles[] = $row;
        }

        return $articles;
    }

    public function update()
    {
        global $dbPdo;

        if (is_null($this->id))
            throw new Exception("Model_Article::update(): Попытка обновить статью, у которой нет ID.");

        $sql = "UPDATE articles SET pubdate=:pubdate, title=:title, subtitle=:subtitle, description=:description,
                content=:content WHERE id=:id";
        $stm = $dbPdo->prepare($sql);
        $stm->bindParam(':pubdate', $this->pubdate);
        $stm->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stm->bindParam(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $stm->bindParam(':description', $this->description, PDO::PARAM_STR);
        $stm->bindParam(':content', $this->content, PDO::PARAM_STR);
        $stm->bindParam(':id', $this->id, PDO::PARAM_STR);
        $stm->execute();

        foreach ($_FILES as $name => $arr) {
            if (!$_FILES[$name]['name'])
                continue;
            $name = htmlentities($name);

            if ($name != 'face' and $name != 'first' and $name != 'second')
                throw new Exception('Ошибка имени передаваемого поля INPUT');

            switch ($arr['type']) {
                case 'image/gif':
                    $type = '.gif';
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    $type = '.jpg';
                    break;
                case 'image/png':
                    $type = '.png';
                    break;
                default:
                    $type = false;
            }

            if (!$type)
                throw new Exception('Недопустимый тип загружаемого файла. Картинка не добавлена. 
                                    допустимые типы файлов: gif, jpg, png');

            $link = IMG_PATH . 'id' . $this->id . '_' . $name . $type;
            move_uploaded_file($_FILES[$name]['tmp_name'], $link);

            if (!isset($this->imgLink[$name])) {
                $sql = "INSERT INTO img VALUES (:link, :tooltip, :id_article)";
                $stm = $dbPdo->prepare($sql);
                $stm->bindParam(':link', $link);
                $stm->bindParam(':tooltip', $name);
                $stm->bindParam(':id_article', $this->id);
                $stm->execute();
            }
        }

    }


}