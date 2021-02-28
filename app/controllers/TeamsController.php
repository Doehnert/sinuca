<?php

namespace App\Controllers;

use App\Model\Team;

class TeamsController
{
  public function index()
  {
    $teams = Team::getAll();

    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/teams.view.php';
  }

  public function store()
  {
    $newteam = new Team();
    $newteam->setName($_POST['name']);
    $newteam->setP1($_POST['p1']);
    $newteam->setP2($_POST['p2']);
    $newteam->save();

    header('Location: teams');
  }

  public function destroy()
  {
    $delteam = Team::getByPrimaryKey($_GET['id_team']);
    $delteam->delete();

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
}
