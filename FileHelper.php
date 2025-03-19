<?php
class FileHelper 
{
  public $saveDir = '';

  function __construct($saveDir) 
  {
    $this->saveDir = $saveDir;
  }

  static function createDir($saveDir) 
  {
    if (!is_dir($saveDir)) {
      mkdir($saveDir, 0777, true);
    }
  }
}
