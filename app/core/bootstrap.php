<?php

use App\Core\App;
use App\Core\Database\Config;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;


App::bind('config', Config::getConf());

$config = App::get('config');

App::bind('database', new QueryBuilder(
  Connection::make(App::get('config')['database'])
));

// Start the session
session_start();

// Max possible teams for championship
$_SESSION["max_teams"] = 10;