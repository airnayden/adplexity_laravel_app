<?php

namespace Tests\Unit;

use App\DataFactories\DownloadDataFactory;
use App\DataTransferObjects\DownloadData;
use App\Http\Requests\Api\DownloadCreateRequestApi;
use App\Http\Requests\Web\DownloadCreateRequestWeb;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class DownloadDataFactoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailWhenNoValidUrl()
    {
        $this->expectException(ValidationException::class);

        DownloadDataFactory::createDataObjectFromUrl(parent::INVALID_URL);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassWhenValidUrl()
    {
        $this->assertInstanceOf(DownloadData::class, DownloadDataFactory::createDataObjectFromUrl(parent::VALID_URL_VALID_FORMAT));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailsWhenInvalidFormatUrl()
    {
        $this->expectException(ValidationException::class);
        $this->assertInstanceOf(DownloadData::class, DownloadDataFactory::createDataObjectFromUrl(parent::VALID_URL_INVALID_FORMAT));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailWhenNoValidUrlFromApi()
    {
        $this->expectException(ValidationException::class);
        $request = new DownloadCreateRequestApi([
            'url' => parent::INVALID_URL
        ]);

        DownloadDataFactory::fromCreateRequest($request);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailWhenNoValidUrlFromWeb()
    {
        $this->expectException(ValidationException::class);
        $request = new DownloadCreateRequestWeb([
            'url' => parent::INVALID_URL
        ]);

        DownloadDataFactory::fromCreateRequest($request);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassWhenValidUrlFromApi()
    {
        $request = new DownloadCreateRequestApi([
            'url' => parent::VALID_URL_VALID_FORMAT
        ]);

        $this->assertInstanceOf(DownloadData::class, DownloadDataFactory::fromCreateRequest($request));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassWhenValidUrlFromWeb()
    {
        $request = new DownloadCreateRequestWeb([
            'url' => parent::VALID_URL_VALID_FORMAT
        ]);

        DownloadDataFactory::fromCreateRequest($request);
        $this->assertInstanceOf(DownloadData::class, DownloadDataFactory::fromCreateRequest($request));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailWhenNoSupportedFormatFromApi()
    {
        $this->expectException(ValidationException::class);
        $request = new DownloadCreateRequestApi([
            'url' => parent::VALID_URL_INVALID_FORMAT
        ]);

        DownloadDataFactory::fromCreateRequest($request);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailWhenNoSupportedFormatFromWeb()
    {
        $this->expectException(ValidationException::class);
        $request = new DownloadCreateRequestWeb([
            'url' => parent::VALID_URL_INVALID_FORMAT
        ]);

        DownloadDataFactory::fromCreateRequest($request);
    }
}
