<?php

namespace Tests;

use App\Actions\CreateDownload;
use App\DataFactories\DownloadDataFactory;
use App\Enums\DownloadStatusEnum;
use App\Events\DownloadCreatedEvent;
use App\Jobs\DownloadFileJob;
use App\Listeners\DownloadCreatedListener;
use App\Models\Download;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected const INVALID_URL = 'httpXs://never-gonna-work';
    protected const VALID_URL_VALID_FORMAT = 'https://will-do-ok.zip';
    protected const VALID_URL_INVALID_FORMAT = 'https://will-do-ok.zipX';
    protected const REAL_FILE_TO_DOWNLOAD = 'https://www.rd.com/wp-content/uploads/2019/09/Cute-cat-lying-on-his-back-on-the-carpet.-Breed-British-mackerel-with-yellow-eyes-and-a-bushy-mustache.-Close-up-e1573490045672.jpg';

    /**
     * @param string $event
     * @param int $count
     * @return void
     */
    protected function assertEventFiredTimes(string $event, int $count): void
    {
        $this->assertEquals(
            count(collect($this->firedEvents)
                ->groupBy(function($item, $key) { return get_class($item); })
                ->get($event, [])),
            $count
        );
    }

    /**
     * @param string $job
     * @param int $count
     * @return void
     */
    protected function assertJobDispatchedTimes(string $job, int $count): void
    {
        $this->assertEquals(
            count(collect($this->dispatchedJobs)
                ->groupBy(function($item, $key) { return get_class($item); })
                ->get($job, [])),
            $count
        );
    }

    /**
     * @param Download $downloadObject
     * @param string $url
     * @param bool $runJob
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function createDownloadActionSanityCheck(Download $downloadObject, string $url, bool $runJob= false)
    {
        //$this->withoutJobs();
        //$this->withoutEvents();

        $urlFileData = pathinfo($url);

        $this->assertInstanceOf(Download::class, $downloadObject);
        $this->assertEquals($url, $downloadObject->url);
        $this->assertEquals($urlFileData['basename'], $downloadObject->filename);
        $this->assertEquals($urlFileData['extension'], $downloadObject->format);

        Event::assertDispatched(DownloadCreatedEvent::class);
        Event::assertListening(
            DownloadCreatedEvent::class,
            DownloadCreatedListener::class
        );

        $event = new DownloadCreatedEvent($downloadObject);
        $listener = new DownloadCreatedListener();

        $this->expectsJobs(DownloadFileJob::class);
        $listener->handle($event);

        if ($runJob) {
            $this->assertEquals($downloadObject->status->value, DownloadStatusEnum::Pending->value);

            $job = new DownloadFileJob($downloadObject->id);
            $job->handle();;
        }

        //$this->assertEventFiredTimes(DownloadCreatedEvent::class, 1);
        //$this->assertJobDispatchedTimes(DownloadFileJob::class, 1);
    }

    /**
     * @return void
     */
    protected function prepareForCreateDownloadActionSanityCheck()
    {
        Event::fake();
        Queue::fake();
        Bus::fake();
    }

    /**
     * @param string $url
     * @param bool $negative
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function downloadFileJobSanityBase(string $url, bool $negative = false): Download
    {
        $this->prepareForCreateDownloadActionSanityCheck();

        $downloadObject = CreateDownload::execute(DownloadDataFactory::createDataObjectFromUrl($url));
        $this->createDownloadActionSanityCheck($downloadObject, $url, true);

        // Refresh download
        $status = $negative ? DownloadStatusEnum::Error->value : DownloadStatusEnum::Complete->value;

        $refreshed = $downloadObject->fresh();

        $this->assertEquals($refreshed->status->value, $status);

        return $refreshed;
    }
}
