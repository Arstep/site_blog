$(document).ready(function(){
    toTop();
});


function toTop()
{
    /*Регистрируем отслеживание появления и пропадания кнопки перемотки экрана ВВЕРХ*/
    $(window).scroll(function ()
    {
        if ( $(window).scrollTop() > 600 && $('#toTop').css('display') == 'none') {
            $('#toTop').css({'display':'block'})
        }
        if ( $(window).scrollTop() <= 500 && $('#toTop').css('display') == 'block') {
            $('#toTop').css({'display':'none'})
        }
    });

    /*Эффекты при нажатии на кнопку ВВЕРХ*/
    $('#toTop').click(function (event)
    {
        event.preventDefault();
        /*html - для Firefox, body - для всех остальных*/
        $("html, body").animate({"scrollTop":0},"slow");
        $(this).css({
                'boxShadow': '0 0 20px black'
            })
            .delay(500)
            .queue(function ()
            {
                $(this).css({
                    'boxShadow': 'none'
                });
                $(this).dequeue()
            })
    })
}
