<?php

namespace App\Controllers;


use App\Core\App;
use App\Dao\Teamdao;
use App\Core\Database\Connection;

class TeamsController
{
  public function index()
  {
    $teams = App::get('database')->selectAll('team');

    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/teams.view.php';
  }

  public function store()
  {
    App::get('database')->insert('team', [
      'name' => $_POST['name'],
      'p1' => $_POST['p1'],
      'p2' => $_POST['p2'],
    ]);
    
    header('Location: teams');
  }

  public function destroy()
  {
    $id_team = $_GET['id_team'];
    App::get('database')->deleteOne('team', 'id', $id_team);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
}