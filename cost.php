<?php
/**
 * User: Awan
 * Date: 24/12/2015
 * Time: 19:32
 */

$key = "e38de917e9c6bd610be9b4d70b2b7e93";

$origin = isset($_POST['city_origin']) ? $_POST['city_origin'] : '';
$destination = isset($_POST['city_destination']) ? $_POST['city_destination'] : '';
$weight = isset($_POST['weight']) ? $_POST['weight'] : '';
$courier = isset($_POST['courier']) ? $_POST['courier'] : '';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: $key"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}