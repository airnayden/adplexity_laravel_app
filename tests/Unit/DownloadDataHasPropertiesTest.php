<?php

namespace Tests\Unit;

use App\DataFactories\DownloadDataFactory;
use App\Http\Requests\Api\DownloadCreateRequestApi;
use Tests\TestCase;

class DownloadDataHasPropertiesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDownloadDataHasProperties()
    {
        $request = new DownloadCreateRequestApi([
            'url' => parent::VALID_URL_VALID_FORMAT
        ]);

        $downloadData = DownloadDataFactory::fromCreateRequest($request);

        $this->assertObjectHasAttribute('id', $downloadData);
        $this->assertObjectHasAttribute('filename', $downloadData);
        $this->assertObjectHasAttribute('format', $downloadData);
        $this->assertObjectHasAttribute('url', $downloadData);
        $this->assertObjectHasAttribute('status', $downloadData);
        $this->assertObjectHasAttribute('error', $downloadData);
        $this->assertObjectHasAttribute('createdAt', $downloadData);
        $this->assertObjectHasAttribute('updatedAt', $downloadData);
    }
}
