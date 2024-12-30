<?php

namespace App;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    protected $file_location;

    public function __construct()
    {
        $this->file_location = __DIR__ . '/log.txt';
    }

    public function log($level, string|\Stringable $message, array $context = []) : void
    {
        $file = fopen($this->file_location, 'a');
        $content =
            'Уровень ошибки: ' . $level . "\n" .
            'Время: ' . date(DATE_RFC2822) . "\n" .
            $message . "\n" . "\n";
        fwrite($file, $content);
    }

    /* public function log(\Exception $error)
    {
        $file = fopen($this->file_location, 'a');
        $content =
            'Время: ' . date(DATE_RFC2822) . "\n" .
            'Файл: ' . $error->getFile() . "\n" .
            'Строка: ' . $error->getLine() . "\n" .
            'Код ошибки: ' . $error->getCode() . "\n" .
            'Сообщение: ' . $error->getMessage() . "\n" . "\n";
        fwrite($file, $content);
    } */
}