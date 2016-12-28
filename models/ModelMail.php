<?php

class Model_Mail
{
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
        $message = wordwrap($this->message, 70, "\r\n");
        $message .= "\r\n\r\n" . $this->name . "\r\n" . $this->email;

        //$headers = "Content-Type:text/plain; charset=\"utf-8\"\n";

        mail(E_ADRESS_ADMIN, E_THEMA_MESSAGE, $message);
    }
}