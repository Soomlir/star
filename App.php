<?php
require_once 'Logger.php';
require_once 'SaveImages.php';

class App
{
  public $pathImages = '';
  public $saveDir = '';
  public $logLevel = '';

  function __construct($pathImages, $saveDir, $logLevel)
  {
    $this->pathImages = $pathImages;
    $this->saveDir = $saveDir;
    $this->logLevel = $logLevel;
  }

  public function run()
  {
    $logger = new Logger($this->logLevel, './logs/log.txt');

    FileHelper::createDir($this->saveDir);
    SaveImages::saveImg($this->pathImages, $this->saveDir, $logger);
  }
}
