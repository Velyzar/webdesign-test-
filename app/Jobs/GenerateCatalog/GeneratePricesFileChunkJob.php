<?php

namespace App\Jobs\GenerateCatalog;

class GeneratePricesFileChunkJob extends AbstractJob
{
    public $chunk;
    public $fileNum;

    /**
     * Конструктор приймає шматок даних та номер файлу
     */
    public function __construct($chunk = null, $fileNum = null)
    {
        parent::__construct();
        $this->chunk = $chunk;
        $this->fileNum = $fileNum;
    }
}
