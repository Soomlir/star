<?php
class SaveImages
{
  public $pathImages = '';
  public static $imagesUrl = [];
  public $logger;

  public function __construct($pathImages, Logger $logger)
  {
    $this->pathImages = $pathImages;
    $this->logger = $logger;
  }

  static function saveImg($pathImages, $saveDir, Logger $logger)
  {
    $pathSaveDir = __DIR__ . DIRECTORY_SEPARATOR . $saveDir;
    $logger->logWrite('Начало процесса сохранения изображений', 'info');

    if (!is_writable($pathSaveDir)) {
      $logger->logWrite("Нет прав на запись в директорию: $pathSaveDir", 'error');
      return;
    } else {
      $logger->logWrite("Права на запись в директорию $pathSaveDir есть", 'info');
    }

    if (file_exists($pathImages)) {
      $file = fopen($pathImages, 'r');
      $logger->logWrite("Файл с URL-ами найден: $pathImages", 'info');
      while (!feof($file)) {
        $url = trim(fgets($file));  
        self::$imagesUrl[] = $url;  
      }
      fclose($file);

      foreach (self::$imagesUrl as $imageUrl) {
        $filename = $pathSaveDir . DIRECTORY_SEPARATOR . basename($imageUrl);

        $logger->logWrite("Начало скачивания изображения: $imageUrl", 'detailed');

        $imageData = file_get_contents($imageUrl);

        if ($imageData === false) {
          $logger->logWrite("Ошибка при скачивании изображения: $imageUrl", 'error');
          continue;
        }

        $logger->logWrite("Изображение успешно загружено: $imageUrl", 'detailed');

        $result = file_put_contents($filename, $imageData);

        if ($result === false) {
          $logger->logWrite("Ошибка записи в файл: $filename", 'error');
        } else {
          $logger->logWrite("Изображение сохранено: $filename", 'info');
        }
      }
    } else {
      $logger->logWrite("Файл с URL-ами не найден: $pathImages", 'error');
    }

    $logger->logWrite('Процесс сохранения изображений завершен', 'info');
  }
}
