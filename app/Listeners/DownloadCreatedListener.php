<?php

namespace App\Listeners;

use App\Events\DownloadCreatedEvent;
use App\Jobs\DownloadFileJob;

class DownloadCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DownloadCreatedEvent $event
     * @return void
     */
    public function handle(DownloadCreatedEvent $event)
    {
        DownloadFileJob::dispatch($event->model->id);
    }
}
