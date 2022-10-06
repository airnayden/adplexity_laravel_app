<?php

namespace App\Jobs;

use App\Enums\DownloadStatusEnum;
use App\Models\Download;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private int $downloadId)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Fetch the object
        $downloadObject = Download::findOrFail($this->downloadId);

        // Set status to `downloading`
        $downloadObject->status = DownloadStatusEnum::Downloading;
        $downloadObject->save();

        try {
            // Not ideal, but it's the simplest possible solution for now.
            $contents = file_get_contents($downloadObject->url);
            $internalFileName = sprintf('file_%s.%s', Str::random(), $downloadObject->format);

            Storage::disk('adplexity')->put($internalFileName, $contents);

            $downloadObject->status = DownloadStatusEnum::Complete;
            $downloadObject->internal_filename = $internalFileName;
            $downloadObject->save();
        } catch (\Throwable $e) { // Just in case
            $this->fail($e);
        }
    }

    /**
     * @param \Throwable|null $exception
     * @return void
     */
    public function fail(?\Throwable $exception = null)
    {
        // Fetch the object
        $downloadObject = Download::findOrFail($this->downloadId);
        $downloadObject->error = $exception->getMessage();
        $downloadObject->save();
    }
}
