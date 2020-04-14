function showToast (type , message , position = 'top-right') 
{
    heading = '';
    if( type == 'error' )
        heading = 'Error';

    //Check duplication toast
    // jq-toast-single
    var toastObj = $.toast.options;
    if ($('.jq-toast-single').css('display') == 'block' &&
        toastObj.heading == heading &&
        toastObj.icon == type &&
        toastObj.text == message &&
        toastObj.position == position) {
        return;
    }
    $.toast.options = {
        heading: heading,
        text: message,
        showHideTransition: 'fade',
        position: position,
        icon: type,
        allowToastClose: true,
        hideAfter: 3000,
        loader: true,
        loaderBg: '#9EC600',
        stack: 5,
    };
    $.toast();
}

function run_waitMe(el, num, effect)
{
    text = 'Please wait...'; fontSize = '';
    switch (num) {
        case 1:
            maxSize = '';
            textPos = 'vertical';
            break;
        case 2:
            text = '';
            maxSize = 30;
            textPos = 'vertical';
            break;
        case 3:
            maxSize = 30;
            textPos = 'horizontal';
            fontSize = '18px';
            break;
    }

    el.waitMe({
        effect: effect,
        text: text,
        bg: 'rgba(0, 159, 250, 0.15)',
        color: '#009ffa',
        maxSize: maxSize,
        waitTime: -1,
        source: 'img.svg',
        textPos: textPos,
        fontSize: fontSize,
        onClose: function(el) {}
    });
}

function getNumberFormat( _num )
{
    _num = parseInt(_num);
    _num = _num.toString();  
    var num = _num.split("");
    num = num.reverse();
    _num = num.join("");
    var result = "";
    var gap_size = 3; //Desired distance between spaces

    while (_num.length > 0) { // Loop through string 
        result = result + " " + _num.substring(0,gap_size); // Insert space character
        _num = _num.substring(gap_size);  // Trim String
    }
    num = result.split("");
    num = num.reverse();
    result = num.join("");
    return result;
}

function getNumberFromString( str ) 
{
    str = str.replace(/\s/g, '');
    return parseInt(str);
}


