<?php

namespace App\Controllers;

use App\Core\App;

class ParticipateController
{

  public function store()
  {
    if ($_POST['champ_id']) {
      $champ = App::get('database')->selectOne('championship', $_POST['champ_id']);
    } else {
      $champ = App::get('database')->selectOne('championship');
    }

    if ($champ->id) {
      $num_participations = count((array)App::get('database')->selectParticipate($champ->id));
      var_dump($num_participations);
    }

    if ($num_participations < $_SESSION["max_teams"]) {
      App::get('database')->insert('participate', [
        'id_team' => $_POST['id_team'],
        'id_champ' => $champ->id,
      ]);
      unset($_SESSION["error"]);
    } else {
      $_SESSION["error"] = "Número de participantes não pode passar de 10";
    }


    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  public function destroy()
  {
    unset($_SESSION["error"]);
    $id_team = $_GET['id_team'];
    App::get('database')->deleteOne('participate', 'id_team', $id_team);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
}
