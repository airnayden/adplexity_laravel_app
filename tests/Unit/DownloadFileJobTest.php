<?php

namespace Tests\Unit;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use App\Enums\DownloadStatusEnum;
use Tests\TestCase;

class DownloadFileJobTest extends TestCase
{
    /**
     * @return void
     */
    public function testPassIfJobDownloadedValidFile()
    {
        $this->downloadFileJobSanityBase(parent::REAL_FILE_TO_DOWNLOAD, false);
    }

    /**
     * @return void
     */
    public function testPassIfJobDownloadedInvalidFile()
    {
        $this->downloadFileJobSanityBase(parent::VALID_URL_VALID_FORMAT, true);
    }
}
