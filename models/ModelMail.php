<?php

class Model_Mail
{
    const E_ADRESS = 'adress@mail.ru';
    const E_THEMA = '\n\nИскренне ваш: ';

    private $name;
    private $email;
    private $message;
    private $result = '';


    public function __construct(Array $post)
    {
        $this->name = $post['name'];
        $this->email = $post['email'];
        $this->message = $post['message'];
        $this->result = '';
    }

    public function validate()
    {
        $this->result .= ($this->name == '') ? "<li>Не введено имя. </li>" : '';

        if ($this->email == '')
            $this->result .= "<li>Не введен адрес электронной почты</li>";
        elseif (strpos($this->email, '.') <= 0 ||
                strpos($this->email, '@') <= 0 ||
                preg_match('/[^a-zA-Z0-9.@_-]/', $this->email))
            $this->result .= "<li>Электронный адрес имеет неверный формат. </li>";

        $this->result .= ($this->message == '') ? "<li>Не введен текст сообщения. </li>" : '';
        
        return $this->result;
    }

    public function send()
    {
        mail(self::E_ADRESS, self::E_THEMA, $this->email);
    }
}