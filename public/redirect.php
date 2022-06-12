<?php
ob_start();
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
//$ip = "23.16.0.0";

$url = "https://www.iplocate.io/api/lookup/" . $ip;
$dataObj = json_decode(file_get_contents($url), true);
$country = $dataObj['country'];

echo 'Your ip is: ' . $ip . '<br>';
echo 'Your country is: ' . $country . '<br>';

if ($country == 'United States') {
    echo 'You will be redirect after 5 second';
    header("refresh: 5; url=https://ippolitov.tech");
    die();
} elseif ($country == 'Canada') {
    echo 'You will be redirect after 5 second';
    header("refresh: 5; url=https://upwork.com");
    die();
} else {
    echo 'You live not in USA';
};
