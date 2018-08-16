
<?php
    session_start();
if($_SESSION['login'] != "yes")
{
         header("Location: login.php");
}

    ini_set('max_execution_time', 300); 



    function getCurl($url, $website)
    {

        $curl = curl_init();


        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        if($website=="VEND")
        {
            $authorization = "Authorization: Bearer 5OtjwgBqfHJZh9rfC8xyh_30hOwLI85x9RGz5Ghy";
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

        }
        else if($website=="OCCASION")
        {
            curl_setopt($curl, CURLOPT_USERPWD, "b7cdd4d0ef60483ca97f06a5938c39bb:61184e35638d4300ab6755a89cbd507f");
        }

        curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    //========================================================GET OCCASION ORDERS
    //$url="https://app.getoccasion.com/api/v1/orders?page[size]=10000000";
    //$url="https://app.getoccasion.com/api/v1/orders?include=occurrences";

    //$url="https://app.getoccasion.com/api/v1/products/jwykxgeopa_cizlfgobvsw/time_slots?filter[status]=bookable&page[size]=100";
    


    //$url="https://app.getoccasion.com/api/v1/orders/ps1r00s0?include=occurrences";

    //$url="https://app.getoccasion.com/api/v1/orders/ps1r00s0?include=product";


    //$url="https://app.getoccasion.com/api/v1/orders/ps1r00s0/?include=product,occurrences";



    $url="https://app.getoccasion.com/api/v1/orders?include=occurrences&page[size]=1000000000";


    $website="OCCASION";
    $result = getCurl($url, $website);
    $array = json_decode($result, true);


    //$bookingobj=[];
    $custdetails=[];
    $length_bookings=count($array["included"]);

$cnt=0;
$uniquestartTime=[];
$uniquestartDate=[];
$uniqueendTime=[];
foreach($array["included"] as $custinfo)
{
    if($cnt<$length_bookings)
    {
        //echo $custinfo["attributes"]["starts_at"];

        //occurences            
        list($startDate, $startTimebf) = explode("T", $custinfo["attributes"]["starts_at"]);
        list($endDate, $endTimebf) = explode("T", $custinfo["attributes"]["ends_at"]);

        $uniquestartDate[]=$startDate;
        
        $piecesStartTime=explode(".", $startTimebf);
        $expstart=explode(":", $piecesStartTime[0]);
        $uniquestartTime[]=$expstart[0].":".$expstart[1]; 
        
        $piecesEndTime=explode(".", $endTimebf);
        $expend=explode(":", $piecesEndTime[0]);
        $uniqueendTime[]=$expend[0].":".$expend[1];
    }
    $cnt++;    

}

$i=0;
foreach($array["data"] as $custinfo)
{
    
    
    
    
    if($i<$length_bookings)
    {
        $payment=$custinfo["attributes"]["payment_status"];
        $status=$custinfo["attributes"]["status"];
        if($payment=="completed" && $status=="booked")
        {
            //$bookingobj[]=$custinfo["id"];
            
            
            
                $title=$custinfo["attributes"]["description"];
                $name=$custinfo["attributes"]["customer_name"];
                $quantity=$custinfo["attributes"]["quantity"];
                $first=$custinfo["attributes"]["customer_first_name"];
                $last=$custinfo["attributes"]["customer_last_name"];
            

            


            
            
            $custobj=array(
                "title" => $title,
                "first" => strtoupper($first),
                "last" => strtoupper($last),
                "name" => $name,
                 "quantity" => $quantity,
                 "duedate" => $uniquestartDate[$i],            
                 "starttime" => $uniquestartTime[$i],            
                 "endtime" => $uniqueendTime[$i]    
            );
            
            array_push($custdetails, $custobj);
        
        
        
        }
    $i++;
    }

}
    


$first_name=(isset($_SESSION['first']))?$_SESSION['first']:'';
$last_name=(isset($_SESSION['last']))?$_SESSION['last']:'';

    


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
  		<h4>My Booking History</h4><hr>
  
  

  
  
  

  
  

  
  

  



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
             var custdetails=<?php echo json_encode($custdetails); ?>;
   
            


            
    //console.log(tablefirstname.toUpperCase());        
    //console.log(tablelastname.toUpperCase());
            

    var myfirst="<?php echo $first_name; ?>";
    var mylast="<?php echo $last_name; ?>";

    var myfirst=myfirst.toUpperCase();
    var mylast=mylast.toUpperCase();
    
    myfirst= myfirst.replace(/\s/g, '');
    mylast= mylast.replace(/\s/g, '');


    
    var resultOfDate = custdetails.filter( obj => obj.first === myfirst);
    resultOfDate = resultOfDate.filter( obj => obj.last === mylast);
    
    
    
    
    
    
    if(resultOfDate.length <= 0)
    {
       alert("No Result Found");
    }    
        
    custdetails=[];
    //console.log(custdetails);
        
        
    var productDate=[];
    for(var i=0;i<resultOfDate.length;i++)
    {
        //console.log(resultOfDate[i].duedate);
        productDate.push(resultOfDate[i].duedate);
    }        
        
    var uniqueDate = Array.from(new Set(productDate));
    uniqueDate.sort(function (a, b) {
      return new Date(a) - new Date(b);
    });    
    //console.log(uniqueDate);
    
        
    var productTime=[];
    for(var i=0;i<resultOfDate.length;i++)
    {
        productTime.push(resultOfDate[i].starttime);
    }    
        
    var uniqueTime = Array.from(new Set(productTime));
    uniqueTime.sort(function (a, b) {
      return new Date('2000/01/01 ' + a) - new Date('2000/01/01 ' + b);
    });
    //console.log(uniqueTime);
    
 
 
            

            
    var showtable=null;
for(var k=0;k<uniqueDate.length;k++)
{
    var totalattendee=0;
    var headtitle=document.createElement("h3"); 
    headtitle.style.cssText="color:blue;";
    headtitle.innerHTML="<br><br>"+uniqueDate[k]+"<hr>";
    tablepaint.appendChild(headtitle);

    for(var i=0;i<uniqueTime.length;i++)
    {
        
        var divtable1=document.createElement("div");
        divtable1.className="input-group mb-3";
        var divtable2=document.createElement("div");
        divtable2.className="input-group mb-3";
        var divtable3=document.createElement("div");
        divtable3.className="input-group mb-3";
        var headtable=document.createElement("h4"); 
        
        var showtable=document.createElement("table");
        showtable.className="table table-hover table-responsive";
        showtable.id="infotable";
        var rows=showtable.insertRow(0);
        rows.className="table-active";
        var c1=rows.insertCell(0);
        var c2=rows.insertCell(1);
        var c3=rows.insertCell(2);
        var c4=rows.insertCell(3);
        var c5=rows.insertCell(4);
        c1.innerHTML="Name";
        c2.innerHTML="Title";
        c3.innerHTML="Qty";
        c4.innerHTML="Start";
        c5.innerHTML="End";
        
        

        var quantity=0;
        var cntrow=0;
        for(var j=0;j<resultOfDate.length;j++)
        {
                if(resultOfDate[j].starttime === uniqueTime[i] && resultOfDate[j].duedate === uniqueDate[k])
                {
                    cntrow++;
                    var rows=showtable.insertRow(cntrow);
                    var cell1=rows.insertCell(0);
                    var cell2=rows.insertCell(1);
                    var cell3=rows.insertCell(2);
                    var cell4=rows.insertCell(3);
                    var cell5=rows.insertCell(4);                    
                    cell1.innerHTML=resultOfDate[j].name;
                    cell2.innerHTML=resultOfDate[j].title;
                    cell3.innerHTML=resultOfDate[j].quantity;
                    cell4.innerHTML=resultOfDate[j].starttime;
                    cell5.innerHTML=resultOfDate[j].endtime;

                    
                                        
                    quantity+=resultOfDate[j].quantity;
                    totalattendee+=resultOfDate[j].quantity;

                    
                    
                    
                    
                    
                    
                    
                    
                }//if
        }//j
        
        
                if(quantity>0)
                {
                    headtable.innerHTML =uniqueTime[i]+"- Attendees: "+quantity+"<br>";                    
                    divtable1.appendChild(headtable);
                    divtable2.appendChild(showtable);
                    divtable3.appendChild(divtable1);
                    divtable3.appendChild(divtable2);
                    tablepaint.appendChild(divtable3);
                }
                
    }//i
        

        //headtitle.innerHTML="<br><br>"+uniqueDate[k]+" (Total: "+totalattendee+")<hr>";


    }//k
            
            
            
            
            
            
            
            

		
		


   

    

      
	</script>

	

    
</body>


</html>









