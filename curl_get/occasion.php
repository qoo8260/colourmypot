<?php




    //$url="https://app.getoccasion.com/api/v1/orders?page[size]=10000000";
    $url="https://app.getoccasion.com/api/v1/orders";




    //$url="https://app.getoccasion.com/api/v1/customers";
    //$url="https://app.getoccasion.com/api/v1/products";
    $curl = curl_init();


    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "b7cdd4d0ef60483ca97f06a5938c39bb:61184e35638d4300ab6755a89cbd507f");
    curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);

    curl_close($curl);

    echo $result."<br>";

    $array = json_decode($result, true);

    echo $array."<br>";


    //$counter=count($array["data"]);
    

/*
    $cnt=0;
    for($cnt;$cnt<$counter;$cnt++)
    {
        $payment=$array["data"][$cnt]["attributes"]["payment_status"];
        $booking=$array["data"][$cnt]["attributes"]["status"];
        
        if($payment=="completed" || $booking=="booked")
        {
            
            
            $email=$array["data"][$cnt]["attributes"]["customer_email"];
            $name=$array["data"][$cnt]["attributes"]["customer_name"];
            $password=$array["data"][$cnt]["id"];
            $zip=$array["data"][$cnt]["attributes"]["customer_zip"];
            //echo $email."<br>";
            //echo $name."<br>";
            //echo $password."<br>";
            //echo $zip."<br>";
            
            

            
            
            
            
            
            
            
            $sql_command = "SELECT * FROM paint_users";
            $result_query = mysqli_query($conn,$sql_command);    

            $_bool=false;
            while ($sql_row = $result_query->fetch_assoc()) 
            {
                
                if($sql_row["email"]==$email)
                {
                    //echo "email exists already"."<br>";
                    $_bool=true;
                }



            }
            if(!$_bool)
            {
                $sql = "INSERT INTO paint_users (email, name, password, zip) VALUES ('$email', '$name', '$password', '$zip')";
                
                if(!mysqli_query($conn,$sql))
                {
                  //echo mysqli_error($conn)." unsuccessful"."<br>";
                }

                
            }
            
            $sql_command = "SELECT * FROM booking";
            $result_query = mysqli_query($conn,$sql_command);    

            
            $title=$array["data"][$cnt]["attributes"]["description"];
            $created_time=$array["data"][$cnt]["attributes"]["created_at"];
            $quantity=$array["data"][$cnt]["attributes"]["quantity"];
            
            
            
            $bl=false;
            while ($sql_row = $result_query->fetch_assoc()) 
            {
                


                if($sql_row["email"]==$email && $sql_row["title"]==$title
                  && $sql_row["created_time"]==$created_time)
                {
                    //echo "email exists already"."<br>";
                    $bl=true;
                }

            }
            if(!$bl)
            {

                $sql = "INSERT INTO booking (customer_name, quantity, title, created_time, email) VALUES ('$name', '$quantity', '$title', '$created_time', '$email')";
                
                if(!mysqli_query($conn,$sql))
                {
                  //echo mysqli_error($conn)." unsuccessful"."<br>";
                }
                else
                {
                  //echo "successful"."<br>";
                }
                
            }
            

            
            
                

            
        }
        
        
        

    }
    
    mysqli_close($conn);


    
*/



   
    

?>