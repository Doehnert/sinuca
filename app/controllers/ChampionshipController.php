<?php

namespace App\Controllers;

use App\Core\App;
use App\Model\Championship;

class ChampionshipController
{
  public function index()
  {
    $allChamps = Championship::getAll();

    if ($_GET['champ_id']) {
      $currentChamp = Championship::getByPrimaryKey($_GET['champ_id']);
    } else {
      $currentChamp = $allChamps[sizeof($allChamps) - 1];
    }

    if ($currentChamp->getId()) {
      $champTeams = App::get('database')->selectParticipate($currentChamp->getId());
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/champ.view.php';
  }

  public function store()
  {
    $id_team = $_POST['team'];
    $points = $_POST['points'];

    App::get('database')->updateParticipate($id_team, $points);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
}
