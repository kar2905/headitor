<?php

use Parse\ParseClient;
use Parse\ParseQuery;
use Parse\ParseObject;

class ParseTestHelper
{

  public static function setUp()
  {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('UTC');
    ParseClient::initialize(
      'app-id-here',
      'rest-api-key-here',
      'master-key-here'
    );
  }

  public static function tearDown()
  {

  }

  public static function clearClass($class)
  {
    $query = new ParseQuery($class);
    $query->each(function(ParseObject $obj) {
      $obj->destroy(true);
    }, true);
  }

} 