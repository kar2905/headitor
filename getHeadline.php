<?php
/*
API returns dynamic headline from Parse

@aid  - article_id - required parameter
@sns - social network
@age - age group
@language - language
@mood - mood
 */

require 'vendor/autoload.php';
require "vendor/parse/php-sdk/autoload.php";
use Parse\ParseClient;

ParseClient::initialize('4ECwF2VPmjUItXMJcN7BuWkIOrDnFoIobZh8tvBn', 'kc7swveVnKK1uOPhH9UWtyGcUyMlYtGx5fb4H3e7', 'IZLjXYWlzAs70kFF1ULWzi18qyGXqU15uOD7woI6');

use Parse\ParseObject;

use Parse\ParseQuery;

$time = date("a");
$sns = "tw";
$age = "19-40";
$mood = "happy";
$language = "english";

if(isset($_GET['aid'])){
	$aid = intval($_GET['aid']);
}else{
	echo "Article ID missing - die";
	die();
}


if(isset($_GET['sns'])){
	$sns = $_GET['sns'];
}
if(isset($_GET['age'])){
	$age = $_GET['age'];
}
if(isset($_GET['mood'])){
	$mood = $_GET['mood'];
}


$query = new ParseQuery("Articles");
$query->equalTo("time", $time );
$query->equalTo("article_id", $aid );
$query->equalTo("sns", $sns );
$query->equalTo("age", $age );
//$query->equalTo("mood", $mood );
//$query->equalTo("language", $language );

$object = $query->first();

echo $object->get("headline");

?>