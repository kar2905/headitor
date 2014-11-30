<?php

require 'vendor/autoload.php';
require "vendor/parse/php-sdk/autoload.php";
use Parse\ParseClient;

ParseClient::initialize('4ECwF2VPmjUItXMJcN7BuWkIOrDnFoIobZh8tvBn', 'kc7swveVnKK1uOPhH9UWtyGcUyMlYtGx5fb4H3e7', 'IZLjXYWlzAs70kFF1ULWzi18qyGXqU15uOD7woI6');

use Parse\ParseObject;
$offset = 0;

do{

	$url = "http://api.nytimes.com/svc/news/v3/content/nyt/technology?limit=50&offset=".$offset."&api-key=68be15d48fbd0701ac18a9816186c879:7:70248756";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$out = curl_exec($ch);
	$arr = json_decode($out, true);

	foreach($arr['results'] as $a){
		$obj = ParseObject::create("NYTimes");
		$obj->set("headline", $a['title']);
		$obj->set("abstract", $a['abstract']);
		$obj->set("material_type_facet", $a['material_type_facet']);
		$obj->set("date", strtotime($a['published_date']));
		$obj->set("section", "Technology");

		$obj->save();
	}

	$offset += 50;
	sleep(2);
}while($offset < 10000);

?>