<?php

require 'vendor/autoload.php';
require "vendor/parse/php-sdk/autoload.php";
use Parse\ParseClient;

ParseClient::initialize('4ECwF2VPmjUItXMJcN7BuWkIOrDnFoIobZh8tvBn', 'kc7swveVnKK1uOPhH9UWtyGcUyMlYtGx5fb4H3e7', 'IZLjXYWlzAs70kFF1ULWzi18qyGXqU15uOD7woI6');

use Parse\ParseObject;
use Parse\ParseQuery;


$url = "https://api.twitter.com/1.1/trends/place.json?id=1";
$ch = curl_init($url);

$headr = array();
$headr[] = 'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAHmGbwAAAAAAz7ulpHL%2B19o1cBYxFlTuq18j4lY%3Dt80NuYWTX0Sv71xYTiJIf6bYOFl6hPw0AzFJ3Drxrop1r91HWN';
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
$out = curl_exec($ch);
$arr = json_decode($out,true);
print_r($arr);

foreach($arr[0]['trends'] as $a){
	$testObject = ParseObject::create("TrendingTags");
	$testObject->set("tag", urldecode($a['name']));
	$testObject->save();

}




?>



