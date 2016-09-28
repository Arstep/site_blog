
$(document).ready(function(){
    parallax();
    sliderRun(2000,1000,5000);
    scrollEff();


});




function parallax() {
    $('section[data-type="parallax"]').each(function(){

        var $bgobj = $(this);

        $(window).scroll(function() {

            var yPos = -( $(window).scrollTop() / $bgobj.data('speed') );

            var coords = '50% '+ (yPos+100) + 'px';

            $bgobj.css({ backgroundPosition: coords });

        });
    });
}


function sliderRun(a, b, c) {
    var SPEED = a;
    var AFTER_SPEED = b;
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
                'left': '1920px'
            })
            .delay(DELAY)
            .animate({
                left:'0',
                opacity:'0.9'
            },SPEED)
            .animate({opacity:'1'},AFTER_SPEED,stepOne)
    }
}


function scrollEff() {
    if (($(document).width() > 1920) || ($(window).scrollTop() > 1000))
    {
        $('#category > a').animate({left:'0'},800);
        $('.note').animate({top: ''},600);
    };

    $(window).scroll(function ()
    {
        if ( $(window).scrollTop() > 800 )
        {
            $('#category > a').animate({left:'0'},800)
        };

        if( $(window).scrollTop() > 1200) $('.note').eq(0).animate({top: ''},600);
        if( $(window).scrollTop() > 1400) $('.note').eq(1).animate({top: ''},600);
        if( $(window).scrollTop() > 1600) $('.note').eq(2).animate({top: ''},600);

        if ( $(window).scrollTop() > 1900) {
            console.log($(window).scrollTop())
            $('#toTop').css({'display':'block'})
        }

        $('#toTop').click(function () {
            $(this).css({'boxShadow': '0 0 100px red'})
                .delay(1000)
                .queue(function () {
                    $(this).css({
                        'boxShadow': 'none',
                        'display':'none'
                    });$(this).dequeue()})
        })
    });
}















