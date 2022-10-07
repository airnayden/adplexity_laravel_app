<?php

namespace Tests\Unit;

use App\Enums\DownloadStatusEnum;
use Tests\TestCase;

class DownloadStatusEnumTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEnumReturnsNonEmptyArray()
    {
        $this->assertIsArray(DownloadStatusEnum::getValues());
    }
}
