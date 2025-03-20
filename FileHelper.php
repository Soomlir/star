<?php
class FileHelper 
{
  public $saveDir;

  public function __construct($saveDir) 
  {
    $this->saveDir = $saveDir;
  }

  public static function createDir($saveDir) 
  {
    if (!is_dir($saveDir)) {
      mkdir($saveDir, 0777, true);
    }
  }
}
