/**
 * Created by Администратор on 16.09.2016.
 */

$(document).ready(function(){

    $('section[data-type="background"]').each(function(){

        var $bgobj = $(this);

        $(window).scroll(function() {

            var yPos = -( $(window).scrollTop() / $bgobj.data('speed') );

            var coords = '50% '+ (yPos+100) + 'px';

            $bgobj.css({ backgroundPosition: coords });

        });

    });

});