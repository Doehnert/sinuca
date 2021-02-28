<?php

namespace App\Core\Database;

class Config
{
  /**
   * path to the sqlite file
   */

  function __construct()
  {
  }

  public static function getConf()
  {
    var_dump(__DIR__ . '/sinuca.db');
    return [
      'database' => [
        'connection' => 'sqlite:' . __DIR__ . '/sinuca.db'
      ]
    ];
  }
}
