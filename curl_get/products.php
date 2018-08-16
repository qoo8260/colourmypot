<?php




    $url="https://app.getoccasion.com/api/v1/products/6o1bbk26ub4lenuft6rx2g";
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


    





    




   
    

?>