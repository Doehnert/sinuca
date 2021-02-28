<?php

namespace App\Model;

/**
 * Team Model
 */
class Team extends Model
{

  protected static $tableName = 'team';
  protected static $primaryKey = 'id';

  function setId($value)
  {
    $this->setColumnValue('id', $value);
  }
  function getId()
  {
    return $this->getColumnValue('id');
  }

  function setP1($value)
  {
    $this->setColumnValue('p1', $value);
  }
  function getP1()
  {
    return $this->getColumnValue('p1');
  }
  function setP2($value)
  {
    $this->setColumnValue('p2', $value);
  }
  function getP2()
  {
    return $this->getColumnValue('p2');
  }

  function setName($value)
  {
    $this->setColumnValue('name', $value);
  }
  function getName()
  {
    return $this->getColumnValue('name');
  }
}
