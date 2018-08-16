<?php




    //$url="https://colourmypot.vendhq.com/api/2.0/customers/";
    $url="https://colourmypot.vendhq.com/api/2.0/customers?page_size=10000000000000000";
    //$url="https://colourmypot.vendhq.com/api/customers";


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

    //curl_close($curl);

    echo $result."<br>";

    $array = json_decode($result, true);
    //echo $array["customers"][0]["id"];
    
    //echo $array;


   
    

?>