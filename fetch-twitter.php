<?php

require 'vendor/autoload.php';
require "vendor/parse/php-sdk/autoload.php";
use Parse\ParseClient;

ParseClient::initialize('4ECwF2VPmjUItXMJcN7BuWkIOrDnFoIobZh8tvBn', 'kc7swveVnKK1uOPhH9UWtyGcUyMlYtGx5fb4H3e7', 'IZLjXYWlzAs70kFF1ULWzi18qyGXqU15uOD7woI6');

use Parse\ParseObject;
use Parse\ParseQuery;

$query = new ParseQuery("NYTimes");

$results = $query->find();

$query->each(function($obj) {

	$q = urlencode("from:nytimes ".$obj->get("headline"));
	$q = urlencode($obj->get("headline"));

	$url = "https://api.twitter.com/1.1/search/tweets.json?q=".$q;
	$ch = curl_init($url);

	$headr = array();
	$headr[] = 'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAHmGbwAAAAAAz7ulpHL%2B19o1cBYxFlTuq18j4lY%3Dt80NuYWTX0Sv71xYTiJIf6bYOFl6hPw0AzFJ3Drxrop1r91HWN';
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
	$out = curl_exec($ch);
	$arr = json_decode($out,true);

	print_r($obj->getObjectId());


//	print_r($arr);
	if(count($arr['statuses']) != 0){
		$obj->set("retweets", $arr['statuses'][0]['retweet_count']);
		$obj->set("favorites", $arr['statuses'][0]['favorite_count']);
		$obj->set("tweets", count($arr['statuses']));
		$obj->save();
	}else{
	//print_r($arr);
	}

	sleep(2);
});



?>



