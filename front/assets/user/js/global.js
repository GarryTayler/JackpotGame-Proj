function set_layout() {
    var cH = $(window).height() - $('footer').height() - 160;
    $('div.main_panel').css('min-height' , cH + 'px');
}

$(document).ready(function() {
    $(window).resize(function(w) {
        set_layout();
    });
    set_layout();
});

