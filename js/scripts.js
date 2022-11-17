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

    //to add .out and .in classes when you are scrolling up and remove them if you are don't in during 5 sec
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
            /*$.data(this, 'scrollTimer', setTimeout(function(){
                header.removeClass('out');
                header.removeClass('in');
            }, 5000));*/
        }
    });

    // to add .new_bottom class when you are scrolling down and reach nessesary position
    $(window).scroll(function(){
        var footer_offset = $('.footer').offset().top;
        var scrolled = $(window).scrollTop();
        var diff = footer_offset - scrolled;
        var my_works_width_input = document.documentElement.clientWidth;
        if (my_works_width_input >= 1300) {
            if (diff < 500) {
                $('.order_button').addClass('new_bottom');
            } else {
                $('.order_button').removeClass('new_bottom');
            }
        }
    });

    // to open mobile menu
    $('.header__burger,.order_button,#footer__lists_contacts').click (function(event){
        $('.header').removeClass('out');
        var my_works_width_input = document.documentElement.clientWidth;
        if (my_works_width_input >= 1300) {
            $('.header__burger,.header__burger_lines,.header__logo_phone,.header__phone,.header__menu,.content,.croped,.items_1,.items_2,.items_3,.items_4,.item_53,.overlay_topics,.overlay_posts,.topic_name,.anonce,.anonce__text,.anonce__add,.anonce__video,.misc_field_1,.want_design,.want_design_body,.want_design_body_title,.want_design_body_form,.input_name,.input_phone,.want_design_form_button,.articles,.footer,.footer__logo,.footer__features_menu_phone,.footer__features,.footer__menu,.footer__phone,.order_button').toggleClass('active');
            $('.item_22 > .overlay_posts h3').html($('.item_22 > .overlay_posts h3').html().substring(0, 48));
            $('.item_32 > .overlay_posts h3').html($('.item_32 > .overlay_posts h3').html().substring(0, 48));
            $('.item_42 > .overlay_posts h3').html($('.item_42 > .overlay_posts h3').html().substring(0, 48));
            $('.item_52 > .overlay_posts h3').html($('.item_52 > .overlay_posts h3').html().substring(0, 48));
        } else {
            $('.header__burger,.header__burger_lines,.header__menu').toggleClass('active');
        }
    });

    // alternative method to close mobile menu
    $('.content').click(function(e) {
        if ($('.header__menu').hasClass('active')) $('.header__burger,.header__burger_lines,.header__logo_phone,.header__phone,.header__menu,.content,.croped,.items_1,.items_2,.items_3,.items_4,.item_53,.overlay_topics,.overlay_posts,.topic_name,.anonce,.anonce__text,.anonce__add,.anonce__video,.misc_field_1,.want_design,.want_design_body,.want_design_body_title,.want_design_body_form,.input_name,.input_phone,.want_design_form_button,.articles,.footer,.footer__logo,.footer__features_menu_phone,.footer__features,.footer__menu,.footer__phone,.order_button').removeClass('active');
    });

    // to work with mobile menu
    $('#menu_order_design').click (function(event){
        $('.header__menu_order').addClass('active');
        if ($('.header__menu_contacts').hasClass('active')) $('.header__menu_contacts').removeClass('active');
    });

    $('#menu_contacts').click (function(event){
        $('.header__menu_contacts').addClass('active');
        if ($('.header__menu_order').hasClass('active')) $('.header__menu_order').removeClass('active');
    });

    // to open form by click on order_button
    /*$('.order_button').click (function(event){
        var target = $('.want_design').offset().top - 40;
        $('.order_button').css('display', 'none');
        $("html, body").animate({scrollTop: target}, 800);
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

    // загрузка постов
    /*$('#true_loadmore').click(function(){
        $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
        var data = {
            'action': 'loadmore',
            'query': true_posts,
            'page' : current_page
        };
        $.ajax({
            url:ajaxurl, // обработчик
            data:data, // данные
            type:'POST', // тип запроса
            success:function(data){
                if(data) { 
                    $('#true_loadmore').text('Ещё').before(data); // вставляем новые посты
                    current_page++; // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
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
                } else {
                    $('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
                
            }
        });
    });*/

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
