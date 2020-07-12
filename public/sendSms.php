
<?php
        // create curl resource
        $ch = curl_init();

        // set url
        $url= 'http://10.205.48.187:13013/cgi-bin/sendsms?username=ongc&password=ongc12&from=ONGC&to=9968282814&text=Test+message&remLen=148&charset=UTF-8';

        curl_setopt($ch, CURLOPT_URL,$url);

        // //return the transfer as a string
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);     
?>