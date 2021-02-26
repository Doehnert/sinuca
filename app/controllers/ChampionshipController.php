<?php

namespace App\Controllers;

use App\Core\App;

class ChampionshipController
{
  public function index()
  {
    if ($_GET['champ_id']){
      $champ = App::get('database')->selectOne('championship', $_GET['champ_id']);
    }else{
      $champ = App::get('database')->selectOne('championship');
    }

    $champs = App::get('database')->selectAll('championship');

    if ($champ->id){
      $champTeams = App::get('database')->selectParticipate($champ->id);
    }

    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/champ.view.php';
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