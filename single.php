



<?php
    ini_set('max_execution_time', 300); 
    

    //========================================================SHOW OCCASION ORDERS
    
    $url="https://app.getoccasion.com/api/v1/orders";
    $website="OCCASION";
    $result = getCurl($url, $website);
    $array = json_decode($result, true);


        $payment=$array["data"][0]["attributes"]["payment_status"];
        $booking=$array["data"][0]["attributes"]["status"];
        
        if($payment=="completed" && $booking=="booked")
        {
            
            
            $email=$array["data"][0]["attributes"]["customer_email"];
            $name=$array["data"][0]["attributes"]["customer_name"];
            $first_name=$array["data"][0]["attributes"]["customer_first_name"];
            $last_name=$array["data"][0]["attributes"]["customer_last_name"];
            $password=$array["data"][0]["id"];
            $zip=$array["data"][0]["attributes"]["customer_zip"];
            $quantity=$array["data"][0]["attributes"]["quantity"];
            $tax=$array["data"][0]["attributes"]["tax"];
            $price=$array["data"][0]["attributes"]["price"];
            $description=$array["data"][0]["attributes"]["description"];
            $created_time=$array["data"][0]["attributes"]["created_at"];

            
            
            
            
          //========================================================CREATE WORDPRESS CUSTOMER
            
            
            
        $website="WORDPRESS";
        $url="https://dev.colourmypot.com/api/get_nonce/?controller=user&method=register";
        $wp_result_1=getCurl($url, $website);
        $wp_array = json_decode($wp_result_1, true);
        $nonce=$wp_array["nonce"];

        $url="https://dev.colourmypot.com/api/user/register/?username=".$password."&email=".$email."&nonce=".$nonce."&display_name=".$first_name;
        $wp_result_2 = getCurl($url, $website);
            
            
            
            
            
            
            
            
            
            
            
          //========================================================CREATE VEND CUSTOMER






              $data = array(
              "first_name" => $first_name,
              "last_name" => $last_name,
              "customer_code" => $password,

              "customer_group_id" => null,
              "enable_loyalty" => null,
              "email" => $email,

              "note" => null,
              "gender" => null,
              "date_of_birth" => null,

              "company_name" => null,
              "do_not_email" => null,
              "phone" => null,

              "mobile" => null,
              "fax" => null,
              "twitter" => null,

              "website" => null,
              "physical_address_1" => null,
              "physical_address_2" => null,


              "physical_suburb" => null,
              "physical_city" => null,
              "physical_postcode" => null,

              "physical_state" => null,
              "physical_country_id" => null,
              "postal_address_1" => null,



              "postal_address_2" => null,
              "postal_suburb" => null,
              "postal_city" => null,

              "postal_postcode" => $zip,
              "postal_state" => null,
              "postal_country_id" => null,

              "custom_field_1" => null,
              "custom_field_2" => null,
              "custom_field_3" => null,
              "custom_field_4" => null,
              );
            
            $url="https://colourmypot.vendhq.com/api/2.0/customers";
            $json_data = json_encode($data);
            postCurl($url, $json_data);
            
            
            
            
            
            
    

            
            
            
            




        $url="https://colourmypot.vendhq.com/api/customers?page_size=10000000000000000&email=".$email;
        $website="VEND";
        $result=getCurl($url, $website);

         $arr_cust = json_decode($result, true);



            
            
            
            
        
            
            

          $var = array($name, $description, $created_time);
          $strvar = implode(',', $var);


          $data = array(
          "register_id" => gen_uuid(),
          "customer_id"=> $arr_cust["customers"][0]["id"],
          "user_id" => "02dcd191-ae2b-11e6-f485-685a4532ee70",
          "status" => "CLOSED",
          "note" => $strvar,
          "register_sale_products" => array(array(        
          "product_id" => "02dcd191-aebb-11e7-f130-a4fc3daefe89",           
          "quantity" => $quantity,
          "price" => ($price/$quantity),
          "tax" => $tax,
          "tax_id" => gen_uuid() ))        
          );


        
            
            
            
            
            
            
            
            
            
            
            
    $arr=$arr_cust["customers"][0]["note"];

    $addvar=$created_time;
    if($arr!=null)
    {

    $strvar = explode(',', $arr);

    $ck=false;
    $cnt=0;
    $counter=count($strvar);
    for($cnt;$cnt<$counter;$cnt++)
    {
        if($strvar[$cnt]==$addvar)
        {

        $ck=true;  

        }
    }
        if(!$ck)
        {
            //========================================================update note
            $arr.=$addvar.",";
            $url="https://colourmypot.vendhq.com/api/2.0/customers/".$arr_cust["customers"][0]["id"];
            $input_arr=array("data" => array("note" => $arr)   );
            $json_input = json_encode($input_arr);
            putCurl($url, $json_input);
            
            
            //========================================================CREATE VEND ORDER
            $url="https://colourmypot.vendhq.com/api/register_sales";
            $json_data = json_encode($data);
            postCurl($url, $json_data);
        }
    

    }
    else
    {
            //========================================================update note

            $arr.=$addvar.",";
            $url="https://colourmypot.vendhq.com/api/2.0/customers/".$arr_cust["customers"][0]["id"];
            $input_arr=array("data" => array("note" => $arr)   );
            $json_input = json_encode($input_arr);
            putCurl($url, $json_input);
        
        
            //========================================================CREATE VEND ORDER
            $url="https://colourmypot.vendhq.com/api/register_sales";
            $json_data = json_encode($data);
            postCurl($url, $json_data);
        
        
    }
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
        }
        
        
        





    //===========================================================================FUNCTIONS

    function postCurl($url, $json_data)
    {
            $authorization = "Authorization: Bearer 5OtjwgBqfHJZh9rfC8xyh_30hOwLI85x9RGz5Ghy";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_exec($curl);
            
            curl_close($curl);

    }



    function putCurl($url, $json_data)
    {
            $authorization = "Authorization: Bearer 5OtjwgBqfHJZh9rfC8xyh_30hOwLI85x9RGz5Ghy";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_exec($curl);
            
            curl_close($curl);

    } 




  
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





 

 
    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
   
    header("Location: https://colourmypot.com/");


?>