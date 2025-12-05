<html>


<head>


<title>Secure Payment | CCavenue | glinfotech.net</title>


</head>


<body>


<center>


<?php


//error_reporting(0);


//print_r($paymentparams);


?>


<iframe src="<?php echo $action?>" id="paymentFrame" width="482" height="450" frameborder="0" scrolling="No" ></iframe>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">


    	$(document).ready(function(){


    		 window.addEventListener('message', function(e) {


		    	 $("#paymentFrame").css("height",e.data['newHeight']+'px'); 	 


		 	 }, false);


	 	 	


		});


</script>


</center>


</body>


</html>





