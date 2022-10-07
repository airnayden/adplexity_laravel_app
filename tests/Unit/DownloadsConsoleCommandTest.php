<?php

namespace Tests\Unit;

use App\Models\Download;
use Tests\TestCase;

class DownloadsConsoleCommandTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassesOnDefaultCommand()
    {
        $this->artisan('downloads')->assertSuccessful();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassesOnIndexCommand()
    {
        $this->artisan('downloads index')->assertSuccessful();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassesOnHelpCommand()
    {
        $this->artisan('downloads')->assertSuccessful();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailsOnUnknownCommand()
    {
        $this->artisan('downloads xoxoxo')->assertFailed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailsOnStoreWithoutValidUrlCommand()
    {
        $this->artisan('downloads store')->assertFailed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailsOnStoreWithInvalidUrlCommand()
    {
        $this->artisan('downloads store ' . parent::INVALID_URL)->assertFailed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailsOnStoreWithValidUrlInvalidFormatCommand()
    {
        $this->artisan('downloads store ' . parent::VALID_URL_INVALID_FORMAT)->assertFailed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPassesOnStoreWithValidUrlValidFormatCommand()
    {
        $this->prepareForCreateDownloadActionSanityCheck();

        $this->artisan('downloads store ' . parent::VALID_URL_VALID_FORMAT)->assertSuccessful();

        // Check what happened to DB record
        $downloadObject = Download::firstOrFail();
        $this->createDownloadActionSanityCheck($downloadObject, parent::VALID_URL_VALID_FORMAT);

        // Check output
        $this->artisan('downloads index')->expectsOutputToContain($downloadObject->filename);
        $this->artisan('downloads index')->expectsOutputToContain($downloadObject->format);
        $this->artisan('downloads index')->expectsOutputToContain($downloadObject->url);
        $this->artisan('downloads index')->expectsOutputToContain($downloadObject->status->name);
    }
}
