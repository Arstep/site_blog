$(document).ready(function(){
    parallax(3);
    sliderRun(2000,1000,5000);
    scrollEff();
});




/*Параллакс картинки бэкграунда
* Чем меньше аргумент speed, тем больше скорость перемещения*/
function parallax(speed) {
    /*Позиция верхнего угла блока с бэкграундом*/
    var blockPositY = $('#third').offset().top;
    /*Высота окна браузера*/
    var windowHeight = $(window).height();

    /*При скроллинге*/
    $(window).scroll(function ()
        {
            var scrollY = $(window).scrollTop();
            /*Определяем положение нижней границы экрана с учетом скроллинга:*/
            var scrollBottom = scrollY + windowHeight;
            /*Как только начинает показываться блок с бэкграундом, начинаем менять его позицию*/
            if (scrollBottom > blockPositY){
                var offsetBG = (scrollBottom - blockPositY) / speed;
                $('#third').css({backgroundPosition: '50% -' + offsetBG + 'px'})
            }
        }
    )
}


/*Слайдер*/
function sliderRun(a, b, c) {
    /*Скорость основной анимации*/
    var SPEED = a;
    /*Скорость постэффекта*/
    var AFTER_SPEED = b;
    /*Задержка перед сменой кадра*/
    var DELAY = c;
    var container = $('#sliderBack');

    stepOne();

    function stepOne() {
        container.append($('#sliderBack > img').first());

        $('#sliderBack > img').last()
            .css({
                'opacity': '0',
                'width': '1920px'
            })
            .delay(DELAY)
            .animate({
                opacity:'1'
            },SPEED,stepTwo)
    }

    function stepTwo() {
        container.append($('#sliderBack > img').first());

        $('#sliderBack > img').last()
            .css({
                'opacity': '0',
                'width': '0'
            })
            .delay(DELAY)
            .animate({
                width:'1920px',
                opacity:'0.9'
            },SPEED)
            .animate({opacity:'1'},AFTER_SPEED,stepThree)
    }

    function stepThree() {
        container.append($('#sliderBack > img').first());

        $('#sliderBack > img').last()
            .css({
                'opacity': '0.5',
                'width': '1920px',
                'bottom': '-650px'
            })
            .delay(DELAY)
            .animate({
                bottom:'0',
                opacity:'0.9'
            },SPEED)
            .animate({opacity:'1'},AFTER_SPEED,stepOne)
    }
}

/*Сборка различных списков при движении экрана вниз*/
function scrollEff()
{
    /*Если экран имеет слишком высокое разрешение или перезагрузили страницу в середине экрана,
    * то показываем списки сразу при загрузке*/
    if (($(document).width() > 2400) || ($(window).scrollTop() > 1000))
    {
        $('#category > a').animate({left:'0'},800);
        $('.note').animate({top: '0'},600);
    } else {
        /*Если все стандартно, то собираем списки при скроллинге*/
        $(window).scroll(function ()
        {
            if ( $(window).scrollTop() > 800 )
            {
                $('#category > a').animate({left:'0'},800);
            }

            if( $(window).scrollTop() > 1200) $('.note').eq(0).animate({top: ''},600);
            if( $(window).scrollTop() > 1400) $('.note').eq(1).animate({top: ''},600);
            if( $(window).scrollTop() > 1600) $('.note').eq(2).animate({top: ''},600);
        });
    }
}
