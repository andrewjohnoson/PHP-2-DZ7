<?php

namespace App\Exceptions;

trait ExceptionTrait
{
    public function __toString()
    {
        return 'Сообщение ошибки следующее: ' . $this->getMessage() . "\n" .
        'Её код: ' . $this->getCode() . "\n" .
        'Файл, в котором произошла ошибка: ' . $this->getFile() . "\n" .
        'на строке ' . $this->getLine();
    }

    public function message() : string
    {
        return
            'Сообщение ошибки следующее: ' . $this->getMessage() . '<br>' .
            ' Её код: ' . $this->getCode();
    }
}