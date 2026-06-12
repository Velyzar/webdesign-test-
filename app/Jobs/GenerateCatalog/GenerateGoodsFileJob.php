<?php

namespace App\Jobs\GenerateCatalog;

class GenerateGoodsFileJob extends AbstractJob
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        // Звертаємося напряму до методу батька, без використання слова parent
        $this->debug('done');
    }
}
