<?php

namespace App\Jobs\GenerateCatalog;

class GenerateCatalogCacheJob extends AbstractJob
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        // Явно викликаємо метод handle батька, щоб воркер "бачив" логіку
        parent::handle();
    }
}
