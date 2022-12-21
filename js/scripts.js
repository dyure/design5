jQuery(function ($) {
    "use strict";
// Custom jQuery Code Here
    
    var boxes;
    //Distance Formula
    function distMetric(x,y,x2,y2) {
        var xDiff = x - x2;
        var yDiff = y - y2;
        return (xDiff * xDiff) + (yDiff * yDiff);
    }
    //Detect Closest Edge
    function closestEdge(x,y,w,h) {
        var topEdgeDist = distMetric(x,y,w/2,0);
        var bottomEdgeDist = distMetric(x,y,w/2,h);
        var leftEdgeDist = distMetric(x,y,0,h/2);
        var rightEdgeDist = distMetric(x,y,w,h/2);
        var min = Math.min(topEdgeDist,bottomEdgeDist,leftEdgeDist,rightEdgeDist);
        switch (min) {
            case leftEdgeDist:
                return "left";
            case rightEdgeDist:
                return "right";
            case topEdgeDist:
                return "top";
            case bottomEdgeDist:
                return "bottom";
        }
    }

    //to add .out and .in classes when you are scrolling up and remove them if you are don't in during 2 sec
    var header = $('.header'), scrollPrev = 0;
    $(window).scroll(function(){
        if (!$('.header__burger').hasClass('active')) {
            var scrolled = $(window).scrollTop();
            if (scrolled > 0 && scrolled > scrollPrev) {
                header.addClass('out');
            } else {
                header.addClass('in');
                setTimeout(() => header.removeClass('out'), 500);
            }
            scrollPrev = scrolled;
            clearTimeout($.data(this, 'scrollTimer'));
            // the code below opens header through 2 sec
            $.data(this, 'scrollTimer', setTimeout(function(){
                /*header.removeClass('out');*/
                if (scrolled == 0) header.removeClass('in');
            }, 2000));
        }
    });

    // to add .new_bottom class when you are scrolling down and reach nessesary position
    $(window).scroll(function(){
        var footer_offset = $('.footer').offset().top;
        var scrolled = $(window).scrollTop();
        var diff = footer_offset - scrolled;
        var my_works_width_input = document.documentElement.clientWidth;
        if (my_works_width_input >= 1300) {
            if (diff < 600) {
                $('.order_button').addClass('new_bottom');
            } else {
                $('.order_button').removeClass('new_bottom');
            }
        }
    });

    // order button position in case when screen bigger than 1920px
    var my_works_width_input = document.documentElement.clientWidth;
    var new_margin = (my_works_width_input - 1800) / 2;
    if (my_works_width_input > 1920) {
        $('.order_button').css('margin-right',new_margin - 80 + 'px');
    } else {
        $('.order_button').css('margin-right','0');
    }
    
    // order button position in case when screen bigger than 1920px and after resize the window
    $(window).resize(function(){
        var my_works_width_input = document.documentElement.clientWidth;
        var new_margin = (my_works_width_input - 1800) / 2;
        if (my_works_width_input > 1920) {
            $('.order_button').css('margin-right',new_margin - 80 + 'px');
        } else {
            $('.order_button').css('margin-right','0');
        }
    });

    // to open mobile menu
    $('.header__burger,.order_button,#footer__lists_contacts').click (function(event){
        $('.header').removeClass('out');
        var my_works_width_input = document.documentElement.clientWidth;
        var new_margin = (my_works_width_input - 1920) / 2;
        if (my_works_width_input >= 1300) {
            $('.header__burger,.header__burger_lines,.header__logo_phone,.header__phone,.header__menu,.content,.croped,.items_1,.items_2,.items_3,.items_4,.item_53,.overlay_topics,.overlay_posts,.topic_name,.anonce,.anonce__text,.anonce__add,.anonce__video,.misc_field_1,.want_design,.want_design_body,.want_design_body_title,.want_design_body_form,.input_name,.input_phone,.want_design_form_button,.articles,.footer,.footer__logo,.footer__features_menu_phone,.footer__features,.footer__menu,.footer__phone,.order_button').toggleClass('active');
        } else {
            $('.header__burger,.header__burger_lines,.header__menu').toggleClass('active');
        }
        if (my_works_width_input > 1920) {
            if ($('.content').hasClass('active')) {
                $('.header__burger').css('margin-right',new_margin - 110 + 'px');
                $('.header__menu').css('margin-right',new_margin - 40 + 'px');
                $('.content, .want_design, .footer').css('margin-left',new_margin + 'px');
            } else {
                $('.header__burger,.header__menu').css('margin-right','0');
                $('.content, .want_design, .footer').css('margin-left','0');
            }
        }
    });

    // alternative method to close mobile menu
    $('.content').click(function(e) {
        if ($('.header__menu').hasClass('active')) {
            $('.header__burger,.header__burger_lines,.header__logo_phone,.header__phone,.header__menu,.content,.croped,.items_1,.items_2,.items_3,.items_4,.item_53,.overlay_topics,.overlay_posts,.topic_name,.anonce,.anonce__text,.anonce__add,.anonce__video,.misc_field_1,.want_design,.want_design_body,.want_design_body_title,.want_design_body_form,.input_name,.input_phone,.want_design_form_button,.articles,.footer,.footer__logo,.footer__features_menu_phone,.footer__features,.footer__menu,.footer__phone,.order_button').removeClass('active');
            $('.content, .want_design, .footer').css('margin-left','0');
            $('.header__burger').css('margin-right','0');
        }
    });

    // to work with mobile menu
    $('#menu_order_design').click(function(event){
        $('.header__menu_order').slideUp(500);
        $('.header__menu_order').slideDown(500);
        $('.header__menu_contacts').slideUp(500);
    });

    $('#menu_contacts').click(function(event){
        $('.header__menu_contacts').slideUp(500);
        $('.header__menu_contacts').slideDown(500);
        $('.header__menu_order').slideUp(500);
    });

    // to open form by click on order_button
    /*$('.order_button').click (function(event){
        var target = $('.want_design').offset().top - 40;
        $('.order_button').css('display', 'none');
        $("html, body").animate({scrollTop: target}, 800)
    });*/

    // to open read_more
    $('.read_more').click(function(event){
        $(this).css('display', 'none').parents('.items').find('.anonce_hidden').css('display', 'block');
    });

    // working something with labels and input fields
    $('#fldPhone').inputmask({
        "mask" : "+7 (999) 999-99-99"
    });

    // to send form
    $(".want_design_form_button").on("click", function (event){
        event.preventDefault();
        var name = $('.input_name').val();
        var tel = $('.input_phone').val();
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            data: {
                action: 'ajax_order',
                name: name,
                tel: tel
            },
            success: function (response) {
                $('.popup').html(response);
                $('.popup-fade').css('display', 'flex');
                var red = $('.popup-red').html();
                if (red.includes('!')) {
                    var ex = function(){
                        $('.popup-fade').fadeOut();
                        $('.input_phone').focus();
                    };
                    setTimeout(ex, 2000);
                }
            },
            error: function (response) {
                $('.popup').html(response);
                $('.popup-fade').css('display', 'flex');
            }
        });
    });

    // Клик по кнопке "Закрыть".
    $(document).on('click', '.popup-close', function() {
        $(this).parents('.popup-fade').fadeOut();
        return false;
    });        

    // Закрытие по клавише Esc.
    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.popup-fade').fadeOut();
        }
    });

    // Клик по фону.
    $('.popup-fade').click(function(e) {
        if ($(e.target).closest('.popup').length == 0) {
            $(this).fadeOut();					
        }
    });

    boxes = document.querySelectorAll('.boxes');
    var my_works_width = document.documentElement.clientWidth;
    if (my_works_width > 1024) {
        for(var i = 0; i < boxes.length; i++){
            boxes[i].onmouseenter = function (e){
                var x = e.pageX - this.offsetLeft;
                var y = e.pageY - this.offsetTop;
                var edge = closestEdge(x,y,this.clientWidth, this.clientHeight);
                var overlay = this.childNodes[1];
                switch(edge){
                    case "left":
                        overlay.style.top = "0%";
                        overlay.style.left = "-100%";
                        TweenMax.to(overlay, .3, {left: '0%'});
                    break;
                    case "right":
                        overlay.style.top = "0%";
                        overlay.style.left = "100%";
                        TweenMax.to(overlay, .3, {left: '0%'});
                    break;
                    case "top":
                        overlay.style.top = "-100%";
                        overlay.style.left = "0%";
                        TweenMax.to(overlay, .3, {top: '0%'});
                    break;
                    case "bottom":
                        overlay.style.top = "100%";
                        overlay.style.left = "0%";
                        TweenMax.to(overlay, .3, {top: '0%'});
                    break;
                }
            };
            boxes[i].onmouseleave = function(e){
                var x = e.pageX - this.offsetLeft;
                var y = e.pageY - this.offsetTop;
                var edge = closestEdge(x,y,this.clientWidth, this.clientHeight);
                var overlay = this.childNodes[1];
                switch(edge){
                    case "left":
                        TweenMax.to(overlay, .3, {left: '-100%'});
                    break;
                    case "right":
                        TweenMax.to(overlay, .3, {left: '100%'});
                    break;
                    case "top":
                        TweenMax.to(overlay, .3, {top: '-100%'});
                    break;
                    case "bottom":
                        TweenMax.to(overlay, .3, {top: '100%'});
                    break;
                }
            };
        }
    }

});
