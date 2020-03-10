function update_wallet() {
    $.ajax({
        url: site_url + 'User/my_wallet',
        dataType: 'json',
        method: 'post',
        success: function(resp) {
            if (resp.status) {
                $('#profile_balance').html(resp.wallet);
            }
        }
    })
}
function set_layout() {
    const is_mobile = ($(window).width() <= 756);
    if (is_mobile) {
        var rH = $(window).height() - 110 - $('.row_heading_v1').outerHeight(true) - 3.2 - 15  - $('.msg-input').outerHeight(true);
        // $('#chatlog1').height(rH);
        $('#main-container').css('min-height' ,  ($(window).height() - 110) + 'px');
        $('#main-container').css('max-height' ,  '');
        $('#my-panel').css('height', '');
        $('.chat-panel').css('margin-top' , '70px');
        $('footer').css('left', 0);
        $("#main-container").css('margin-bottom', '200px');
        // $('.chat-panel').css('max-height' , ($(window).height() - 110) + 'px');
    } else {
        var main_height = $("#main-container")[0].clientHeight;
        rH = main_height - $('.row_heading_v1').outerHeight(true) - 3.2 - 15  - $('.msg-input').outerHeight(true);
        // $('#chatlog1').height(rH);
        // $('#main-container').css('max-height' ,  ($(window).height() - 110) + 'px');
        $('#main-container').css('min-height' ,  '');
        // check for jackpot
        $('#my-panel').css('height', ($(window).height() - 270) + 'px');
        $('.chat-panel').css('margin-top' , ($(window).scrollTop()) + 'px');
        // $('.chat-panel').css('height', main_height + 'px');
	}
	$('footer').width($('#main-container')[0].clientWidth);
    // for jackpot --> by Elvis 2019-05-29
    if ($("#main-container").width() <= 940) {
        $('body').addClass('chat-panel-open');
        $copen = $("div.copen");
        $copen.fadeIn();
        $copen.addClass("rollIn animated").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        });
	}
	else {
		$copen = $("div.copen");
		$copen.fadeOut();
	}
}


$(document).ready(function() {
    setTimeout(function () {
        set_layout();
    }, 1000);
    $(window).resize(function(w) {
        set_layout();
    });

    $(window).scroll(function (e) {
        const is_mobile = ($(window).width() <= 756);
        if (is_mobile) {
            $('.chat-panel').css('margin-top' , '70px');
        } else {
            $('.chat-panel').css('margin-top' , ($(window).scrollTop()) + 'px');
        }

    });

    $("a.bar-close").click(function() {
        var min_width = 893;
        if ($("#main-container").width() > min_width) {
            $chatPanel = $(".chat-panel");
            $copen = $("div.copen");
            $main_container = $("#main-container");
            width = $chatPanel.width();
            $chatPanel.css("transform" , " translateX( calc(-100% - 30px) )");
            $copen.fadeIn();
            $copen.addClass("rollIn animated").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            });
            $main_container.css('margin-left' , (-width) + "px");
            $main_container.css('width' , "100%");
        } else {
            $('body').addClass('chat-panel-open');
            $copen = $("div.copen");
            $copen.fadeIn();
            $copen.addClass("rollIn animated").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            });
        }

    });
    $("div.copen").click(function() {
        var min_width = 893;
        if ($("#main-container").width() > min_width) {
            $chatPanel = $(".chat-panel");
            $copen = $("div.copen");
            $main_container = $("#main-container");
            $copen.fadeOut();
            width = $chatPanel.width();
            $chatPanel.css("transform" , "");
            $main_container.css('margin-left' , "0px");
            $main_container.css('width' , "78%");
        } else {
            $('body').removeClass('chat-panel-open');
            $copen = $("div.copen");
            $copen.fadeOut();
        }
    });
});
