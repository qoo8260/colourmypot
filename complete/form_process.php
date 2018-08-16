
<?php 



include 'mysql/config.php';
// define variables and set to empty values
$first =$_POST['name'];
$last =$_POST['lastname'];
$pass1 =$_POST['pass1'];
$pass2 =$_POST['pass2']; 
$email =$_POST['email']; 
$phone =$_POST['phone']; 
$msg="";

session_start();
if(isset($_SESSION['login']))
{
         header("Location: index.php");
}



  
   
  

            
if($first != "" && $last != "" && $pass1 != "" && $pass2 != "" && $email != "" && $phone != "")
{
    
    if(!$conn)
    {
        echo "not connected to the server";
    }

      
      
      
      
      
     if(!mysqli_select_db($conn, $db))
     {
        echo "database not selected";
     }
      
      $hashed_password = password_hash($pass2, PASSWORD_DEFAULT);
      

      

      
      
        $sql = "INSERT INTO paint_users (first, last, password, email, mobile)
        VALUES ('$first', '$last', '$hashed_password', '$email', '$phone')";
      
      
      
    
      
      if(!mysqli_query($conn,$sql))
      {
        mysqli_close($conn);

          $msg="Your entered email already exists";

      }
      else
      {
          mysqli_close($conn);
          $msg="Successfully registered";

      }
}
      


      



      
      
      
      
      
    
?>
<script>
    var showmsg="<?php echo $msg ?>";
    alert(showmsg);
    if(showmsg === "Successfully registered")
    {
       window.location.replace("login.php");

    }
    else
    {
        window.location.replace("registration.php");

    }
</script>