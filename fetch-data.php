<?php

require 'vendor/autoload.php';
require "vendor/parse/php-sdk/autoload.php";
use Parse\ParseClient;
 
ParseClient::initialize('4ECwF2VPmjUItXMJcN7BuWkIOrDnFoIobZh8tvBn', 'kc7swveVnKK1uOPhH9UWtyGcUyMlYtGx5fb4H3e7', 'IZLjXYWlzAs70kFF1ULWzi18qyGXqU15uOD7woI6');

use Parse\ParseObject;
 


$url = "http://api.usatoday.com/open/articles?section=sports&most=commented&api_key=sqzmzrccvfuakhm6z9wh7gnv&encoding=json&count=50";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$out = curl_exec($ch);
$arr = json_decode($out, true);

foreach($arr['stories'] as $a){
	$testObject = ParseObject::create("USAToday");
$testObject->set("headline", $a['title']);
$testObject->set("date", strtotime($a['pubDate']));
$testObject->set("type", "most-commented");

$testObject->save();
}

?>
