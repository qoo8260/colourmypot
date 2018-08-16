

<?php 
include 'mysql/config.php';
// define variables and set to empty values
$email =$_POST['email'];
$password=$_POST['password'];


$msg = "Your email or password is incorrect"; 

      

if(!$conn)
{
    echo "not connected to the server";
}
if(!mysqli_select_db($conn, $db))
 {
    echo "database not selected";
 }
//=================================mysql connection end

session_start();
if(isset($_SESSION['login']))
{
         header("Location: index.php");
}


    
    
    
    
    
      $pass_sql = "SELECT * FROM paint_users WHERE email = '$email'";
      $pass_result = mysqli_query($conn,$pass_sql);    


    while ($pass_row = $pass_result->fetch_assoc()) {
       

      if(password_verify($password, $pass_row['password']))
      {
        
             $_SESSION['login_user'] = $pass_row['first']." ".$pass_row['last'];
             $_SESSION['login'] = "yes";
             $_SESSION['first'] = $pass_row['first'];
             $_SESSION['last'] = $pass_row['last'];
             $_SESSION['email'] = $pass_row['email'];
             $_SESSION['mobile'] = $pass_row['mobile'];
             mysqli_close($conn);
             $msg = "Successfully logged in";
            
        
      }
        
        //password
 
        
        
        
    }//row
    
    


?>
<script>
    var showmsg="<?php echo $msg ?>";
    alert(showmsg);
    if(showmsg === "Successfully logged in")
    {
       window.location.replace("index.php");

    }
    else
    {
        window.location.replace("login.php");

    }
</script>

    
    




