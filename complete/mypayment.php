
<?php

    session_start();
if($_SESSION['login'] != "yes")
{
         header("Location: login.php");
}

    ini_set('max_execution_time', 300); 



    $url="https://colourmypot.vendhq.com/api/register_sales?page_size=1000000";





    $curl = curl_init();


    $authorization = "Authorization: Bearer 5OtjwgBqfHJZh9rfC8xyh_30hOwLI85x9RGz5Ghy";



    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    //curl_setopt($curl, CURLOPT_USERPWD, "b7cdd4d0ef60483ca97f06a5938c39bb:61184e35638d4300ab6755a89cbd507f");
    curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);

    curl_close($curl);

    //echo $result."<br>";

    $array = json_decode($result, true);






    $counter=count($array["register_sales"]);
    


    $order_array=[];

    for($i=0;$i<$counter;$i++)
    {
        
        if(isset($array["register_sales"][$i]["customer"]["email"]))
        {
            if($array["register_sales"][$i]["customer"]["email"] == $_SESSION['email'])
            {
                //echo $array["register_sales"][$i]["customer"]["email"]."<br>";
                //echo $array["register_sales"][$i]["invoice_number"]."<br>";
                //echo $array["register_sales"][$i]["register_sale_products"][0]["quantity"]."<br>";
                $strbf = explode(',',  $array["register_sales"][$i]["note"]);
                $straf = explode('T',  $strbf[2]);
                //echo $straf[0];
                

                $order_details=array("invoice_number"=>$array["register_sales"][$i]["invoice_number"],
                                    "quantity"=>$array["register_sales"][$i]["register_sale_products"][0]["quantity"],
                                    "date"=>$straf[0]);

                    
                
                    $order_array[]=$order_details;
            }
            
        }
    }
    //echo $order_array[0]["email"];


    



   


?>
<html>
<head>
    <meta charset="utf-8">
    
    
    <title>Colour My Pot</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
<link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap4-wizardry.min.css">


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"><?php echo "Hi, ".$_SESSION['first'];?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
    
    

    
      <li class="nav-item">
        <a class="nav-link" href="index.php">My Booking</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mypayment.php">My Payment</a>
      </li>
          <li class="nav-item">
        <a class="nav-link" href="selectname.php">Search(Name)</a>
      </li>
	   <li class="nav-item">
        <a class="nav-link" href="twodates.php">Search(Two Intervals)</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="specificdate.php">Search(Date)</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="logoff.php">Logoff</a>
      </li>
      
      
      
      
      
      
      
      
      

    </ul>

  </div>
</nav>
























		
		
		
	


	
	

	
		 <div class="container">
<!-- ==============================================================================container -->







		


  

  
  
  
  
  
  <br>
  		<h4>My Payment History</h4><hr>
  
  

  
  
  

  
  

  
  

  





  







        	<div class="input-group mb-3" id="painttable">
             </div>

<!-- ==============================================================================container -->
    </div>

	<!-- Footer -->
<footer class="page-footer font-small blue pt-4 mt-4 p-3 mb-2 bg-light text-dark">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left ">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">Colour My Pot</h5>
        <p>Developed by Joshua Yoon</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-6 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Share Us On</h5>

        <ul class="list-unstyled">
        
        
        
        
   <li class="nav-item active">
<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-google"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="#" class="fa fa-youtube"></a>
<a href="#" class="fa fa-instagram"></a>
<a href="#" class="fa fa-pinterest"></a>

      </li>


      
      

    
          
          
          
          
          
          
          
        </ul>
        
        

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Copyright © 2018 All Rights Reserved By Joshua Yoon
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script type="text/javascript">
	
    var tablepaint =document.getElementById("painttable");

            while(tablepaint.firstChild)
            {
                  tablepaint.removeChild(tablepaint.firstChild);
            }
                //$("#showtablevisibility").val("visible");
             var custdetails=<?php echo json_encode($order_array); ?>;
             
             
            if(custdetails.length <= 0)
            {
               alert("No Result Found");
            }
             
    
    
    
    
    
    
    
    
    
    
        

        
        var divtable1=document.createElement("div");
        divtable1.className="input-group mb-3";

        
        var showtable=document.createElement("table");
        showtable.className="table table-hover table-responsive";
        showtable.id="infotable";
        var rows=showtable.insertRow(0);
        rows.className="table-active";
        var c1=rows.insertCell(0);
        var c2=rows.insertCell(1);
        var c3=rows.insertCell(2);
        c1.innerHTML="Receipt Number";
        c2.innerHTML="Qty";
        c3.innerHTML="Payment Date";

        
        


        for(var j=0;j<custdetails.length;j++)
        {
            
                    var rows=showtable.insertRow(j+1);
                    var cell1=rows.insertCell(0);
                    var cell2=rows.insertCell(1);
                    var cell3=rows.insertCell(2);
                    cell1.innerHTML=custdetails[j].invoice_number;
                    cell2.innerHTML=custdetails[j].quantity;
                    cell3.innerHTML=custdetails[j].date;

                    
                                                            
                    
  
        }//j
        
        
                if(custdetails.length>0)
                {
                    divtable1.appendChild(showtable);
                    tablepaint.appendChild(divtable1);
                }

   

    

      
	</script>

	

    
</body>


</html>









