if($(".ticketnumber_class").length){
	
var eventid = $(".eventid_class").val();

$(".eventshowid_class").val(eventid);	
	
	
	
}


$('body').on('keyup', '.ticketnumber_class', function()
{

var ticketnumber = $(this).val();

ticketnumber = parseInt(ticketnumber);

var max_ticket_number = $(this).parents(".tickets_row").find(".gl_max_ticket_number").val();

max_ticket_number = parseInt(max_ticket_number);

if(ticketnumber > max_ticket_number){
    alert("Sorry the maximum number available is " + max_ticket_number);
    $(this).val(max_ticket_number);

    ticketnumber = max_ticket_number;
}

calculate_total_amount() ;
	
	
});


 $('.ticketnumber_class').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
  
  
function calculate_total_amount()
{  
var total_ticket_price = 0;

$(".tickets_row").each(function () {

if($(this).find('.ticketnumber_class').val() != '')
{

var ticketnumber = $(this).find('.ticketnumber_class').val();
var eventticketid = $(this).find('.eventticketid_class').val();
var ticketprice = $(this).find('.ticketprice_class').val();

	
total_ticket_price+= parseInt(ticketnumber)*parseInt(ticketprice);	
	
}	
	
});

$(".total_bookshow_amount").html(total_ticket_price);

$(".gl_final_amount").val(total_ticket_price);

}



$(".bookashowform").submit(function(){
    var isFormValid = false;
    $(".bookashowform .ticketnumber_class").each(function(){ // Note the :text
        if (parseInt($(this).val()) > 0){
            isFormValid = true;
        }
		
    });
    if (!isFormValid) alert("Please fill in all the required fields!");
    return isFormValid;
});