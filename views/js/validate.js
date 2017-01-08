
/*Проверка формы обратной связи (почты)*/
function validate(form)
{
    var fail = '';
    fail = validateName(form.name.value);
    fail += validateEmail(form.email.value);
    fail += validateMessage(form.message.value);

    if (fail == "") {
        return true;
    } else {
        $('#message')   .html(fail)
                        .css('color', 'red');
        return false;
    }

    function validateName(field)
    {
        return (field == '') ? "<li>Не введено имя. </li>" : '';
    }

    function validateEmail(field) {
        if (field == '') return "<li>Не введен адрес электронной почты. </li>";
        else if ((field.indexOf('.') <= 0) || (field.indexOf('@') <= 0) || /[^a-zA-Z0-9.@_-]/.test(field))
            return "<li>Электронный адрес имеет неверный формат. </li>";
        return ''
    }

    function validateMessage(field) {
        return (field == '') ? "<li>Не введен текст сообщения. </li>" : '';
    }
}

