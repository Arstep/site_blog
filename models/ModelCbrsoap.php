<?php


class Model_Cbrsoap
{
    protected $client;
    public $lastDateCbr;

    public function __construct($wdsl)
    {
        $this->client = new SoapClient($wdsl);
        $this->lastDateCbr = $this->getDateCbr();
    }

    /*
     * Запрашиваем время последних котировок с сайта ЦБ РФ.
     * Из всей строки времени обрезаем цифры относящиеся к дате.
     * Создаем объект времени из цифр по подставляемому шаблону.
     * Возвращаем объект.
     * */
    public function getDateCbr()
    {
        $objDate = $this->client->GetLatestDateTime();
        $substr = substr($objDate->GetLatestDateTimeResult, 0, 10);
        return DateTime::createFromFormat('Y-m-d', $substr);
    }
    
    public function getCurses()
    {
        $params['On_date'] = $this->lastDateCbr->format('Y-m-d');

        try {
            $curses = $this->client->GetCursOnDate($params);
        } catch (Exception $e) {
            //var_dump($e);
        }
        // Ищем XML-строку значений и преобразуем её в объект
        try {
            $sxml = simplexml_load_string($curses->GetCursOnDateResult->any);
        } catch (Exception $e) {
            echo  'Не удалось создать объект XML функцией simplexml_load_string. ' . $e->getCode();
        }

        foreach ($sxml->ValuteData->ValuteCursOnDate as $obj){
            $item['code'] = $obj->VchCode;
            $item['name'] = $obj->Vname;
            $item['curs'] = $obj->Vcurs;

            $cursesArr[] = $item;
        }

        return $cursesArr;
    }

}