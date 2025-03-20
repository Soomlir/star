<?php
class Logger
{
  public $logLevel;
  public $logPath;

  public function __construct($logLevel, $logPath = './logs/log.txt')
  {
    $this->logLevel = $logLevel;
    $this->logPath = $logPath;
  }

  public function logWrite($message, $level)
  {
    if ($this->shouldLog($level)) {
      $timestamp = date('Y-m-d H:i:s');
      $logMessage = "[$timestamp] [$level] $message\n";

      $file = fopen($this->logPath, 'a');
      if ($file) {
        fwrite($file, $logMessage);
        fclose($file);
      } else {
        echo "Ошибка при записи в лог файл\n";
      }
    }
  }

  private function shouldLog($level)
  {
    $levels = ['info', 'detailed', 'debug'];

    $levelPriority = array_flip($levels);
    return $levelPriority[$level] <= $levelPriority[$this->logLevel];
  }
}
