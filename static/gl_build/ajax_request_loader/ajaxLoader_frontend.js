
function ajaxindicatorstart(text)
{
//    <img src='"+base_url+"static/frontend/images/radio.gif'>
   
    
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        var base_url = $(".base_url").val();
       // console.log(base_url);
        var loadstr = "<div id='resultLoading' style='display:none;'>" +
                "<div>" +
                "<div><?xml version='1.0' encoding='utf-8'?>"+
    "<svg width='80px' height='80px' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'"+ 
    "preserveAspectRatio='xMidYMid' class='uil-ring-alt'><rect x='0' y='0' width='100' height='100'"+ 
    "fill='none' class='bk'></rect>"+ 
    "<circle cx='50' cy='50' r='40' stroke='none' fill='none' stroke-width='10' stroke-linecap='round'></circle>"+
    "<circle cx='50' cy='50' r='40' stroke='#3769c8' fill='none' stroke-width='6' stroke-linecap='round'>"+
    "<animate attributeName='stroke-dashoffset' dur='2s' repeatCount='indefinite' from='0' to='502'></animate>"+
    "<animate attributeName='stroke-dasharray' dur='2s' repeatCount='indefinite' values='200.8 50.19999999999999;1 250;200.8 50.19999999999999'></animate>"+
    "</circle></svg>"+
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
