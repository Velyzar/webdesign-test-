<?php

namespace App\Jobs\GenerateCatalog;

use App\Jobs\GenerateCatalog\GenerateCatalogCacheJob;
use App\Jobs\GenerateCatalog\GenerateCategoriesJob;
use App\Jobs\GenerateCatalog\GenerateDeliveriesJob;
use App\Jobs\GenerateCatalog\GeneratePointsJob;
use App\Jobs\GenerateCatalog\ArchiveUploadsJob;
use App\Jobs\GenerateCatalog\SendPriceRequestJob;
use App\Jobs\GenerateCatalog\GenerateGoodsFileJob;
use App\Jobs\GenerateCatalog\GeneratePricesFileChunkJob;


class GenerateCatalogMainJob extends AbstractJob
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        {
            $this->debug('start');

            // 1. Кешування
            dispatch_sync(new GenerateCatalogCacheJob());

            // 2. Готуємо ланцюг: створюємо інстанси об'єктів тут
            $chain = [
                new GeneratePricesFileChunkJob(['id' => 1], 1),
                new GeneratePricesFileChunkJob(['id' => 2], 2),
                new GenerateCategoriesJob(),
                new GenerateDeliveriesJob(),
                new GeneratePointsJob(),
                new ArchiveUploadsJob(),
                new SendPriceRequestJob(),
            ];

            // 3. Відправляємо через GoodsFileJob
            GenerateGoodsFileJob::withChain($chain)->dispatch();

            $this->debug('finish');
        }
    }
}
