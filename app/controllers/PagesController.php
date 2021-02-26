<?php
namespace App\Controllers;

use App\Core\App;

class PagesController
{
  public function home()
  {
    if ($_GET['champ_id']){
      $champ = App::get('database')->selectOne('championship', $_GET['champ_id']);
    }else{
      $champ = App::get('database')->selectOne('championship');
    }
    
    $teams = App::get('database')->selectAll('team');

    $filtered_teams = [];
    if ($champ->id)
    {
      $champTeams = App::get('database')->selectParticipate($champ->id);
    } else {
      App::get('database')->createEmptyChamp();
    }
      
    foreach ($teams as $team){
      $flag_contain = 0;
      foreach ($champTeams as $champTeam){
        if ($champTeam->id_team === $team->id){
          $flag_contain = 1;
          break;
        }
      }
      if ($flag_contain == 0){
        array_push($filtered_teams, $team);
      }
    }

    $teams = $filtered_teams;
    $champs = App::get('database')->selectAll('championship');

    require_once $_SERVER['DOCUMENT_ROOT'].'/app/view/index.view.php';
  }

  public function update()
  {
    App::get('database')->updateChamp([
      'name' => $_POST['name'],
      'premium' => $_POST['premium'],
      'ptw' => $_POST['ptw'],
      'description' => $_POST['description'],
      'champ_id' => $_POST['champ_id']
    ]);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  public function store()
  {
    App::get('database')->insert('championship', [
      'name' => '',
      'premium' => '',
      'ptw' => '',
      'description' => '',
    ]);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  public function destroy()
  {
    $id_champ = $_GET['id_champ'];
    App::get('database')->deleteOne('championship', 'id', $id_champ);

    $this->home();

    header("Location: ./");
  }
}






