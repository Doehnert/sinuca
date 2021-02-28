<?php

use App\Model\Team;
use PHPUnit\Framework\TestCase;
use App\Controllers\PagesController;
use App\Model\Championship;

class ChampTest extends TestCase
{
  protected static $pdo;

  public function test_champ_name_is_valid()
  {
    $resp = PagesController::isNameValid('as');

    $this->assertFalse($resp);
  }

  public function test_champ_premium_is_valid()
  {
    $resp = PagesController::isPremiumValid('sdfsdf');

    $this->assertFalse($resp);
  }

  public function test_champ_ptw_is_valid()
  {
    $resp = PagesController::isPtwValid('asdasd');

    $this->assertFalse($resp);
  }
}
