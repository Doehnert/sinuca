<?php
// Start the session
session_start();

if (($_SERVER['DOCUMENT_ROOT']) != "") {
  var_dump($_SERVER['DOCUMENT_ROOT']);
  require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
} else {
  require_once('vendor/autoload.php');
}

use App\Core\App;
use App\Core\Database\Config;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;


App::bind('config', Config::getConf());

$config = App::get('config');

App::bind('database', new QueryBuilder(
  Connection::make(App::get('config')['database'])
));



// Max possible teams for championship
$_SESSION["max_teams"] = 10;
