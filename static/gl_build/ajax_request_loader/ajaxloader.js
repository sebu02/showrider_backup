
function ajaxindicatorstart(text)
{
//    <img src='"+base_url+"static/frontend/images/radio.gif'>
   
    
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        var base_url = $(".base_url").val();
       // console.log(base_url);
        var loadstr = "<div id='resultLoading' style='display:none;'>" +
                "<div>" +
                "<div><svg width='100px'  height='200px'  xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' preserveAspectRatio='xMidYMid' class='lds-dual-ring' style='background: none;'><circle cx='50' cy='50' ng-attr-r='{{config.radius}}' ng-attr-stroke-width='{{config.width}}' ng-attr-stroke='{{config.stroke}}' ng-attr-stroke-dasharray='{{config.dasharray}}' fill='none' stroke-linecap='round' r='40' stroke-width='4' stroke='#eef6fc' stroke-dasharray='62.83185307179586 62.83185307179586' transform='rotate(251.472 50 50)'><animateTransform attributeName='transform' type='rotate' calcMode='linear' values='0 50 50;360 50 50' keyTimes='0;1' dur='1s' begin='0s' repeatCount='indefinite'></animateTransform></circle></svg>"+
     "</div>"+
                "<div>"+text+"</div>" +
                "</div>" +
                "<div class='bg'></div>" +
                "</div> ";
       
        jQuery('body').append(loadstr);
        // console.log(loadstr);
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.7',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '7%',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}


function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
