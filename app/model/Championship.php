<?php

namespace App\Model;

/**
 * Championship Model
 */
class Championship extends Model
{

  protected static $tableName = 'championship';
  protected static $primaryKey = 'id';

  function setId($value)
  {
    $this->setColumnValue('id', $value);
  }

  function getId()
  {
    return $this->getColumnValue('id');
  }

  function setName($value)
  {
    $this->setColumnValue('name', $value);
  }

  function getName()
  {
    return $this->getColumnValue('name');
  }

  function setPremium($value)
  {
    $this->setColumnValue('premium', $value);
  }

  function getPremium()
  {
    return $this->getColumnValue('premium');
  }

  function setPtw($value)
  {
    $this->setColumnValue('ptw', $value);
  }

  function getPtw()
  {
    return $this->getColumnValue('ptw');
  }

  function setDescription($value)
  {
    $this->setColumnValue('description', $value);
  }

  function getDescription()
  {
    return $this->getColumnValue('description');
  }
}
