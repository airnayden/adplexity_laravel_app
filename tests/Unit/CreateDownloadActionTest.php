<?php

namespace Tests\Unit;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CreateDownloadActionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassCreateActionWithValidUrlValidFormatTest()
    {
        $this->prepareForCreateDownloadActionSanityCheck();

        $downloadObject = CreateDownload::execute(DownloadDataFactory::createDataObjectFromUrl(parent::VALID_URL_VALID_FORMAT));
        $this->createDownloadActionSanityCheck($downloadObject, parent::VALID_URL_VALID_FORMAT);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateActionReturnDownloadModelWithValidUrlInvalidFormatTest()
    {
        $this->expectException(ValidationException::class);
        CreateDownload::execute(DownloadDataFactory::createDataObjectFromUrl(parent::VALID_URL_INVALID_FORMAT));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateActionReturnDownloadModelWithInvalidUrlTest()
    {
        $this->expectException(ValidationException::class);
        CreateDownload::execute(DownloadDataFactory::createDataObjectFromUrl(parent::INVALID_URL));
    }
}
