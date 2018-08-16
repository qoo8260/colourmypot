















<html>
<head>
    <meta charset="utf-8">
    
    
    <title>Colour My Pot</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
<link href="https://fonts.googleapis.com/css?family=Comfortaa|Roboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap4-wizardry.min.css">
    
    
    

  </head>
<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="login.php">Colour My Pot</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" style="">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
    
    

    
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registration.php">Register</a>
      </li>

	

      
      
      
      
      
      
      
      
      

    </ul>

  </div>
</nav>





















		
		
		
	


	
	
<br>


	
		 <div class="container">
		 
             
             
             
             
             
            <h3>Log In</h3><hr>
		 
		 
		 
		 
		 

		 
		 
		 

		 
		 

		 
		 
		 
		 
		 
		 
<!-- =========================================================== sign up body -->

  <form id="logform" action="login_process.php" method="post">	

	
		 
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
  </div>
  <input type="text" placeholder="Enter Your Email" class="form-control is-invalid" name="email" id="email">    
    

  
  </div>	


  

		 
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
  </div>
  <input type="password" placeholder="Enter Password" class="form-control is-invalid" name="password" id="password">    
    
        

  
  </div>		 

	
	
	























	 
		 

	 		 


		 
		 
		 
 
		 
		 </form>
			 		<div class="input-group mb-3">

   <input type="button" class="form-control" id="logsubmit" value="Log In"> 
  </div>		

<!-- =========================================================== sign up body -->		 


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
        <h5 class="text-uppercase">Flatmate</h5>
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

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	
	

		
		
		
		



	<script>
        $( "#logsubmit" ).click(function() {
            
            var cnt=0;
            if(document.getElementById("email").value === "")
            {
                alert("You cannot leave email blank");
                cnt++;
            }
            if(document.getElementById("password").value === "")
            {
                alert("You cannot leave password blank");
                cnt++;
            }
            if(cnt <= 0)
            {
               document.getElementById("logform").submit();
            }
            
            
            
        });
        
        

        
    </script>
	

    
    
    
</body>



</html>















