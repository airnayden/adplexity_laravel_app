<?php

namespace Tests\Unit;

use App\Actions\DoDownload;
use App\Exceptions\Errors\StateConflictException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tests\TestCase;

class DoDownloadActionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailsIfDownloadNotComplete()
    {
        $this->expectException(StateConflictException::class);
        $downloadObject = $this->downloadFileJobSanityBase(parent::VALID_URL_VALID_FORMAT, true);
        DoDownload::execute($downloadObject->id);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassesIfDownloadComplete()
    {
        $downloadObject = $this->downloadFileJobSanityBase(parent::REAL_FILE_TO_DOWNLOAD, false);
        $this->assertInstanceOf(StreamedResponse::class,  DoDownload::execute($downloadObject->id));
    }
}
