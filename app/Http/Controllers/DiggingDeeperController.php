<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVideoJob;
use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;

class DiggingDeeperController extends Controller
{
    public function processVideo()
    {
        ProcessVideoJob::dispatch();
        return response()->json(['status' => 'Video processing dispatched']);
    }

    /**
     * @link http://localhost:8000/api/digging_deeper/prepare-catalog
     */
    public function prepareCatalog()
    {
        GenerateCatalogMainJob::dispatch();
        return response()->json(['status' => 'Catalog preparation chain dispatched']);
    }
}
