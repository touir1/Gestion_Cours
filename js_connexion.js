/**
 * Created by MohamedAli on 05/03/2016.
 */
$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#li_parametre').click(function(e) {

        $('#main-content').css("display","block");
        if($('#li_overview').hasClass('active')){
            $('#main-content3').css("display","none");
            $('#li_overview').removeClass('active');
            e.preventDefault();
        }
        else if($('#li_article').hasClass('active')){
            $('#main-content2').css("display","none");
            $('#li_article').removeClass('active');
        }
        else if($('#li_relevee_note').hasClass('active')){
            $('#li_relevee_note').removeClass('active');
        }
        else if($('#li_gestioncompte').hasClass('active')){
            $('#main-content4').css("display","none");
            $('#li_gestioncompte').removeClass('active');
        }
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#li_overview').click(function(e) {
        $('#main-content3').css("display","block");
        if($('#li_parametre').hasClass('active')){
            $('#main-content').css("display","none");
            $('#li_parametre').removeClass('active');
        }
        else if($('#li_article').hasClass('active')){
            $('#main-content2').css("display","none");
            $('#li_article').removeClass('active');
        }
        else if($('#li_relevee_note').hasClass('active')){
            $('#li_relevee_note').removeClass('active');
        }
        else if($('#li_gestioncompte').hasClass('active')){
            $('#main-content4').css("display","none");
            $('#li_gestioncompte').removeClass('active');
        }
        $(this).addClass('active');
        e.preventDefault();
    });

    $(document).ready(function(){
        $('[data-toggle=popover]').popover({
            trigger: 'manual',
            html: true,
            title: 'Changer image'
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(this).siblings(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide")
                }
            }, 100);
        });
    });

    $('#li_article').click(function(e) {
        $('#main-content2').css("display","block");
        if($('#li_parametre').hasClass('active')){
            $('#main-content').css("display","none");
            $('#li_parametre').removeClass('active');
        }
        else if($('#li_overview').hasClass('active')){
            $('#main-content3').css("display","none");
            $('#li_overview').removeClass('active');
        }
        else if($('#li_relevee_note').hasClass('active')){
            $('#li_relevee_note').removeClass('active');
        }
        else if($('#li_gestioncompte').hasClass('active')){
            $('#main-content4').css("display","none");
            $('#li_gestioncompte').removeClass('active');
        }
        $(this).addClass('active');
        e.preventDefault();
    });

    $('#li_gestioncompte').click(function(e) {
        $('#main-content4').css("display","block");
        if($('#li_parametre').hasClass('active')){
            $('#main-content').css("display","none");
            $('#li_parametre').removeClass('active');
        }
        else if($('#li_overview').hasClass('active')){
            $('#main-content3').css("display","none");
            $('#li_overview').removeClass('active');
        }
        else if($('#li_relevee_note').hasClass('active')){
            $('#li_relevee_note').removeClass('active');
        }
        else if($('#li_article').hasClass('active')){
            $('#main-content2').css("display","none");
            $('#li_article').removeClass('active');
        }
        $(this).addClass('active');
        e.preventDefault();
    })

});
