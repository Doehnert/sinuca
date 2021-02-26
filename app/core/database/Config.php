<?php

namespace App\Core\Database;

class Config {
   /**
    * path to the sqlite file
    */

    function __construct(){
    }

    public static function getConf()
    {
        return [
            'database' => [
              'connection' => 'sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/app/core/database/sinuca.db'
            ]
          ];
    }

    // const PATH_TO_SQL = $this->baseDir.'app/core/database/sinuca.db';

}