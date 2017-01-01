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
            $this->pubdate = $data['pubdate'];
        if (isset($data['title']))
            $this->title = $data['title'];
        if (isset($data['subtitle']))
            $this->subtitle = $data['subtitle'];
        if (isset($data['description']))
            $this->description = $data['description'];
        if (isset($data['content']))
            $this->content = $data['content'];
        if (isset($data['imgLinks']))
            $this->imgLink = $data['imgLinks'];
    }

    public static function insert()
    {
        global $dbPdo;

        $dbPdo->query("INSERT INTO articles(id) VALUES (NULL)");
        return $dbPdo->lastInsertId();
    }
    
    public static function delete($id)
    {
        global $dbPdo;

        $stm = $dbPdo->prepare("SELECT link FROM img WHERE id_article = :id");
        $stm->execute(array('id'=>$id));
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
            unlink($row['link']);
        }
        /*
         * Если таблицы не InnoDB  и не поддерживают каскада удаления, то удаляем картинки отдельным запросом:
         * */
        $stm = $dbPdo->prepare("DELETE FROM img WHERE id_article = :id");
        $stm->execute(array('id'=>$id));

        $stm = $dbPdo->prepare("DELETE FROM articles WHERE id = :id LIMIT 1");
        $stm->execute(array('id'=>$id));
    }

    public static function deleteImg($id, $tooltip)
    {
        global $dbPdo;

        $stm = $dbPdo->prepare("DELETE FROM img WHERE id_article = :id AND tooltip = :tooltip LIMIT 1");
        $stm->bindParam(':id', $id);
        $stm->bindParam(':tooltip', $tooltip);
        if ( ! $stm->execute()){
            error_log('Ошибка при удалении картинки \n', 3, 'my_errors.log');
            return 'Ошибка при удалении картинки';
        } return true;

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
        /*Достаем данные по последним статьям*/
        $sql = "SELECT * FROM articles ORDER BY pubdate DESC LIMIT $limit";
        $reply = $dbPdo->query($sql);

        while ($row = $reply->fetch(PDO::FETCH_ASSOC)) {
            /*Для каждой статьи достаем соответствующую титульную картинку.. */
            $sql = "SELECT tooltip, link FROM img WHERE id_article =" . $row['id'] . " AND tooltip='face'";
            $reply_img = $dbPdo->query($sql);
            $img = $reply_img->fetch(PDO::FETCH_ASSOC);
            $row[$img['tooltip']] = $img['link'];
            /*.. и добавляем ее в массив данных статьи*/
            $articles[] = $row;
        }

        return $articles;
    }

    public static function findAjaxContent($data)
    {
        global $dbPdo;
        $string = '% ' .$data. ' %';

        $sql = "SELECT id, title, content FROM articles WHERE content LIKE :string LIMIT 10";
        $stm = $dbPdo->prepare($sql);
        $stm->bindParam(':string', $string);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
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

        $this->updateImg();
    }

    public function updateImg()
    {
        global $dbPdo;

        foreach ($_FILES as $name => $arr) {
            if ( ! $_FILES[$name]['name'])
                continue;

            if ($name != 'face' and $name != 'first' and $name != 'second')
                throw new Exception('Ошибка имени передаваемого поля INPUT с типом file');

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

            if ( ! $type)
                throw new Exception('Недопустимый тип загружаемого файла. Картинка не добавлена. 
                                    допустимые типы файлов: gif, jpg, png');

            /*
             * Записываем новую картинку в файл...
             */
            $link = IMG_PATH . 'id' . $this->id . '_' . $name . $type;
            move_uploaded_file($_FILES[$name]['tmp_name'], $link);

            /*
             * ..и проверяем, была ли уже у модели картинка для этого имени tooltip - если есть,
             * то изменяем, если нет - добавляем запись
             */
            if (isset($this->imgLink[$name])) {
               $dbPdo->query("UPDATE img SET link=" .$link. " WHERE link=" .$this->imgLink[$name]);
            }else{
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