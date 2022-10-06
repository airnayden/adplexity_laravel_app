<?php

namespace App\Actions;

use App\Enums\DownloadStatusEnum;
use App\Events\DownloadCreatedEvent;
use App\Models\Download;
use App\DataTransferObjects\DownloadData;

class CreateDownload
{
    /**
     * @param DownloadData $downloadData
     * @return Download
     */
    public static function execute(DownloadData $downloadData): Download
    {
        // Create record
        $download = new Download();
        $download->filename = $downloadData->filename;
        $download->format = $downloadData->format;
        $download->url = $downloadData->url;
        $download->status = DownloadStatusEnum::Pending;
        $download->save();

        // Dispatch event
        event(new DownloadCreatedEvent($download));

        return $download;
    }
}
