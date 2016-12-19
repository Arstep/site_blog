<?php

class Model_Article
{
    public $id = null;
    public $date = null;
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
            $this->date = $data['pubdate']; //посмотреть в каком виде будет поступать из админки и выбрать формат и очистку
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

    public static function getArticleById($id_article)
    {
        global $dbPdo;

        $sql = "SELECT * FROM articles WHERE id = :id";
        $stm = $dbPdo->prepare($sql);
        $stm->bindParam(':id', $id_article);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT tooltip, link FROM img WHERE id_article = :id";
        $stm = $dbPdo->prepare($sql);
        $stm->bindParam(':id', $id_article);
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

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            /*Достаем титульную картинку соответствующую текущей статье.. */
            $sql = "SELECT tooltip, link FROM img WHERE id_article =" .$row['id']. " AND tooltip='face'";
            $result_img = $dbPdo->query($sql);
            $img = $result_img->fetch(PDO::FETCH_ASSOC);
            $row[$img['tooltip']] = $img['link'];
            /*.. и добавляем ее в массив данных статьи*/
            $articles[] = $row;
        }

        return $articles;
    }
}