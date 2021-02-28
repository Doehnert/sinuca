<?php

namespace App\Controllers;

use App\Core\App;
use App\Model\Team;
use App\Model\Championship;

class PagesController
{
  public function home()
  {
    $champs = Championship::getAll();
    if ($_GET['champ_id']) {
      $champ = Championship::getByPrimaryKey($_GET['champ_id']);
    } else {
      $champ = $champs[sizeof($champs) - 1];
    }
    $teams = Team::getAll();

    $filtered_teams = [];
    if ($champ->getId()) {
      $champTeams = App::get('database')->selectParticipate($champ->getId());
    } else {
      App::get('database')->createEmptyChamp();
    }

    var_dump($champTeams[0]->id_team);

    foreach ($teams as $team) {
      $flag_contain = 0;
      foreach ($champTeams as $champTeam) {
        if ($champTeam->id_team === $team->getId()) {
          $flag_contain = 1;
          break;
        }
      }
      if ($flag_contain == 0) {
        array_push($filtered_teams, $team);
      }
    }

    $teams = $filtered_teams;

    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/view/index.view.php';
  }

  public function update()
  {
    $champ = Championship::getByPrimaryKey($_POST['champ_id']);

    var_dump($_POST['champ_id']);

    $name = self::testInput($_POST['name']);
    $premium = self::testInput($_POST['premium']);
    $ptw = self::testInput($_POST['ptw']);
    $description = self::testInput($_POST['description']);

    if (!self::isNameValid($name)) {
      $_SESSION["error_msg"] = 'Nome inválido';
    } elseif (!self::isPremiumValid($premium)) {
      $_SESSION["error_msg"] = 'Prêmio inválido';
    } elseif (!self::isPtwValid($ptw)) {
      $_SESSION["error_msg"] = 'Pontos para ganhar inválido';
    } else {
      unset($_SESSION["error_msg"]);
      $champ->setName($name);
      $champ->setPremium($premium);
      $champ->setPtw($ptw);
      $champ->setDescription($description);
      $champ->save();
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  public static function testInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  public static function isPtwValid($ptw)
  {
    if (empty($ptw))
      return False;
    if (!is_numeric($ptw))
      return False;
    return True;
  }

  public static function isNameValid($name)
  {
    if (empty($name))
      return False;
    if (strlen($name) < 3)
      return False;
    return True;
  }

  public static function isPremiumValid($premium)
  {
    if (empty($premium))
      return False;
    if (!is_numeric($premium))
      return False;
    return True;
  }

  public function store()
  {
    $champ = new Championship();
    $champ->setName('');
    $champ->setPremium('');
    $champ->setPtw('');
    $champ->setDescription('');

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  public function destroy()
  {
    $delchamp = Championship::getByPrimaryKey($_GET['id_champ']);
    $delchamp->delete();

    header("Location: ./");
  }
}
